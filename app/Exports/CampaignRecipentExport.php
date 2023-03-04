<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;


class CampaignRecipentExport implements FromCollection,WithHeadings,WithMapping,WithTitle 
{
	public function __construct($campaign_Recipent) 
    {
        $this->campaign_Recipent = $campaign_Recipent;
    }

      public function map($row): array
    {
         $isRedeemed = $row->is_readme;
         $urlRedeem = url($row->redeem_link);
         $link_urlRedeem = $isRedeemed ? '' : $urlRedeem;
                        
        
        return [
            $row['id'],
            $row->recipient->first_name. " ".$row->recipient->last_name,
            $row->recipient->email,
            $row->recipient->phone,
            count(@$row->recipient->recipientGroups) > 0 ? groupsNames(@$row->recipient->recipientGroups) : '',
            $link_urlRedeem,
            ($isRedeemed == 1) ? 'Completed' : 'Pendinng',
            @($row['recipientProductRedeemDetail']['pickrr_order_status']) ?$row['recipientProductRedeemDetail']['pickrr_order_status'] : 'N/A' ,
            @($row->is_sent_email == 1) ? 'Sent' : 'Not Applicable',
            
        ];
    }


    public function headings(): array
    {
        return [
            'S.No',
            'Name',
            'Email',
            'Mobile',
            'Group Name',
            'Gift Link',
            'Redeemed Status',
            'Pickrr Order Status',
            'Email Status'
        ];
    }
     public function collection()
    {
         return $this->campaign_Recipent;
    }
   

    public function title(): string
    {
        return 'Recipent';
    }
}
