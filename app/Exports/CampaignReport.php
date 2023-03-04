<?php

namespace App\Exports;

use App\Models\Campaign;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Models\CampaignRecipient;
use App\Models\CampaignProductMapping;


class CampaignReport implements FromCollection,WithMultipleSheets
{
   	protected $sheets;
    public function __construct($campaign)
    {
    	$this->campaign = $campaign;
    }

    public function array(): array
    {
        return $this->sheets;
    }

    public function sheets(): array
    {
    	$campaign_Recipent = CampaignRecipient::with('logInfo','recipientProductRedeemDetail')->where('campaign_id', $this->campaign[0]['id'])->orderBy('id', 'DESC')->get();
    	$camp_product = CampaignProductMapping::where('campaign_id',$this->campaign[0]['id'])->orderBy('id', 'DESC')->get();
       
        $sheets = [
            new CampaignDetailExport($this->campaign),
            new CampaignRecipentExport($campaign_Recipent),
            new CampaignProductExport($camp_product)
        ];

        return $sheets;
    }
     public function collection(){
    } 
}
