<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    public static function saveLead($post)
    {
        $lead = new Lead();
        $lead->name = $post['name'];
        $lead->company_name = $post['company_name'];
        $lead->phone = $post['mobile'];
        $lead->email = trim($post['contact_email']);
        $lead->save();

        $data['request'] = 'send_new_lead_mail';
        $data['name'] = ucwords($post['name']);
        $data['email'] = $post['contact_email'];
        $data['from_email'] = \Config::get('constants.FROM_EMAIL');
        $data['subject'] = 'Enquiry received successfully.';
        sendMail($data);
    }

    public static function getAllLeads() {
        return Lead::orderBy('id', 'DESC')->get();
    } 
}
