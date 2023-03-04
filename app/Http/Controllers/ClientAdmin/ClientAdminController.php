<?php

namespace App\Http\Controllers\ClientAdmin;

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

 
class ClientAdminController extends Controller
{
    public function index(){
        $id = Auth::guard('client_admin')->user()->id;
        $client_id =  \Auth::guard(getAuthGaurd())->user()->client_id;
       
        // dd([$client_id]);

        $totalGiftSentCount = Campaign::totalGiftSentCount();
        $totalGiftRedeemedCount = Campaign::totalGiftRedeemedCount();
        $totalCampagianGiftTransistCount = Campaign::totalCampagianGiftTransistCount();
        $totalCampagianGiftDeliveredCount = Campaign::totalCampagianGiftDeliveredCount();
        
        $recentUsers = Recipient::recentUsers();
        $topSellingProduct = Product::topSellingProduct();                                            
        $campgianList = Campaign::where('client_id',$client_id)->select('name','id')->get()->toArray();
        $campaignsCount = count($campgianList);

        $campaign = Campaign::selectRaw("COUNT(id) as count,MONTHNAME(created_at) as month_name" //first graph
            /* DB::raw("(COUNT(1)) as count"),
            DB::raw("MONTHNAME(created_at) as month_name") */
        )
        ->where('client_id', $client_id)
        // ->whereYear('created_at', date('Y'))
        ->groupBy('month_name')
        ->get();

        //  dd($campaign);

        // dd(collect($campaign)->where('month_name', 'November')->first());
            
        $monthArr = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $countArr = [];
        foreach($monthArr as $index => $month) {
            // dd($index);
            $d = collect($campaign)->where('month_name', $month)->first();
            if(!empty($d->count)){
                // dd($d->count);
                $countArr[$index] = $d->count;
            }else {
                $countArr[$index] = 0;
            }
        }

        // dd($countArr);

        $monthArr = implode(',', $monthArr);
        $countArr = implode(',', $countArr);

        $maximumBudget = Campaign::maximumBudget();
        $reedemedBudget = CampaignRedeemedAmount::reedemedBudget();
        $compproduct = CompanyProductMapping::where('company_id', \Auth::guard(getAuthGaurd())->user()->client_id)->pluck('product_id')->toArray();
        // $maximumBudget = Campaign::where('created_by_user_id',$id)->sum('budget');
        // $reemedAmount = CampaignRedeemedAmount::where('created_by_user_id',$id)->sum('budget');
        
        return view('client-admin.dashboard',compact('reedemedBudget','maximumBudget','countArr','monthArr','campaignsCount','totalGiftSentCount','totalGiftRedeemedCount','topSellingProduct','recentUsers','compproduct','campgianList', 'totalCampagianGiftTransistCount', 'totalCampagianGiftDeliveredCount'));
    }

    public function campagianData($id){
         $data['totalGiftSentCount'] = Campaign:: totalCampagianGiftSentCount($id);
         $data['totalGiftRedeemedCount'] = Campaign::totalGiftCampiganRedeemedCount($id);
         $data['totalCampagianGiftTransistCount'] = Campaign::totalCampagianGiftTransistCount($id);
         $data['totalCampagianGiftDeliveredCount'] = Campaign::totalCampagianGiftDeliveredCount($id);
         return response()->json(['success' => true,
                    'count' => $data
                ], 200);
    }
}
