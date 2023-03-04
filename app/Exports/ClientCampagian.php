<?php

namespace App\Exports;

use App\Models\Campaign;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClientCampagian implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function __construct($id)
    {
    	$this->id = $id;
    }
      public function map($row): array
    {
    	$date = Carbon::now();
        $carbon = date('Y-m-d',strtotime($date));
        $status='';
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
            $row->id,
            $row->campaign_name,
            $row->type,
            $row->FIRSTNAME,
            @$row->name,
            @$row->budget,
            $row->amount,
            $status

        ];        
    }
    public function collection()
    {
        $query = Campaign::select('campaigns.id','campaigns.name as campaign_name','type',\DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS FIRSTNAME"),'clients.name','budget','amount')->leftjoin('users','campaigns.created_by_user_id','=','users.id')->leftjoin('clients','users.client_id','=','clients.id')->leftjoin('campaign_redeemed_amount','campaigns.id','=','campaign_redeemed_amount.campaign_id')->where('campaigns.client_id',$this->id);
		
        return $query->orderBy('campaigns.id','DESC')->cursor();
    }
    public function headings():array{
        return[
            'Id',
            'Campaign Name',
            'Campaign Type',
            'Created By',
            'Company Name',
            'Budget',
            'Redeemed',
            'Status'
            
        ];
    } 
}
