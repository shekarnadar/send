<?php

namespace App\Http\Controllers\ClientManager;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Product;
use App\Models\User;
use App\Models\CampaignRedeemedAmount;
use App\Models\Recipient;
use App\Models\CompanyProductMapping;


class ClientManagerController extends Controller
{
    public function index(){
        $id = Auth::guard('manager')->user()->id;
        $campaignsCount = Campaign:: getCampaingsCount();
        $totalGiftSentCount = Campaign::totalGiftSentCount();
        
        $totalGiftRedeemedCount = Campaign::totalGiftRedeemedCount();
        $recentUsers = Recipient::recentUsers();
        $topSellingProduct = Product::topSellingProduct();

        $campaign = Campaign::select( //first graph
            DB::raw("(COUNT(*)) as count"),
            DB::raw("MONTHNAME(created_at) as month_name")
        )
        ->where('client_id', $id)
        ->whereYear('created_at', date('Y'))
        ->groupBy('month_name')
        ->get();
        $monthArr = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $countArr = [];
        foreach($monthArr as $index => $month) {
            $d = collect($campaign)->where('month_name', $month)->first();
            if(!empty($d->count)){
                $countArr[$index] = $d->count;
            }else {
                $countArr[$index] = 0;
            }
        }
        $monthArr = implode(',', $monthArr);
        $countArr = implode(',', $countArr);

        $maximumBudget = Campaign::maximumBudget();
        $reedemedBudget = CampaignRedeemedAmount::reedemedBudget();
        $compproduct = CompanyProductMapping::where('company_id', \Auth::guard(getAuthGaurd())->user()->client_id)->pluck('product_id')->toArray();
        
        return view('client-manager.dashboard',compact('reedemedBudget','maximumBudget','countArr','monthArr','campaignsCount','totalGiftSentCount','totalGiftRedeemedCount','topSellingProduct','recentUsers','compproduct'));
    }
}
