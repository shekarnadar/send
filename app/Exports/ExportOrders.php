<?php

namespace App\Exports;

use App\Models\Orders;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class ExportOrders implements  WithHeadings,FromCollection,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($start_date,$end_date)
    {
        $this->start_date = $start_date; 
        $this->end_date = $end_date;
    }
    public function map($row): array
    {
    	$courier = json_decode($row['order_response'],true);
        return [
            $row['id'],
            !empty($row['recipientReedme']['recipientDetails']) ? $row['recipientReedme']['recipientDetails']['first_name']." ".$row['recipientReedme']['recipientDetails']['last_name'] : 'Unknown ',
            !empty($row['recipientReedme']['recipientDetails']) ? $row['recipientReedme']['recipientDetails']['email'] : 'Unknown ',
            !empty($row['recipientReedme']['recipientDetails']) ? $row['recipientReedme']['recipientDetails']['phone'] : 'Unknown ',
           count(@$row['recipientReedme']['recipientDetails']['recipientGroups']) > 0 ? groupsNames(@$row['recipientReedme']['recipientDetails']['recipientGroups']) : '',
            !empty($row['recipientReedme']['clientDetails']['client']) ? $row['recipientReedme']['clientDetails']['client']['name'] : 'Unknown',
            !empty($row['recipientReedme']['productDetails']) ? $row['recipientReedme']['productDetails']['name'] : 'Unknown ',
            !empty($courier)?$courier['courier'] :'N/A',
            $row->tracking_id,
            $row->order_id,
           @($row['recipientReedme']['pickrr_order_status']) ?$row['recipientReedme']['pickrr_order_status'] : 'N/A' ,
            getFormatedDate($row->created_at, 'd-m-Y'),
        ];
    }

    public function collection()
    {
    	$startDate = Carbon::createFromFormat('d-m-Y', $this->start_date)->toDateString();
        $endDate = Carbon::createFromFormat('d-m-Y', $this->end_date )->toDateString();

    	 $client = \Auth::guard(getAuthGaurd())->user();
        if(getAuthGaurd() == 'manager'){
                $id = $client->parent_user_id;
        }else{
            $id = $client->id;
        }
         $data = Orders::with('recipientReedme.recipientDetails.recipientGroups.clientDetails.client','recipientReedme.productDetails');
        if(getAuthGaurd() == 'client_admin' ||getAuthGaurd() == 'manager' ){
            $data = $data->whereHas('recipientReedme', function ($query)use($id) {
                $query->where('client_id','=',$id);
            });
        } 
        $data->whereBetween(\DB::raw('DATE(created_at)'), [$startDate,$endDate]);
        return $data->orderBy('id', 'DESC')->cursor();
    }
     public function headings():array{
        return[
            'Id',
            'Recipient Name',
            'Email',
            'Phone',
            'Group',
            'Client Name',
            'Product Name',
            'Courier Name',
            'Tracking ID',
            'Order ID',
            'Status',
            'Created At'
            
        ];
    } 
}
