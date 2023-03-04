<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipientGroupMapping extends Model
{
    use HasFactory;

    protected $table = 'recipient_group_mapping';

    public function recipientGroup()
    {
        return $this->belongsTo('App\Models\RecipientGroup', 'group_id', 'id');
    }

    public function recipient()
    {
        return $this->belongsTo('App\Models\Recipient', 'recipient_id', 'id');
    }

    public static function saveRecipientGroup($post)
    {
        RecipientGroupMapping::where('recipient_id', $post['recipient_id']) 
                        ->delete();

        $groupIds = $post['group_id'];
        // IF RECIPIENT GROUP 
        if (!empty($groupIds)) {
            foreach ($groupIds as $id) {
                if (!empty($id)) {

                    //  RecipientGroupMapping::where('recipient_id', $post['recipient_id']) 
                    //     ->delete();

                    $recipientGroup = new RecipientGroupMapping();
                    $recipientGroup->group_id = $id;
                    $recipientGroup->recipient_id = $post['recipient_id'];
                    $recipientGroup->save();
                }
            }
        }
    }

    public static function getDetailById($id)
    {
        return RecipientGroupMapping::where('recipient_id', $id)->get()->toArray();
    }

    public static function groupDetails($group_id)
    {
        $group = RecipientGroupMapping::where('group_id', $group_id)->get();
        return $group;
    }
}
