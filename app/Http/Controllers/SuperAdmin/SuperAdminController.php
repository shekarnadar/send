<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Campaign;
use App\Models\Product;
use App\Models\Recipient;
use App\Models\Lead;
use App\Models\CampaignRedeemedAmount;
use App\Models\User;
use App\Models\Client;


use Carbon\Carbon;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        $campaignsCount = Campaign::getCampaingsCount();
        $client = Client::orderBy('id', 'DESC')->select('name', 'id')->get()->toArray();
        $totalGiftSentCount = Campaign::totalGiftSentCount('admin');

        $totalClientAdminCount = count($client);
         //User::where('role_master_id', 3)->count();
        $recentUsers = Recipient::recentUsers();
        $topSellingProduct = Product::topSellingProduct();

        $lead = Lead::select([ //last graph
            DB::raw('DATE(created_at) AS date'),
            DB::raw('COUNT(id) AS count'),
        ])
            ->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get()
            ->toArray();
        //  $leadGraph = sortBy('date',   $lead);
        $leadGraph = array_column($lead, 'count');
        $leadGraph = implode(',', $leadGraph);


        $campaign = Campaign::select( //first graph
            DB::raw("(COUNT(*)) as count"),
            DB::raw("MONTHNAME(created_at) as month_name")
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month_name')
            ->get();

        //August
        $monthArr = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $countArr = [];

        foreach ($monthArr as $index => $month) {
            $d = collect($campaign)->where('month_name', $month)->first();
            if (!empty($d->count)) {
                $countArr[$index] = $d->count;
            } else {
                $countArr[$index] = 0;
            }
        }
        $monthArr = implode(',', $monthArr);
        $countArr = implode(',', $countArr);

        $maximumBudget = Campaign::sum('budget');
        $reedemedBudget = CampaignRedeemedAmount::sum('amount');
        return view('super-admin.dashboard', compact('reedemedBudget', 'maximumBudget', 'leadGraph', 'campaignsCount', 'totalGiftSentCount', 'totalClientAdminCount', 'topSellingProduct', 'recentUsers', 'countArr', 'monthArr', 'client'));
    }

    public function clientWiseData($id)
    {

        if ($id == 0) {

            $data['totalCampCount'] = Campaign::getCampaingsCount();
            $data['totalClientGiftSentCount'] = Campaign::totalGiftSentCount('admin');
            $data['totalCustomer'] =  Client::count();
            $data['card-name'] = 'Customers';
            return response()->json([
                'success' => true,
                'count' => $data
            ], 200);

        } else {

            $data['totalCampCount'] = Campaign::getClientCampaingsCount($id);
            $data['totalClientGiftSentCount'] = Campaign::totalClientGiftSentCount($id);
            $data['totalCustomer'] =  Campaign::totalRecipientsCountByClient($id);
            $data['card_name'] = 'Recipients';
            return response()->json([
                'success' => true,
                'count' => $data
            ], 200);
        }
    }
}
