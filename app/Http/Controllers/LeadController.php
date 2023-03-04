<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Validator;

class LeadController extends Controller
{
    // save contant details
    public function save(Request $request)
    {

        $validator =  Validator::make($request->all(),[
            'name' => 'required',
            'company_name' => 'required',
            'mobile' => 'required|numeric|digits:10',
            'contact_email' => 'required|email'
        ]);

        if(!$validator->passes())
           return response()->json(['errors'=>$validator->errors()->all()]);

        try {
            $check = Lead::where('email', $request->input('contact_email'))->whereDate('created_at', Carbon::today())->first();
            if ($check) {
                return response()->json([
                    'success' => false,
                    'message' => config('constants.LEAD_ADDED_FAIL')
                ], 200);
            } else {
                Lead::saveLead($request->all());
                return response()->json([
                    'success' => true,
                    'message' => config('constants.LEAD_ADDED_SUCCESS')
                ], 200);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
            return response()->json([
                'success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')
            ], 200);
        }
    }

    public function allLeadsList(Request $request)
    {
        if ($request->ajax()) {
            $data = Lead::getAllLeads();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at',  function ($row) {
                    return getFormatedDate($row->created_at, 'd-m-Y');
                })

                ->addColumn('action',  function ($row) {
                    $viewAction = url("super-admin/lead", $row->id);
                    //return '<button class="btn btn-primary"   onClick="comment('.$row->id.')">Comment</button>  <a href="'.$viewAction.'"><button class="btn btn-default">View</button></a>';
                    return  getOptions("lead", $row->id);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('super-admin.leads.index');
    }

    public function saveComment(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'comment' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            Lead::where('id', $request['lead_id'])->update([
                'comment' => $request['comment']
            ]);
            return response()->json(["status" => true, "message" => "Comment submitted successfully"]);
        }
    }
    public function saveStatus(Request $request)
    {
        Lead::where('id', $request['lead_id'])->update([
            'status' => $request['value']
        ]);
        return response()->json(["status" => true, "message" => "status save successfully"]);
    }
    public function leadsDetail($id)
    {
        $lead = Lead::find($id);
        return view('super-admin.leads.detail', compact('lead'));
    }

    public function deleteLead(Request $request, $id)
    {
        try {
            Lead::where('id', $id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Lead has been deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')
            ], 200);
        }
    }
}
