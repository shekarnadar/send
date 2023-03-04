<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasOne('App\Models\User', 'client_id', 'id');
    }

    public function country(){
        return $this->belongsTo('App\Models\Country', 'country', 'id');
    }

    public function state(){
        return $this->belongsTo('App\Models\State', 'state', 'id');
    }

    public function city(){
        return $this->belongsTo('App\Models\City', 'city', 'id');
    }

    public static function saveClient($post)
    {
        if(!empty($post['id'])){
            $client = Client::where('id', $post['id'])->first();
        } else {
            $client = new Client();
        }

        $client->address_line_1 = $post['address_line_1'];
        $client->address_line_2 = $post['address_line_2'];        
        $client->postal_code = $post['postal_code'];
        $client->city = $post['city'];
        $client->state = $post['state']; 
        $client->country = $post['country'];
        $client->name = $post['company_name'];
        $client->is_active = 1;
        $client->gstin = $post['gstin'];
        $client->pan = $post['pan'];
        $client = $client->save();
    }

    public static function getAllClient($page = null){
        if($page == true){
            return Client::orderBy('id', 'DESC');
        }else{
            return Client::orderBy('id', 'DESC')->get();
        }
        
    } 

    public static function getAllClientCount(){
        return Client::count();
    } 

    
    public static function toggleStatusById($id){
        $data = Client::select('is_active')->where(['id' => $id])->first();

        if($data->is_active){
            Client::where(['id' => $id])->update(['is_active' => 0]);
            return 0;
        }else{
            Client::where(['id' => $id])->update(['is_active' => 1]);
            return 1;
        }
    } 

    public static function getDetailById($id){
        return Client::where('id',$id)->first();
    } 
    public static function saveWhatsappSetting($data){
        $client_id = \Auth::guard('client_admin')->user()->client_id;
        $token = explode('Bearer',$data['token']);
        if(empty($token[0])){
            $save_token = $token[1];
        }else{
            $save_token = $token[0];
        }
       
        Client::where(['id' => $client_id])->update([
            'url' => $data['url'],
            'token' => $save_token
        ]);
        return 1;
    }   
}
