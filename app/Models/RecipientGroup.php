<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class RecipientGroup extends Model
{
    use HasFactory;

    public function groupRecipients(){
        return $this->hasMany('App\Models\RecipientGroupMapping', 'group_id');
    }
    
    public function activegroupRecipients(){
        return $this->hasMany('App\Models\RecipientGroupMapping', 'group_id')->whereHas('recipient', function($q) {
            $q->where('is_active', 1);
       });
    }

    public static function getAll(){
       $client_id = \Auth::guard(getAuthGaurd())->user()->client_id;
        return  RecipientGroup::where(['client_id' => $client_id])->orderBy('id', 'DESC')->get();
    }

    public static function getActiveGroups(){
        $client_id = \Auth::guard(getAuthGaurd())->user()->client_id;
         return  RecipientGroup::where(['client_id' => $client_id,'is_active'=>1])->orderBy('id', 'DESC')->get();
     }
    

    public static function toggleStatusById($id){
        $data = RecipientGroup::select('is_active')->where(['id' => $id])->first();
        if($data->is_active){
            RecipientGroup::where(['id' => $id])->update(['is_active' => 0]);
            return 0;
        }else{
            RecipientGroup::where(['id' => $id])->update(['is_active' => 1]);
            return 1;
        }
    } 

    public static function saveGroup($post)
    {
        if(!empty($post['id'])){
            $RecipientGroup = RecipientGroup::where('id', $post['id'])->first();
        } else {
            $RecipientGroup = new RecipientGroup();
        }
        $RecipientGroup->client_id = \Auth::guard(getAuthGaurd())->user()->client_id;
        $RecipientGroup->group_name = ucwords($post['group_name']);
        $RecipientGroup->save();
    }

    public static function getDetailById($id){
        return RecipientGroup::where('id',$id)->first();
    }
}