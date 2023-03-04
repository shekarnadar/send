<?php

namespace App\Exports;

use App\Models\Campaign;
use App\Models\CampaignRedeemedAmount;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithTitle;


class CampaignDetailExport implements WithHeadings,WithTitle,FromCollection,WithMapping
{

    public function __construct($products)
    {
        $this->products = $products;
    }

      public function map($row): array
    {
    	$date = Carbon::now();
        $carbon = date('Y-m-d',strtotime($date));
    	$reedemedBudget = CampaignRedeemedAmount::where('campaign_id',$row['id'])->sum('amount');
    	if($row->type == "instant"){
             $status =  $row->approval_status == 1 ? 'Expired' : ($row->approval_status == 0 ? 'Pending' : 'Pending');
        }elseif($row->type == "individual"){
            
            if($carbon > date('Y-m-d',strtotime($row->end_date))){
                 $status= 'Expired';
            }elseif($row->approval_status == 0){
                $status = 'Pending Approval';
            }elseif($row->approval_status == 1){
                 $status = 'Active';
            }else{
                 $status = 'Rejected';
            }
        }else{
            
            if($carbon > date('Y-m-d',strtotime($row->start_date))){
                 $status = 'Expired';
            }elseif($row->approval_status == 0){
                 $status = 'Pending Approval';
            }elseif($row->approval_status == 1){
                 $status = 'Active';
            }else{
                 $status= 'Rejected';
            }
        }
        return [
            $row['type'],
            $row['budget'],
            date('d-m-Y', strtotime($row->created_at)),
            $row['name'],
            $reedemedBudget,
            $status,
            @$row->user->first_name. " ".@$row->user->last_name
        ];
    }


    public function headings(): array
    {
        return [
            'Campagian Type',
            'Campaign Maximum Budget',
            'Campaign date',
            'Campaign Name',
            'Campaign Redeemed Amount',
            'Campaign Status',
            'Added By'
        ];
    }
     public function collection()
    {
         return $this->products;
    }
   

    public function title(): string
    {
        return 'Detail';
    }

}
