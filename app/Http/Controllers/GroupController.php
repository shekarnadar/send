<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\RecipientGroup;

class GroupController extends Controller
{
    public function groupsList(Request $request) {
        $recipientGroup = RecipientGroup::getActiveGroups();
        if($request->ajax()){
            $data = RecipientGroup::getAll();
            return DataTables::of($data)
                        ->addIndexColumn()
                         ->addColumn('recipient_count',  function ($row) {
                            return @$row->activegroupRecipients->count();
                        })                
                        ->addColumn('action', function ($row) {
                           return  getOptions("group",$row->id,$row->is_active);
                        })                     
             ->rawColumns(['action'])
            ->make(true);
        }
        return view('client-admin.groups.index',compact('recipientGroup'));
    }

    
    public function statusGroup($id)
    {
        try {
                $status = RecipientGroup::toggleStatusById($id);
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

    public function add() {
        return view('client-admin.groups.add-edit');
    }

    public function save(Request $request) {
        try {
            RecipientGroup::saveGroup($request->all());
            return response()->json(['success' => true,
                'message' => config('constants.GROUP_ADDED_SUCCESS')
            ], 200);

        } catch(\Exception $e){
            echo $e->getMessage(); exit;
            return response()->json(['success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')], 200);
        }  
    }

    public function edit($id){
           
        $group = RecipientGroup::getDetailById($id);
        if(!empty($group)){
            return view('client-admin.groups.add-edit',compact('group'));
        }
        abort(404);
    }
}
