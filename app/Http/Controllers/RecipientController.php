<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\SuperAdmin\AddUpdateRecipientRequest;
use App\Models\Recipient;
use App\Models\RecipientGroup;
use App\Models\RecipientGroupMapping;
use File;
use Response;
use App\Imports\RecipientsImport;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\ShortUrl;
use App\Models\User;
use PDF;

class RecipientController extends Controller
{
    public function addRecipient($id, Request $request)
    {
        $user = User::find($id);
        $logo = getLogo('recipient', $user['client_admin_logo']);
        if (empty($user)) {
            abort(404);
        }
        $userid = $id;


        if ($request->has('groupid')) {
            $group_id =  $request->input('groupid');
            $explode = explode(',', $group_id);
            $expodeCount = count($explode);
            $check = RecipientGroup::whereIn('id', $explode)->where('is_active', 1)->count();

            if ($check != $expodeCount) {
                abort(404);
            }
        } else {
            $group_id = '';
        }

        $state = State::stateByCountry(101);
        $city = City::get();
        $country = Country::where('id', 101)->get(["name", "id"]);
        return view('recipients.add', compact('userid', 'country', 'state', 'city', 'group_id', 'logo'));
    }
    public function thanks()
    {
        return view('recipients.thanks');
    }
    public function addClientRecipient(AddUpdateRecipientRequest $request)
    {
        \DB::beginTransaction();
        try {
            $post = $request->all();
            $data = Recipient::addRecipient($request->all());
            if (empty($data)) {
                return response()->json([
                    'success' => false,
                    'message' => config('constants.RECIPIENT_EMAIL_TAKEN')
                ], 200);
            }
            $postData['recipient_id'] = $data->id;
            if (!empty($post['group_id'])) {
                $explode = explode(',', $post['group_id']);
                $group = $explode;
            } else {
                $group[] = NULL;
            }
            $postData['group_id'] = $group;
            if (!empty($postData['group_id'])) {
                RecipientGroupMapping::saveRecipientGroup($postData);
            }

            \DB::commit();
            return response()->json([
                'success' => true,
                'message' => config('constants.RECIPIENT_ADDED_SUCCESS')
            ], 200);
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')
            ], 200);
        }
    }
    public function shareLink(Request $request)
    {

        $userid = \Auth::guard(getAuthGaurd())->user()->id;
        $url = url('add-recipient/' . $userid);
        if ($request['group_id']) {
            if (is_array($request['group_id'])) {
                $impolde = implode(',', $request['group_id']);
            } else {
                $impolde = $request['group_id'];
            }
            $url = url('add-recipient/' . $userid . "?" . "groupid=" . $impolde);
        }
        $short = ShortUrl::where('destination_url', $url)->first();
        if (empty($short)) {
            $result = genrateShortLink($url);

            return $result;
        } else {
            return $short['default_short_url'];
        }
    }

    public function allRecipientList(Request $request)
    {
        // $post = array(
        //     'search' => 'Shudhanshu'
        // );
        // $data = Recipient::getAll($post);

        
        $data = Recipient::getAll($request->all());
        
        if ($request->ajax()) {
            $data = Recipient::getAll($request->all());


            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('group_name', function ($row) {
                    return count(@$row->recipientGroups) > 0 ? groupsNames(@$row->recipientGroups) : '';
                })
                ->addColumn('action', function ($row) {
                    return  getOptions("recipient", $row->id, $row->is_active);
                })
                ->rawColumns(['action', 'description', 'group_name'])
                ->make(true);
        }
        return view('recipients.index', compact('data'));
    }

    public function view($id)
    {
        $recipient = Recipient::getDetailById($id);

        if (!empty($recipient)) {
            return view('recipients.details', compact('recipient'));
        }
        abort(404);
    }


    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country", $request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state", $request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }
    /* country api */

    public function add()
    {
        $recipientGroup = RecipientGroup::getActiveGroups();
        $groups_id = [];
        $state = State::stateByCountry(101);
        $city = City::get();
        $country = Country::where('id', 101)->get(["name", "id"]);
        return view('recipients.add-edit', compact('recipientGroup', 'groups_id', 'country', 'state', 'city'));
    }

    public function ViewClientRecipient()
    {
        return view('recipients.view-client-recipients',);
    }

    public function edit($id)
    {
        $recipient = Recipient::getDetailById($id);
        $recipientGroup = RecipientGroup::getAll();
        $groups_ids = RecipientGroupMapping::getDetailById($id);
        $groups_arr = [];
        $groups_id = [];

        foreach ($groups_ids as $gr) {
            $groups_arr[$gr['recipient_id']][] = $gr['group_id'];
        }

        if (!empty($groups_arr)) {
            $groups_id = $groups_arr[$gr['recipient_id']];
        }
        // print_r($recipient->recipientGroupMapping[0]->recipientGroup); exit;
        $country = Country::where('id', 101)->get(["name", "id"]);

        // $country = Country::allCountry();
        $state = State::stateByCountry(101);
        $city = City::get();

        if (!empty($recipient)) {
            return view('recipients.add-edit', compact('recipient', 'recipientGroup', 'groups_id', 'country', 'state', 'city'));
        }

        abort(404);
    }

    public function save(AddUpdateRecipientRequest $request)
    {
        \Log::info($request->all());

        \DB::beginTransaction();

        try {
            $post = $request->all();
            $data = Recipient::saveRecipient($request->all());
            if (empty($data)) {
                return response()->json([
                    'success' => false,
                    'message' => config('constants.RECIPIENT_EMAIL_TAKEN')
                ], 200);
            }

            $postData['recipient_id'] = $data->id;
            $postData['group_id'] = !empty($post['group']) ? $post['group'] : NULL;

            if (!empty($postData['group_id'])) {
                RecipientGroupMapping::saveRecipientGroup($postData);
            } else {
                RecipientGroupMapping::where('recipient_id', $data->id)->delete();
            }

            \DB::commit();
            return response()->json([
                'success' => true,
                'message' => config('constants.RECIPIENT_ADDED_SUCCESS')
            ], 200);
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')
            ], 200);
        }
    }

    public function delete($id)
    {
        try {
            Recipient::deleteById($id);

            return response()->json([
                'success' => true,
                'message' => config('constants.RECIPIENT_DELETED_SUCCESS')
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')
            ], 200);
        }
    }

    public function statusRecipient($id)
    {
        try {
            $status = Recipient::toggleStatusById($id);
            if ($status == 1) {
                return response()->json([
                    'success' => true,
                    'message' => config('constants.RECIPIENT_ACTIVE_SUCCESS')
                ], 200);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => config('constants.RECIPIENT_INACTIVE_SUCCESS')
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => config('constants.SOMETHING_WENT_WRONG')
            ], 200);
        }
    }

    public function downloadRecipientSample()
    {
        $filename = 'recipient_upload.xlsx';
        $filepath = public_path('downloads/' . $filename);
        return Response::download($filepath);
    }

    public function importView()
    {
        return view('recipients.bulk-import');
    }

    // public function importRecipient(Request $request)
    // { 
    //     try { 
    //         $data = \Excel::import(new RecipientsImport,$request->bulk_import);
    //         return response()->json(['success' => true,
    //         'message' => config('constants.RECIPIENT_BULKUPLOAD_SUCCESS')
    //         ], 200);
    //     } catch(\Maatwebsite\Excel\Validators\ValidationException $e) {
    //         $failures = $e->failures();

    //         $pdf = PDF::loadView('log-error-pdf', compact('failures'));
    //         return $pdf->download('log-error.pdf');

    //     }
    // }

    ///Creating New Function for Bulk Import
    public function importRecipient(Request $request)
    {

        $import = new RecipientsImport;
        $import->import($request->bulk_import);

        if ($import->failures()->isNotEmpty()) {
            \Log::info($import->failures());
            $failures = $import->failures();
            $pdf = PDF::loadView('log-error-pdf', compact('failures'));
            return $pdf->download('log-error.pdf');
        } else {
            return response()->json([
                'success' => true,
                'message' => config('constants.RECIPIENT_BULKUPLOAD_SUCCESS')
            ], 200);
        }
    }
}
