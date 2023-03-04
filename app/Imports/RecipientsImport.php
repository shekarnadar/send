<?php

namespace App\Imports;

use App\Models\Recipient;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\RecipientGroup;
use App\Models\RecipientGroupMapping;
use App\Rules\CheckGroup;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Rules\ValidPinCode;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;

class RecipientsImport implements OnEachRow, WithValidation, WithHeadingRow, SkipsOnError, SkipsOnFailure
{
    use SkipsErrors, Importable, SkipsFailures;

    public function rules(): array
    {
        return [
            '*.email' => 'required|regex:/(.+)@(.+)\.(.+)/i |unique:recipients,email',
            '*.phone' => 'required|numeric|digits:10|unique:recipients,phone',
            '*.postal' => [
                'nullable',
                'numeric',
                new ValidPinCode,
            ],
            '*.group' => ['required',new CheckGroup]
        ];
    } 


    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();
        if ($rowIndex != 1) {
            $country = $state = $city = 0;
            $postalValidate = pinCode($row['postal']);
            $countryValidate = $postalValidate['PostOffice'][0]['Country'];
            $stateValidate = $postalValidate['PostOffice'][0]['State'];
            $cityValidate = $postalValidate['PostOffice'][0]['District'];

            $dataCountry = Country::select('id')->where(['name' => $countryValidate])->first();

            if (!empty($dataCountry)) {
                $country = $dataCountry['id'];
                $country_skipping = 0;
            } else {
                $country_skipping = 1;
            }
            // check state exists
            if ($country) {
                $dataState = State::select('id')->where(['name' => $stateValidate, 'country' => $country])->first();

                if (!empty($dataState)) {
                    $state = $dataState['id'];
                    $state_skipping = 0;
                } else {
                    $state_skipping = 1;
                }
            } else {
                $country_skipping = 1;
            }

            // check if city exists
            if ($state) {
                $dataCity = City::select('id')->where(['name' => $cityValidate])->first();
                if (!empty($dataCity)) {
                    $city = $dataCity['id'];
                    $city_skipping = 0;
                } else {
                    $city_skipping = 1;
                }
            } else {
                $state_skipping = 1;
            }

            $b_date = intval($row['birthday']);
            $a_date = intval($row['anniversary']);
            $d1_date = intval($row['group']);
            $d2_date = intval($row['date1']);
            $d3_date = intval($row['date2']);
            $clientId = \Auth::guard(getAuthGaurd())->user()->client_id;
            if ($country_skipping == 0 && $state_skipping == 0 && $city_skipping == 0) {
                if (Recipient::where(['email' => $row['email'], 'is_deleted' => 0])->count() == 0) {
                    $recipient = new Recipient();
                    $recipient->first_name = $row['first_name'];
                    $recipient->last_name = $row['last_name'];
                    $recipient->email = $row['email'];
                    $recipient->phone = $row['phone'];
                    $recipient->address_line_1 = !empty($row['address1']) ? $row['address1'] : NULL;
                    $recipient->address_line_2 = !empty($row['address2']) ? $row['address2'] : NULL;
                    $recipient->postal_code = !empty($row['postal']) ? $row['postal'] : NULL;
                    $recipient->country = $country ? $country : NULL;
                    $recipient->state = $state ? $state : NULL;
                    $recipient->city = $city ? $city : NULL;
                    $recipient->date_of_birth = !empty($row['birthday']) ? transformDate($b_date) : NULL;
                    $recipient->date_of_anniversary = !empty($row['anniversary']) ? transformDate($a_date) : NULL;
                    $recipient->date_1 = !empty($row['date1']) ? transformDate($d1_date) : NULL;
                    $recipient->date_2 = !empty($row['date2']) ? transformDate($d2_date) : NULL;
                    $recipient->date_3 = !empty($row['date3']) ? transformDate($d3_date) : NULL;
                    $recipient->invited_by_user_id = \Auth::guard(getAuthGaurd())->user()->id;
                    $recipient->invite_link = 'insta.com';
                    $recipient->client_id = \Auth::guard(getAuthGaurd())->user()->client_id;
                    $recipient->is_active = 1;
                    $recipient->save();
                    $rec_id = $recipient->id;

                    $groups = [];
                    $groupsIds = [];
                    if (!empty($row[12])) {
                        $groups = explode(',', $row[12]);
                    }

                    // check if group exists
                    if (!empty($groups)) {
                        foreach ($groups as $name) {
                            $data = RecipientGroup::select('id')->where(['group_name' => $name, 'client_id' => \Auth::guard(getAuthGaurd())->user()->client_id])->first();

                            if (!empty($data)) {
                                $groupsIds[] = $data['id'];
                            }
                        }
                    }

                    if (!empty($groupsIds)) {
                        $postData['recipient_id'] = $rec_id;
                        $postData['group_id'] = $groupsIds;
                        if (!empty($postData['group_id'])) {
                            RecipientGroupMapping::saveRecipientGroup($postData);
                        }
                    }
                }
            }
        }

        return;

        // $groups = [];
        // $groupsIds= [];
        // if(!empty($row[12])) {
        //     $groups = explode(',',$row[12]);
        // }

        // // check if group exists
        // if(!empty($groups)) {
        //     foreach($groups as $name) {
        //         $data = RecipientGroup::select('id')->where(['group_name' => $name])->first();
        //         if(!empty($data)) {
        //             $groupsIds[]= $data['id'];
        //         }
        //     }
        // }

        // //print_r($groupsIds);
        // // check country exists
        // $country=$state=$city=0;

        // $dataCountry = Country::select('id')->where(['name' => "$row[7]"])->first();
        // if(!empty($dataCountry)) {
        //     $country= $dataCountry['id'];
        // }

        // // check state exists
        // if($country) {
        //     $dataState = State::select('id')->where(['name' => "$row[8]",'country'=>$country])->first();
        //     if(!empty($dataState)) {
        //         $state= $dataState['id'];
        //     }   
        // }

        // // check if city exists
        // if($state) {
        //     $dataCity = City::select('id')->where(['name' => "$row[8]",'state'=>$state])->first();
        //     if(!empty($dataCity)) {
        //         $city= $dataCity['id'];
        //     }   
        // }


        // $b_date = intval($row[10]); 
        // $a_date = intval($row[11]);

        // $clientId = \Auth::guard(getAuthGaurd())->user()->client_id;
        // if(Recipient::where(['client_id'=>$clientId, 'email'=>$row[2]])->count() ==0) {
        //     return new Recipient([
        //         "first_name" => $row[0],
        //         "last_name" => $row[1],
        //         "email" => $row[2],
        //         "phone" => $row[3],
        //         "address_line_1" => $row[4],
        //         "address_line_2" => $row[5],
        //         "postal_code" => $row[6],
        //         "country" => $country ? $country : NULL,
        //         "state" => $state ? $state : NULL,
        //         "city" => $city ? $city : NULL,
        //         "date_of_birth" => !empty($row[10]) ? transformDate($b_date) : NULL,
        //         "date_of_anniversary" => !empty($row[11]) ? transformDate($a_date) : NULL,
        //         "invited_by_user_id" => \Auth::guard(getAuthGaurd())->user()->id,
        //         "invite_link" => 'insta.com',
        //         "client_id" => \Auth::guard(getAuthGaurd())->user()->client_id,
        //         'is_active' => 1
        // ]);
        // }
    }

    public function startRow(): int
    {
        return 2;
    }
}
