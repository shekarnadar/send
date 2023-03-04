<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\SuperAdmin\AddUpdateManagerRequest;
use App\Models\User;
use App\Models\City;
use App\Models\State;
use App\Models\Country;


class ManagerController extends Controller
{
    public function allManagerList(Request $request) {
        if($request->ajax()) {
            $client_id = \Auth::guard(getAuthGaurd())->user()->client_id;
            $data = User::getAllManagers($client_id);
            return DataTables::of($data)
                        ->addIndexColumn()                
                        ->addColumn('action', function ($row) {
                            $record = "";
                            if($row->is_active == 1){
                                $record .= '<button class="btn btn-danger"  onClick="statusData('.$row->id.')">Deactivate </button>';
                            }else{
                                $record .= '<button class="btn btn-success"  onClick="statusData('.$row->id.')">Activate </button>';
                            }

                            $record .= ' <button class="btn btn-default" onClick="deleteData('.$row->id.')">
                            Delete
        </button>';
                            $record .= ' <a href="'.url('client-admin/edit-manager/'.$row->id).'" class="btn btn-default">Edit</a>';

                            return $record;
                        })
             ->rawColumns(['action'])
            ->make(true);
        }
        return view('client-admin.managers.index');
    }


    public function addManager() {
        return view('client-admin.managers.add-manager-details');
    }


    public function saveManager(AddUpdateManagerRequest $request)
    {
        try {
           $data = User::saveManager($request->all());
           
            return response()->json(['success' => true,
                'message' => config('constants.MANAGER_ADDED_SUCCESS')
            ], 200);

        } catch(\Exception $e){
            echo $e->getMessage(); exit;
            return response()->json(['success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')], 200);
        }  
    }

    public function viewClient($id){
        $user = Client::getDetailById($id);

        if(!empty($user)){
            return view('super-admin.clients.client-details',compact('user'));
        }
        
        abort(404);
    }

    public function addClientDetails($id) {
        $client_id= $id;
        return view('super-admin.clients.client-admin.add-client-details',compact('client_id'));
    }

    public function edit($id) {
        $user = User::getDetailById($id);
        if(!empty($user)){
            return view('client-admin.managers.add-manager-details',compact('user'));
        }
        abort(404);
    }

    // Save
    public function saveClientAdmin(Request $request)
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

    public function delete($id)
    {
        try {
                User::deleteById($id);

                return response()->json(['success' => true,
                    'message' => config('constants.MANAGER_DELETED_SUCCESS')
                ], 200);

        } catch(\Exception $e){
            return response()->json(['success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')], 200);
        }  
    }


    public function statusManager($id)
    {
        try {
                $status = User::toggleStatusById($id);
                if($status == 1){
                    return response()->json(['success' => true,
                        'message' => config('constants.MANAGER_ACTIVE_SUCCESS')
                    ], 200);
                }else{
                    return response()->json(['success' => true,
                        'message' => config('constants.MANAGER_INACTIVE_SUCCESS')
                    ], 200);
                }
        } catch(\Exception $e){
            return response()->json(['success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')], 200);
        }  
    }

    
    
}
