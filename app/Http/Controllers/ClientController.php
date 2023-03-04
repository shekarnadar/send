<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\SuperAdmin\AddUpdateClientRequest;
use App\Http\Requests\SuperAdmin\AddUpdateClientAdminRequest;
use App\Models\User;
use App\Models\Client;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use DB;


class ClientController extends Controller
{
    public function allClientsList(Request $request){

        if($request->ajax()){
            $limit = ($request->length) ? $request->length : 10;
            $start = ($request->start) ? $request->start : 0;
            $data = Client::getAllClient($page=true);
            $model = $data->skip($start)->take($limit)->get();

            return DataTables::of($model)
                        ->addIndexColumn()
                        ->addColumn('campaigncounts', function ($row) {
                            $recData = DB::select("SELECT COUNT(*) as total_campaign FROM campaigns WHERE client_id = $row->id"); 
                            return $recData[0]->total_campaign;

                         })
                        ->addColumn('action', function ($row) {
                           return  getOptions("client",$row->id,$row->is_active);
                        })
            ->rawColumns(['action'])
            ->setOffset($start)
            ->setTotalRecords(Client::getAllClientCount())
            ->make(true);
        }
        return view('super-admin.clients.index');
    }

    public function viewClient($id){
        $user = Client::getDetailById($id);
        $clientAdmin = User::where(['client_id'=>$id])->get()->toArray();
        $clientAdminCount = count($clientAdmin);
        $result = array_filter($clientAdmin, function ($item) {
            if ($item['role_master_id'] == 3) {
               return true;
            }

            return false;
        });
        $client_admin_logo = count($result) > 0 ? $result[0]['client_admin_logo'] : '';
        if(!empty($user)){
            return view('super-admin.clients.client-details',compact('user','clientAdminCount','client_admin_logo'));
        }

        abort(404);
    }

    public function addClientDetails($id) {
        $client_id= $id;
        $company_id = $id;
        return view('super-admin.clients.client-admin.add-client-details',compact('client_id','company_id'));
    }


    public function addClient(){
        // $country = Country::allCountry();
        $country = Country::where('id',101)->get(["name", "id"]);
        $state = State::stateByCountry(101);
        $city = City::get();

        $countryId=$stateId=$cityId='';
        return view('super-admin.clients.add-edit',compact('country','state','city','countryId','stateId','cityId'));
    }



    public function editClient($id){
        $country = Country::allCountry();
        $state = State::stateByCountry(101);

        $city = City::get();
        $user = Client::getDetailById($id);

        $countryId = $user['country'];
        $stateId = $user['state'];
        $cityId = $user['city'];

        if(!empty($user)){
            return view('super-admin.clients.add-edit',compact('user','country','state','city','countryId','stateId','cityId'));
        }
        abort(404);
    }

    public function saveClient(AddUpdateClientRequest $request)
    { 
        try {
            Client::saveClient($request->all());
            return response()->json(['success' => true,
                'message' => config('constants.CLIENT_ADDED_SUCCESS')
            ], 200);

        } catch(\Exception $e){
            echo $e->getMessage(); exit;
            return response()->json(['success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')], 200);
        }
    }

    public function viewClientAdmin($id){
        $user = User::getDetailById($id);

        if(!empty($user)){
            return view('super-admin.clients.details',compact('user'));
        }

        abort(404);
    }

    // Save Client Admin
    public function saveClientAdmin(AddUpdateClientAdminRequest $request/*Request $request*/)
    {
        try {
            User::saveClientAdmin($request->all());
            return response()->json(['success' => true,
                'message' => config('constants.CLIENT_ADDED_SUCCESS')
            ], 200);

        } catch(\Exception $e){
            return response()->json(['success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')], 200);
        }
    }

    // Edit client admin
    public function editClientAdmin($client_id,$id){
        $user = User::getDetailById($id);
        $company_id = $client_id;
        $client_id= $id;
        if(!empty($user)){
            return view('super-admin.clients.client-admin.add-client-details',compact('user','client_id','company_id'));
        }
        abort(404);
    }

    //List client admins
    public function clientAdminsAjax($id){
            $data = User::getAllClientAdmins($id);
            return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('recipients', function ($row) {
                            $recData = DB::select("SELECT COUNT(*) as total_rec FROM recipients WHERE invited_by_user_id = $row->id"); 
                            return $recData[0]->total_rec;

                         })
                        ->addColumn('action', function ($row) {
                            $record = "";
                            if($row->is_active == 1){
                                $record .= '<button class="btn btn-danger"  onClick="statusData('.$row->id.')">Deactivate </button>';
                            }else{
                                $record .= '<button class="btn btn-success"  onClick="statusData('.$row->id.')">Activate </button>';
                            }

                            //$record .= ' <a href="'.url('super-admin/view-client-admin', $row->id).'" class="btn btn-default">View</a>';
                            $record .= ' <a href="'.url('super-admin/edit-client-admin/'.$row->client_id.'/'.$row->id).'" class="btn btn-default">Edit</a>';

                            return $record;
                        })
             ->rawColumns(['action'])
            ->make(true);
    }

    public function deleteClient($id)
    {
        try {
                User::deleteById($id);

                return response()->json(['success' => true,
                    'message' => config('constants.CLIENT_ADMIN_DELETED_SUCCESS')
                ], 200);

        } catch(\Exception $e){
            return response()->json(['success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')], 200);
        }
    }


    public function statusClient($id)
    {
        try {
                $status = Client::toggleStatusById($id);
                if($status == 1){
                    return response()->json(['success' => true,
                        'message' => config('constants.CLIENT_ACTIVE_SUCCESS')
                    ], 200);
                }else{
                    return response()->json(['success' => true,
                        'message' => config('constants.CLIENT_INACTIVE_SUCCESS')
                    ], 200);
                }
        } catch(\Exception $e){
            return response()->json(['success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')], 200);
        }
    }

    public function statusClientAdmin($id)
    {
        try {
                $status = User::toggleStatusById($id);
                if($status == 1){
                    return response()->json(['success' => true,
                        'message' => config('constants.CLIENT_ACTIVE_SUCCESS')
                    ], 200);
                }else{
                    return response()->json(['success' => true,
                        'message' => config('constants.CLIENT_INACTIVE_SUCCESS')
                    ], 200);
                }
        } catch(\Exception $e){
            return response()->json(['success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')], 200);
        }
    }

}
