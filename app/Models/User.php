<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Client;
use App\Jobs\SendEmailJob;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\RoleMaster', 'role_master_id');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_id');
    }
    public function Wallet()
    {
        return $this->belongsTo('App\Models\Wallet', 'user_id');
    }

    public static function saveClientAdmin($post)
    {
        if (!empty($post['id'])) {
            $user = User::where('id', $post['id'])->first();
        } else {
            $user = new User();
        }

        $pass = generateRandomStringToken('password', 6);
        $user->first_name = ucwords($post['first_name']);
        $user->last_name = ucwords($post['last_name']);
        $user->email = trim($post['email']);
        $user->phone = $post['phone'];
        $user->password = bcrypt($pass);
        $user->role_master_id = 3;
        $user->client_id = $post['company_id'];
        $user->parent_user_id = \Auth::guard('super_admin')->user()->id;
        $user->is_active = 1;
        $user->save();

        if (empty($post['id'])) {
            $emailData['request'] = 'send_credentials_mail';
            $emailData['name'] = ucwords($post['first_name'] . ' ' . $post['last_name']);
            $emailData['email'] = $user->email;
            $emailData['from_email'] = \Config::get('constants.FROM_EMAIL');
            $emailData['subject'] = 'Credentials for login in Send.';
            $emailData['loginurl'] = url('/login');
            // $emailData['description'] = 'Congratulations, You have been added in Send as Client Admin here are your credentials : Email <b>'.$post['email'].'</b> and Password <b>'.$pass.'</b>';
            $emailData['email'] = $post['email'];
            $emailData['password'] = $pass;
            $emailData['client_user_id'] = $user->id;
            dispatch(new SendEmailJob($emailData));
        }
    }

    public static function saveManager($post)
    {
        if (!empty($post['user_id'])) {
            $user = User::where('id', $post['user_id'])->first();
        } else {
            $user = new User();
        }

        $pass = generateRandomStringToken('password', 6);
        $user->first_name = ucwords($post['first_name']);
        $user->last_name = ucwords($post['last_name']);
        $user->email = trim($post['email']);
        $user->phone = $post['phone'];
        $user->password = bcrypt($pass);
        $user->role_master_id = 4;
        $user->client_id = \Auth::guard(getAuthGaurd())->user()->client_id;
        $user->parent_user_id = \Auth::guard(getAuthGaurd())->user()->id;
        $user->save();

        if (empty($post['id'])) {
            $emailData['request'] = 'send_credentials_mail';
            $emailData['name'] = ucwords($post['first_name'] . ' ' . $post['last_name']);
            $emailData['email'] = $user->email;
            $emailData['from_email'] = \Config::get('constants.FROM_EMAIL');
            $emailData['subject'] = 'Credentials for login in Send.';
            $emailData['client_user_id'] = $user->id;
            $emailData['recipient_id'] = '';
            $emailData['redeem_link'] = "";
            $emailData['loginurl'] = url('/login');
            // $emailData['description'] = 'Congratulations, You have been added in Send as Client Admin here are your credentials : Email <b>' . $post['email'] . '</b> and Password <b>' . $pass . '</b>';
            $emailData['email'] = $post['email'];
            $emailData['password'] = $pass;
            dispatch(new SendEmailJob($emailData));
        }
    }

    public static function getDetailById($id)
    {
        return User::where('id', $id)->first();
    }

    public static function deleteById($id)
    {
        return User::where('id', $id)->update(['is_deleted' => 1]);
    }

    public static function getAllClientAdmins($client_id)
    {
        return User::where(['is_deleted' => 0, 'client_id' => $client_id])->orderBy('id', 'DESC')->get();
    }

    public static function getAllManagers($client_id)
    {
        return User::where(['is_deleted' => 0, 'client_id' => $client_id, 'role_master_id' => 4])->orderBy('id', 'DESC')->get();
    }

    public static function toggleStatusById($id)
    {
        $data = User::select('is_active')->where(['id' => $id])->first();

        if ($data->is_active) {
            User::where(['id' => $id])->update(['is_active' => 0]);
            return 0;
        } else {
            User::where(['id' => $id])->update(['is_active' => 1]);
            return 1;
        }
    }

    // Account Settings Logo Upload Client Admin
    public static function saveLogo($request)
    {
        $client_id = \Auth::guard('client_admin')->user()->id;
        $user = User::where('id',  $client_id)->first();
        if ($request->hasFile('image')) {
            //$image = $request->file('image');
            //$fileName = uploadFile($image, 'client_admin_logo');
            $fileName = uploads3File('logo', $request);
        }
        $user->client_admin_logo = $fileName;
        $user->save();
    }
}
