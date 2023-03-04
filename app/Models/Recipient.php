<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Recipient extends Model
{
    use HasFactory;

    // public function recipientGroup(){
    //     return $this->belongsTo('App\Models\RecipientGroup', 'group_id', 'id');
    // }

    protected $guarded = [];

    public function recipientGroupMapping()
    {
        return $this->hasMany('App\Models\RecipientGroupMapping', 'recipient_id');
    }
    public function cityName()
    {
        return $this->belongsTo('App\Models\City', 'city', 'id');
    }
    public function stateName()
    {
        return $this->belongsTo('App\Models\State', 'state', 'id');
    }
    public function countryName()
    {
        return $this->belongsTo('App\Models\Country', 'country', 'id');
    }
    public function emailSettingInfo()
    {
        return $this->belongsTo('App\Models\EmailSetting', 'invited_by_user_id', 'client_admin_id');
    }
    public function recipientGroups()
    {
        return $this->belongsToMany('App\Models\RecipientGroup', 'recipient_group_mapping', 'recipient_id', 'group_id');
    }
    public static function addRecipient($post)
    {
        $user = User::find($post['userid']);
        $clientId = $user['client_id'];
        if (!empty($post['id'])) {

            $recipient = Recipient::where('id', $post['id'])->first();
            // if(Recipient::where(['client_id'=>$clientId, 'email'=>$post['email']])->count() != 1) {
            //     if(Recipient::where(['client_id'=>$clientId, 'email'=>$post['email']])->count() > 0) {
            //         return FALSE;
            //     }
            //  }
            //  if(Recipient::where(['client_id'=>$clientId, 'phone'=>$post['phone']])->count() != 1) {
            //     if(Recipient::where(['client_id'=>$clientId, 'phone'=>$post['phone']])->count() > 0) {
            //         return FALSE;
            //     }
            //  }
            // echo '<pre>';
            // print_r($recipient);
            // exit;

        } else {
            if (Recipient::where(['client_id' => $clientId, 'email' => $post['email']])->count() > 0) {
                return FALSE;
            }
            $recipient = new Recipient();
        }





        $recipient->first_name = ucwords($post['first_name']);
        $recipient->last_name = $post['last_name'];
        $recipient->email = trim($post['email']);
        $recipient->phone = $post['phone'];
        $recipient->address_line_1 = $post['address_line1'];
        $recipient->address_line_2 = $post['address_line2'];
        $recipient->postal_code = $post['postalcode'];
        $recipient->country = $post['country'];
        $recipient->state = $post['state'];
        $recipient->city = $post['city'];
        $recipient->date_of_birth = !empty($post['dob']) ? getFormatedDate($post['dob'], 'Y-m-d') : NULL;
        $recipient->date_of_anniversary = !empty($post['anniversary']) ? getFormatedDate($post['anniversary'], 'Y-m-d') : NULL;
        $recipient->invited_by_user_id = $user['id'];
        $recipient->onboarding_date = !empty($post['onboarding_date']) ? getFormatedDate($post['onboarding_date'], 'Y-m-d') : NULL;

        $recipient->invite_link = 'insta.com';
        $recipient->client_id = $clientId;
        $recipient->is_active = 1;
        $recipient->save();
        return $recipient;
    }
    public static function saveRecipient($post)
    {
        $clientId = \Auth::guard(getAuthGaurd())->user()->client_id;
        if (!empty($post['id'])) {

            $recipient = Recipient::where('id', $post['id'])->first();
            if (Recipient::where(['client_id' => $clientId, 'email' => $post['email']])->count() != 1) {
                if (Recipient::where(['client_id' => $clientId, 'email' => $post['email']])->count() > 0) {
                    return FALSE;
                }
            }
            // echo '<pre>';
            // print_r($recipient);
            // exit;

        } else {
            if (Recipient::where(['client_id' => $clientId, 'email' => $post['email']])->count() > 0) {
                return FALSE;
            }
            $recipient = new Recipient();
        }





        $recipient->first_name = ucwords($post['first_name']);
        $recipient->last_name = $post['last_name'];
        $recipient->email = $post['email'];
        $recipient->phone = $post['phone'];
        $recipient->address_line_1 = $post['address_line1'];
        $recipient->address_line_2 = $post['address_line2'];
        $recipient->postal_code = $post['postalcode'];
        $recipient->country = $post['country'];
        $recipient->state = $post['state'];
        $recipient->city = $post['city'];
        $recipient->date_of_birth = !empty($post['dob']) ? getFormatedDate($post['dob'], 'Y-m-d') : NULL;
        $recipient->date_of_anniversary = !empty($post['anniversary']) ? getFormatedDate($post['anniversary'], 'Y-m-d') : NULL;
        $recipient->date_1 = !empty($post['date_1']) ? getFormatedDate($post['date_1'], 'Y-m-d') : NULL;
        $recipient->date_2 = !empty($post['date_1']) ? getFormatedDate($post['date_2'], 'Y-m-d') : NULL;
        $recipient->date_3 = !empty($post['date_3']) ? getFormatedDate($post['date_3'], 'Y-m-d') : NULL;

        $recipient->invited_by_user_id = \Auth::guard(getAuthGaurd())->user()->id;
        $recipient->invite_link = 'insta.com';
        $recipient->client_id = \Auth::guard(getAuthGaurd())->user()->client_id;
        $recipient->is_active = 1;
        $recipient->save();
        return $recipient;
    }

    public static function getDetailById($id)
    {
        return Recipient::where('id', $id)->first();
    }

    public static function deleteById($id)
    {
        $recipient = Recipient::where('id', $id)->first();
        $recipient->is_deleted = 1;
        $recipient->save();
        //return Recipient::where('id',$id)->delete();
    }

    public static function getAll($post, $isActive = null)
    {
        // \Log::info($post['search']);
        
        if (!empty($post['id'])) {
            $clientAdminId = $post['id'];
        } else {
            $urlPrefix = getAuthGaurd();
            $clientAdminId = \Auth::guard($urlPrefix)->user()->client_id;
        }

 
        $q = Recipient::where(['is_deleted' => 0, 'client_id' => $clientAdminId]);

        if (!empty($post['search'])) {
            $search = $post['search'];
            $q->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        }

        if (!empty($isActive)) {
            $q->where('is_active', 1);
        }
// dd($q->get());
        return $q->orderBy('is_active', 'DESC')->get();
    }

    public static function toggleStatusById($id)
    {
        $data = Recipient::select('is_active')->where(['id' => $id])->first();

        if ($data->is_active) {
            Recipient::where(['id' => $id])->update(['is_active' => 0]);
            return 0;
        } else {
            Recipient::where(['id' => $id])->update(['is_active' => 1]);
            return 1;
        }
    }

    public static function recentUsers()
    {
        if (getAuthGaurd() == 'client_admin' || getAuthGaurd() == 'manager') {
            $id = \Auth::guard(getAuthGaurd())->user()->client_id;
            $recentUsers = Recipient::select('*')->where('client_id', $id)->orderBy('id', 'desc')->limit(10)->get();
            return $recentUsers;
        } else {
            $recentUsers = Recipient::select('*')->orderBy('id', 'desc')->limit(10)->get();
            return $recentUsers;
        }
    }


    public static function getIdByEmail($email){
        $rec_id = Recipient::where('email', $email)->pluck('id')->first();
        // dd($rec_id)
        return $rec_id;

    }
}
