<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignProductMapping extends Model
{
    use HasFactory;

    protected $table = 'campaign_product_mapping';

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function eproduct()
    {
        return $this->belongsTo('App\Models\EProduct', 'e_product_id', 'id');
    }

    public static function saveCampaignProduct($post)
    {
        $productIds = explode(',', $post['product_ids']);

        foreach ($productIds as $id) {
            $campProduct = new CampaignProductMapping();

            if ($post['is_egift'] == 1)
                $campProduct->e_product_id = $id;
            else
                $campProduct->product_id = $id;

            $campProduct->campaign_id = $post['campaign_id'];
            $campProduct->is_egift_campaign = $post['is_egift'];
            $campProduct->save();
        }
    }

    public static function campaignRecipientsProductsList($post)
    {
        return CampaignProductMapping::where('campaign_id', $post['id'])->orderBy('id', 'DESC')->get();
    }
}
