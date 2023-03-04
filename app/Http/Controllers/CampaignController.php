<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\SuperAdmin\AddUpdateCampaignRequest;
use App\Http\Requests\CheckoutRequest;
use App\Models\Campaign;
use App\Models\Product;
use App\Models\Recipient;
use App\Models\CampaignRecipient;
use App\Models\CampaignProductMapping;
use App\Models\RecipientGroup;
use App\Models\ProductImage;
use App\Models\Country;
use App\Models\State;
use App\Models\Wallet;
use App\Models\City;
use App\Models\RecipientProductRedeem;
use App\Models\RecipientGroupMapping;
use App\Models\MessageTemplate;
use App\Models\CampaignRedeemedAmount;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Models\CompanyProductMapping;
use Illuminate\Support\Facades\DB;
use App\Exports\CampaignExport;
use App\Exports\ClientCampagian;
use App\Exports\CampaignReport;
use App\Models\ShortUrl;
use App\Models\Client;
use App\Jobs\SendEmailJob;
use App\Models\EProduct;
use App\Models\Notification;

class CampaignController extends Controller
{
	public function export()
	{
		return \Excel::download(new CampaignExport(), 'Campaign.xlsx');
	}
	public function exportClientCampgian($id)
	{
		return \Excel::download(new ClientCampagian($id), 'ClientCampaign.xlsx');
	}
	public function exportDetail($id)
	{
		$campaign = Campaign::where('id', $id)->get();
		return \Excel::download(new CampaignReport($campaign), 'CampaignDetail.xlsx');
	}
	public function clientCampaignList(Request $request)
	{
		if ($request->ajax()) {

			$data = Campaign::getClientCampaign($request->clicnt_id);
			return DataTables::of($data)
				->addIndexColumn()
				->editColumn('description', '{!!$description!!}')

				->addColumn('created_by_user',  function ($row) {
					return $row['user']['first_name'] . " " . $row['user']['last_name'];
				})
				->addColumn('client_admin',  function ($row) {
					if (getAuthGaurd() == 'super_admin') {
						return $row->clientDetail->name;
					}
				})
				->addColumn('group_name',  function ($row) {
					return $row->group_id == 0  ? 'N/A' : $row['group']['group_name'];
				})
				->addColumn('recipent_count',  function ($row) {
					return $row->campaignRecipient->count();
				})
				->addColumn('total_readme',  function ($row) {
					return $row->totalReadme->count();
				})
				// ->addColumn('reedemedBudget',  function ($row) {
				//     return @$row['reedemedAmount']['amount'];
				// })
				->addColumn('status',  function ($row) {
					$recipent_total = $row->campaignRecipient->count();
					$read_me = $row->totalReadme->count();
					if ($row->approval_status == 0) {
						return 'Pending';
					}
					if ($row->approval_status == 1 && $recipent_total != $read_me) {
						return 'In Process';
					}
					if ($row->approval_status == 2) {
						return 'Rejected';
					}
					if ($row->approval_status == 1 && $recipent_total == $read_me) {
						return 'Completed';
					}
				})
				->addColumn('action', function ($row) {
					return  getOptions("campaign", $row->id, $row->approval_status);
				})
				->rawColumns(['action', 'description', 'created_by_user', 'company_name'])
				->make(true);
		}
		return view('campaigns.clientCampagian', ['client_id' => $request->clicnt_id]);
	}
	public function sendGift(Request $request){
		$compproduct = CompanyProductMapping::where('company_id', \Auth::guard(getAuthGaurd())->user()->client_id)->with('product')->paginate(9);
		if ($request->ajax()) {
			 $search = $request->input('search');
			 $min = $request->input('min');
			 $max = $request->input('max');
			 $isEgift = $request->input('isEgift');
			 if($isEgift == 1){
			 	$compproduct = EProduct::paginate(9);
			 }else{
				 $compproduct = CompanyProductMapping::where('company_id', \Auth::guard(getAuthGaurd())->user()->client_id)->with(['product'=>function($q) use($search,$min,$max){
						if($search){
								$q->where('name','like','%'.$search.'%');
						}
						 if (!empty($min) && !empty($max)) {
	            				$q->whereBetween('price', [$min, $max]);
	        			}
				 }]);
				$compproduct = $compproduct->paginate(9);	
			 }
			 
			return view('sendGift._giftCard',compact('compproduct','isEgift'))->render();
		 }else{
			return view('sendGift.index',compact('compproduct'));  
		 }
	}
	public function allCampaignList(Request $request)
	{
		 
		if ($request->ajax()) {
			$limit = ($request->length) ? $request->length : 10;
			$start = ($request->start) ? $request->start : 0;
			$data = Campaign::getAllCampaign($page = true);
			$model = $data->skip($start)->take($limit)->get();

			return DataTables::of($model)
				->addIndexColumn()
				->editColumn('description', '{!!$description!!}')

				->addColumn('created_by_user',  function ($row) {
					return @$row['user']['first_name'] . " " . @$row['user']['last_name'];
				})
				->addColumn('group_name',  function ($row) {
					return $row->group_id == 0  ? 'N/A' : $row->group->group_name;
				})
				->addColumn('recipent_count',  function ($row) {
					return $row->campaignRecipient->count();
				})
				->addColumn('client_admin',  function ($row) {
					if (getAuthGaurd() == 'super_admin') {
						return $row->clientDetail->name;
					}
				})
				->addColumn('product_type',  function ($row) {
					if ($row->is_egift_campaign == 1)
						return 'eGift';
					else
						return 'Physical Product';
				})
				->addColumn('total_readme',  function ($row) {
					return $row->totalReadme->count();
				})
				// ->addColumn('reedemedBudget',  function ($row) {
				//     return @$row['reedemedAmount']['amount'];
				// })
				->addColumn('status',  function ($row) {
					$recipent_total = $row->campaignRecipient->count();
					$read_me = $row->totalReadme->count();
					if ($row->approval_status == 0) {
						return 'Pending';
					}
					if ($row->approval_status == 1 && $recipent_total != $read_me) {
						return 'In Process';
					}
					if ($row->approval_status == 2) {
						return 'Rejected';
					}
					if ($row->approval_status == 1 && $recipent_total == $read_me) {
						return 'Completed';
					}
				})
				->addColumn('action', function ($row) {
					return  getOptions("campaign", $row->id, $row->approval_status);
				})
				->rawColumns(['action', 'description', 'created_by_user', 'company_name'])
				->setOffset($start)
				->setTotalRecords(getTotalCampaingsCount())
				->make(true);
		}
		return view('campaigns.index');
	}

	public function view($id)
	{
		$date = Carbon::now();
		$carbon = date('Y-m-d', strtotime($date));

		$reedemedBudget = CampaignRedeemedAmount::where('campaign_id', $id)->sum('amount');
		$campaign = Campaign::getDetailById($id);
		if (empty($campaign)) {
			abort(404);
		}
		$campRecipent =  $campaign->campaignRecipient->count();
		$read_me = $campaign->totalReadme->count();
		if (!empty($campaign)) {
			return view('campaigns.details', compact('campaign', 'reedemedBudget', 'carbon', 'campRecipent', 'read_me'));
		}
		abort(404);
	}

	public function updateCampaignProduct($id)
	{
		$id = $id;
		$camp_ids = CampaignProductMapping::where('campaign_id', $id)->pluck('product_id')->toArray();
		return view('campaigns.updateProduct', compact('id', 'camp_ids'));
	}
	
	public function saveCampagianProduct(Request $request)
	{
		$count = CampaignRecipient::where('campaign_id', $request['id'])->pluck('id')->count();

		$data = explode(",", $request->product_ids);
		$checkData = $request['checkedData'];
		$explode = explode(',', $checkData);
		$array_diff = array_diff($explode, $data);

		$newdata = Product::whereIn('id', $data)->get();
		$productMaxPrice = collect($newdata)->flatten()->max('price');
		$camp_update['budget'] = $count  * $productMaxPrice;
		$camp_update['maxprice'] = $productMaxPrice;
		Campaign::where('id', $request['id'])->update($camp_update);
		foreach ($data as $value) {
			$check = CampaignProductMapping::where('product_id', $value)->where('campaign_id', $request['id'])->first();
			if (empty($check)) {
				$campProduct = new CampaignProductMapping();
				$campProduct->product_id = $value;
				$campProduct->campaign_id = $request['id'];
				$campProduct->save();
			}
		}
		foreach ($array_diff as $value) {
			CampaignProductMapping::where('product_id', $value)->where('campaign_id', $request['id'])->delete();
		}
		return redirect(getUrl() . 'view-campaign/' . $request['id']);
	}

	public function updateCampaignRecipent($id)
	{
		$campaign = Campaign::select('group_id', 'recipient_type', 'maxprice')->find($id);
		$recipient_type = $campaign['recipient_type'];
		$group_id = $campaign['group_id'];
		$max_price = $campaign['maxprice'];
		$getRecipent = CampaignRecipient::where('campaign_id', $id)->pluck('recipient_id')->toArray();

		$recipients = Recipient::getAll(null, true);
		$recipientGroup = RecipientGroup::getActiveGroups();
		return view('campaigns.update-recipent', compact('recipients', 'recipientGroup', 'id', 'getRecipent', 'recipient_type', 'group_id', 'max_price'));
	}

	public function saveCampagianRecipent(Request $request)
	{
		$checkData = $request['checkedData'];
		$explode = explode(',', $checkData);
		$selectedData = explode(',', $request['recipient_id']);
		$array_diff = array_diff($explode, $selectedData);

		campaignRecipient::updateRecipent($request, $array_diff);
		return redirect(getUrl() . 'view-campaign/' . $request['campaign_id']);
	}
	public function add(Request $request)
	{
		//    dd($request->all());

		if (getAuthGaurd() == 'client_admin' || getAuthGaurd() == 'manager') {
			$userId = \Auth::guard(getAuthGaurd())->user()->id;
			$wallet = Wallet::where('user_id', $userId)->first();
			$walletAmount = isset($wallet->amount) ? $wallet->amount : 0;
			$availableBalance = (@$wallet->availableBalance == 0) ? $walletAmount : $wallet->availableBalance;
			// $walletAmount = isset($wallet->amount) ? $wallet->amount : 0;
			// $maximumBudget = Campaign::where('created_by_user_id',$userId)->sum('budget');
			// //add by anmol
			// $newpendingAmount = $maximumBudget;
			// $redeemAmount = CampaignRedeemedAmount::where('client_id',$userId)->sum('amount');
			// $spentAmount = isset($redeemAmount) ? $redeemAmount : 0;
			// $pendingAmount = $newpendingAmount - $redeemAmount;
			// $availableBalance = $walletAmount -  $newpendingAmount + $pendingAmount;
			// $pendingAmount = $pendingAmount -$pendingAmount;
			$availableBalance = 0; // ($wallet->availableBalance == 0) ? $walletAmount : $wallet->availableBalance;
			return view('campaigns.step-1', compact('availableBalance'));
		}
		abort(404);
	}

	public function changestatusCampaign($id, $status)
	{
		\DB::beginTransaction();
		try {
			$status = Campaign::approveRejectCampaign($id, $status);
			if ($status == 1) {
				\DB::commit();
				return response()->json([
					'success' => true,
					'message' => config('constants.CAMPAIGN_STATUS')
				], 200);
			} else {
				\DB::rollBack();
				return response()->json([
					'success' => false,
					'message' => config('constants.SOMETHING_WENT_WRONG')
				], 200);
			}
		} catch (\Exception $e) {
			\Log::info($e);
			\DB::rollBack();
			return response()->json([
				'success' => false,
				'message' => config('constants.SOMETHING_WENT_WRONG')
			], 200);
		}
	}

	public function step2(Request $request)
	{
		$prevFormData = $request->all();
		$recipients = Recipient::getAll(null, true);
		$recipientGroup = RecipientGroup::getActiveGroups();

		/*************check for campaign  Available Amount**************/
		$productMaxPrice =  Product::maxPriceOfProducts($request->product_ids);
		$userId = \Auth::guard(getAuthGaurd())->user()->id;
		$wallet = Wallet::where('user_id', $userId)->first();
		$availableBalance = 0; // ($wallet['availableBalance'] == 0 ) ? $wallet->amount : $wallet['availableBalance']; 
		// $walletAmount = isset($wallet->amount) ? $wallet->amount : 0;
		// $maximumBudget = Campaign::where('created_by_user_id',$userId)->sum('budget');
		// //add by anmol
		// $newpendingAmount = $maximumBudget;
		// $redeemAmount = CampaignRedeemedAmount::where('client_id',$userId)->sum('amount');
		// $spentAmount = isset($redeemAmount) ? $redeemAmount : 0;
		// $pendingAmount = $newpendingAmount - $redeemAmount;
		// $availableBalance = $walletAmount -  $newpendingAmount + $pendingAmount;
		// $pendingAmount = $pendingAmount -$pendingAmount;

		if (getAuthGaurd() == 'client_admin' || getAuthGaurd() == 'manager') {
			return view('campaigns.step-2', compact('prevFormData', 'recipients', 'recipientGroup', 'availableBalance', 'productMaxPrice'));
		}
		abort(404);
	}

	public function step3(Request $request)
	{
		$userId = \Auth::guard(getAuthGaurd())->user()->client_id;
		$client = Client::select('url', 'token')->where('id', $userId)->first();
		$data['url'] = $client['url'];
		$data['token'] = $client['token'];

		$whatsappTemplate = getTemplate($data);
		if ($whatsappTemplate == 0) {
			$whatsappData = false;
		} else {
			$whatsappData = true;
		}
		//$explode = explode(',',$request->recipient_id);
		$explode = explode(',', $request->recipient_id);

		// if(!empty($request->recipient_id)){
		//     $recpCount = Recipient::whereIn('id', $explode)->get();
		// }

		$recpCount = count($explode);
		$data = explode(",", $request->product_ids);
		$newdata = Product::whereIn('id', $data)->get();
		$productMaxPrice = collect($newdata)->flatten()->max('price');
		$group = RecipientGroupMapping::groupDetails($request->group_id);

		if (!empty($recpCount)) {
			$budget =  $recpCount * $productMaxPrice;
		} else {
			$budget =  $group->count() * $productMaxPrice;
		}

		$prevFormData = $request->all();

		if ($prevFormData['recipient_type'] == 'individual') {
			$prevFormData['recipient_id'] = $prevFormData['recipient_id'];
		}
		$templates = MessageTemplate::getDetails();

		if (getAuthGaurd() == 'super_admin') {
			return view('super-admin.campaigns.step-3');
		} else {
			return view('campaigns.step-3', compact('prevFormData', 'templates', 'budget', 'productMaxPrice', 'whatsappTemplate', 'whatsappData'));
		}
		abort(404);
	}

	function getEmailTemplate($id)
	{
		$templates = MessageTemplate::getDetails($id);
		return response()->json([
			'success' => true,
			'data' => $templates
		], 200);
	}

	public function saveCampaignFinalStep(Request $request)
	{
		if ($request->input('email')) {
			$validated = $request->validate([
				'subject' => 'required'
			]);
		}
		\DB::beginTransaction();
		try {
			$post = $request->all();

			$campData = Campaign::saveCampaign($post);
			$post['campaign_id'] = $campData->id;

			CampaignRecipient::saveCampaignRecipient($post);

			CampaignProductMapping::saveCampaignProduct($post);

			\DB::commit();

			return response()->json([
				'success' => true,
				'message' => config('constants.CAMPAIGN_ADDED_SUCCESS')
			], 200);
		} catch (\Exception $e) {
			$error = $e->getMessage() . ' on line ' . $e->getLine();
			echo $error;
			\Log::info($e);
			exit;
			\DB::rollBack();
			return response()->json([
				'success' => false,
				'message' => config('constants.SOMETHING_WENT_WRONG')
			], 200);
		}
	}

	public function listname()
	{
		return view('super-admin.recipients.list-name',);
	}

	public function Addlistname()
	{
		return view('super-admin.recipients.add-list-name',);
	}

	public function Upload()
	{
		return view('super-admin.recipients.upload-recipient',);
	}


	public function edit($id)
	{
		$campaign = Campaign::getDetailById($id);

		if (!empty($campaign)) {
			return view('super-admin.campaigns.add-edit', compact('campaign'));
		}

		abort(404);
	}

	public function save(AddUpdateCampaignRequest $request)
	{
		try {
			Campaign::saveProduct($request->all());

			return response()->json([
				'success' => true,
				'message' => config('constants.CAMPAIGN_ADDED_SUCCESS')
			], 200);
		} catch (\Exception $e) {
			return response()->json([
				'success' => false,
				'message' => config('constants.SOMETHING_WENT_WRONG')
			], 200);
		}
	}

	public function delete($id)
	{
		try {
			Campaign::deleteById($id);

			return response()->json([
				'success' => true,
				'message' => config('constants.CAMPAIGN_DELETED_SUCCESS')
			], 200);
		} catch (\Exception $e) {
			return response()->json([
				'success' => false,
				'message' => config('constants.SOMETHING_WENT_WRONG')
			], 200);
		}
	}
	function showUpdateProducts(Request $request)
	{
		$camp_id = $request['camp_id'];
		$camp_ids = CampaignProductMapping::where('campaign_id', $camp_id)->pluck('product_id')->toArray();
		$data = Product::getAll(null, $request->all())->get();
		$compproduct = CompanyProductMapping::where('company_id', \Auth::guard(getAuthGaurd())->user()->client_id)->pluck('product_id')->toArray();


		$productsHtml = '';
		if (!empty($data)) {
			foreach ($data as $pro) {
				if (in_array($pro->id, $camp_ids)) {
					$checked = 'checked';
				} else {
					$checked = '';
				}
				if ($pro->visibility == 1) {
					if (in_array($pro->id, $compproduct)) {
						$isshowing = true;
					} else {
						$isshowing = false;
					}
				} else {
					$isshowing = true;
				}
				if ($isshowing == false) {
					$productsHtml .= '
					<div class="list-item col-md-3">
						<div class="card o-hidden mb-4 d-flex flex-column">
							<div class="list-thumb d-flex">
							  <img alt="" src="' . getImage(@$pro->productDefaultImage->image, 'product') . '"/>
							</div>
							<div class="flex-grow-1 d-bock">
								<div
									class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
									<a class="w-40 w-sm-100" href="javascript:void(0)">
										<div class="item-title">
										' . $pro->name . '
										</div>
									</a>
									<p class="m-0 text-muted text-small w-15 w-sm-100">
										₹' . $pro->price . '
									</p>
									<p>
									<input type="checkbox" class="addPro" value=' . $pro->id . ' onclick="addProduct(' . $pro->id . ',this)" ' . $checked . '>
									</p>
								</div>
							</div>
						</div>

					</div>';
				}
			}
		}
		echo $productsHtml;
	}

	function showProducts(Request $request)
	{
		$post = $request->all();
		if ($request->egift == 'egift') {
			$type = 'egift';
			//fetch e-product listing
			$data = EProduct::getAllProducts($post);
			$compproduct = [];
		} else {
			$type = 'product';
			$data = Product::getAll(null, $request->all())->get();
			$compproduct = CompanyProductMapping::where('company_id', \Auth::guard(getAuthGaurd())->user()->client_id)->pluck('product_id')->toArray();
		}
		return view('campaigns._product_card', compact('data', 'type', 'compproduct'));
	}

	// view campaign recipients
	public function campaignRecipientsList(Request $request)
	{
		if ($request->ajax()) {
			$data =  CampaignRecipient::campaignRecipientsList($request->all());
			return DataTables::of($data)
				->addIndexColumn()
				->addColumn('redeem_links',  function ($row) {
					$isRedeemed = $row->recipientProductRedeem->where('is_redeemed', 1)->first();
					$shortData  = ShortUrl::where('default_short_url', $row->urlkey)->first();


					$urlRedeem = url($shortData['default_short_url']);


					//$link_urlRedeem = $isRedeemed ? 'javascript:void(0)' : $urlRedeem;
					$link_urlRedeem = $isRedeemed ? 'javascript:void(0)' : url($row->redeem_link);
					if ($isRedeemed)
						return ' <a href="' . $link_urlRedeem . '"  class="btn btn-default">' . $urlRedeem . '</a>';
					else
						return ' <a href="' . $link_urlRedeem . '" target="_blank" class="btn btn-default">' . $urlRedeem . '</a>';
				})
				->addColumn('redeem_status', function ($row) {
					// $isRedeemed = $row->recipientProductRedeem->where('is_redeemed',1)->first();
					// return !empty($isRedeemed) ? 'Redeemed' : 'Not Redeemed';

					// $isRedeemed = $row->recipientProductRedeem->where('is_redeemed',1)->first();
					return $row->is_readme == 1 ? 'Redeemed' : 'Not Redeemed';
				})
				->addColumn('created_by_user',  function ($row) {
					return $row->recipient->first_name . " " . $row->recipient->last_name;
				})
				->addColumn('email',  function ($row) {
					return $row->recipient->email;
				})
				->addColumn('group_name', function ($row) {
					return count(@$row->recipient->recipientGroups) > 0 ? groupsNames(@$row->recipient->recipientGroups) : '';
				})
				->addColumn('log_status',  function ($row) {
					if (!empty($row->logInfo)) {
						return !empty($row->is_sent_email == 1) ? 'Sent' : 'Not Applicable';
					}
				})->addColumn('is_sent_whatsapp',  function ($row) {
					if (!empty($row->is_sent_whatsapp)) {
						return !empty($row->is_sent_whatsapp == 1) ? 'Sent' : 'Not Applicable';
					}
				})->addColumn('action', function ($row) {
					$record = "";
					$urlPrefix = '';
					$rec = "recid_" . $row->recipient_id;
					if ($row->is_readme == 0) {
						$record .= ' <button onClick="resend(' . $row->campaign_id . ',' . $row->recipient_id . ')" class="btn btn-default" id=' . $rec . '>Resend</button>';
						return $record;
					}
				})

				->rawColumns(['action', 'created_by_user', 'redeem_links', 'group_name'])
				->make(true);
		}
	}

	// Campaign recipient product list
	public function campaignRecipientsProductsList(Request $request)
	{

		if ($request->ajax()) {
			$data =  CampaignProductMapping::campaignRecipientsProductsList($request->all());
			$isGift = $request->input('isGift');

			return DataTables::of($data)
				->addIndexColumn()
				->addColumn('product_name',  function ($row) use ($isGift) {
					if ($isGift == 1) {
						return $row->eproduct->name;
					} else {
						return $row->product->name;
					}
				})
				->addColumn('product_description',  function ($row) use ($isGift) {
					if ($isGift == 1) {
						return $row->eproduct->description;
					} else {
						return $row->product->description;
					}
				})
				->addColumn('product_price',  function ($row) use ($isGift) {
					if ($isGift == 1) {
						return $row->eproduct->price;
					} else {
						return $row->product->price;
					}
				})
				->addColumn('product_code',  function ($row) use ($isGift) {
					if ($isGift == 1) {
						return $row->eproduct->sku;
					} else {
						return $row->product->code;
					}
				})
				->addColumn('action', function ($row) use ($isGift) {
					$record = "";
					$urlPrefix = '';
					if (getAuthGaurd() == 'super_admin') {
						$urlPrefix = 'super-admin';
					} else if (getAuthGaurd() == 'client_admin') {
						$urlPrefix = 'client-admin';
					}
					if ($isGift == 1) {
						$viewAction = url($urlPrefix . "/view-product?type=egift", $row->e_product_id);
					} else {
						$viewAction = url($urlPrefix . "/view-product", $row->product_id);
					}
					$editAction = url($urlPrefix . "/edit-campaign", $row->id);
					$record .= ' <a href="' . $viewAction . '" class="btn btn-default">View</a>';
					return $record;
				})
				->rawColumns(['action', 'product_name', 'product_description', 'product_price'])
				->make(true);
		}
	}

	public function redeemGiftList($link)
	{
		$data = CampaignRecipient::getDetailsByRedeemLink($link);

		$isRedeemed = $data->recipientProductRedeem->where('is_redeemed', 1)->first();
		$campagian_id = $data['campaign_id'];

		//$client_admin_logo = $this->getClientLogo($campagian_id);

		$client_admin_logo = $this->getClientLogo($campagian_id);
		$camp = campaign::where('id', $campagian_id)->first();

		if (!empty($isRedeemed)) {
			return view('redeem.gift-under-process');
			// abort(404);
		}

		if (!empty($data)) {
			$products =  @$data->campaign->campaignProduct;
			return view('redeem.redeem-gift-list', compact('products', 'link', 'client_admin_logo', 'camp'));
		}

		abort(404);
	}

	public function redeemProductDetails($link, $id)
	{

		$data = CampaignRecipient::getDetailsByRedeemLink($link);

		$isRedeemed = $data->recipientProductRedeem->where('is_redeemed', 1)->first();

		$campagian_id = $data['campaign_id'];

		$client_admin_logo = $this->getClientLogo($campagian_id);


		if (!empty($isRedeemed)) {
			return view('redeem.gift-under-process');
			// abort(404);
		}

		$productDetails =  Product::getDetailById($id);

		if (!empty($productDetails)) {
			return view('redeem.product-details', compact('productDetails', 'link', 'client_admin_logo'));
		}
		abort(404);
	}

	public function redeemProductCheckout($link, $id)
	{
		$productDetails = Product::getDetailById($id);
		$campaignRecipient = CampaignRecipient::getDetailsByRedeemLink($link);
		$campagian_id = $campaignRecipient->campaign_id;

		$client_admin_logo = $this->getClientLogo($campagian_id);


		$isRedeemed = $campaignRecipient->recipientProductRedeem->where('is_redeemed', 1)->first();



		if (!empty($isRedeemed)) {
			return view('redeem.gift-under-process');
			// abort(404);
		}

		$country = Country::allCountry();
		$state = State::stateByCountry(101);
		$city = City::get();

		$recipient = @$campaignRecipient->recipient;

		if (!empty($productDetails)) {
			return view('redeem.checkout', compact('productDetails', 'link', 'country', 'state', 'city', 'campaignRecipient', 'recipient', 'client_admin_logo'));
		}
		abort(404);
	}

	public function getClientLogo($id)
	{
		$client = campaign::find($id);

		$user = \App\Models\User::find($client['created_by_user_id']);

		$client_admin_logo = $user['client_admin_logo'];

		if (empty($client_admin_logo)) {
			$logoUrl = url('assets/images/send-logo.jpeg');
		} else {
			$logoUrl = getImage($client_admin_logo, 'logo');
		}
		return $logoUrl;
	}
	public function saveRedeem(CheckoutRequest $request)
	{
		try {

			$campaignRecipient = CampaignRecipient::getDetailsByRedeemLink($request->link);
			$isRedeemed = $campaignRecipient->recipientProductRedeem->where('is_redeemed', 1)->first();
			if (!empty($isRedeemed)) {
				return response()->json([
					'success' => false,
					'message' => 'Product is already redeemed.'
				], 200);
			}

			/* reeemed amount save */
			CampaignRecipient::where('id', $request->campaign_recipient_id)->update([
				'is_readme' => 1
			]);
			$product = Product::productPrice($request->product_id);
			$client = campaign::getDetailById($campaignRecipient['campaign_id']);
			$request['amount'] = $product->price;
			$request['campaign_id'] = $campaignRecipient['campaign_id'];
			$request['client_id'] = $client->created_by_user_id;
			$productDetails = RecipientProductRedeem::saveRedeem($request->all());



			///////// saving data to notifactions table
			$data['user_id'] = $client->created_by_user_id;
			$data['to_id'] = $campaignRecipient->recipient_id;
			$data['company_id'] = $client->campaign->client_id;
			$data['type'] = 'redeem';
			$data['title'] = 'Gift Redeemed';
			$data['description'] = 'Gift Redeemed By ' . $request->email;

			Notification::saveNotification($data);

			return response()->json([
				'success' => true,
				'message' =>  config('constants.PRODUCT_REDEEMED_SUCCESS')
			], 200);
		} catch (\Exception $e) {
			return response()->json([
				'success' => false,
				'message' =>  $e->getMessage() . config('constants.SOMETHING_WENT_WRONG')
			], 200);
		}
	}

	public function redeemThankyou()
	{
		return view('redeem.thankyou');
	}


	public function redeemAllAutomatically($id)
	{
		try {
			$campaign = Campaign::where('id', $id)->first();

			$allCampaignRecipients = CampaignRecipient::where('campaign_id', $campaign->id)->get();

			foreach ($allCampaignRecipients as $campaignRecipient) {
				$request = [];

				// $campaignRecipient = CampaignRecipient::getDetailsByRedeemLink($request->link);
				$isRedeemed = $campaignRecipient->recipientProductRedeem->where('is_redeemed', 1)->first();

				// if(empty($isRedeemed)){
				/* reeemed amount save */
				CampaignRecipient::where('id', $campaignRecipient->id)->update([
					'is_readme' => 1
				]);

				$campProduct = CampaignProductMapping::where('campaign_id', $campaign->id)->first();

				$product = Product::productPrice($campProduct->product_id);
				$client = Campaign::getDetailById($campaignRecipient['campaign_id']);

				$recipientDetails = Recipient::where('id', $campaignRecipient->recipient_id)->first();

				$request['amount'] = $product->price;
				$request['campaign_id'] = $campaignRecipient['campaign_id'];
				$request['client_id'] = $client->created_by_user_id;


				$request['recipient_id'] = $campaignRecipient->recipient_id;
				$request['product_id'] = $campProduct->product_id;
				$request['campaign_recipient_id'] = $campaignRecipient->id;

				$request['postal_code'] = $recipientDetails->postal_code;
				$request['first_name'] = $recipientDetails->first_name;
				$request['last_name'] = $recipientDetails->last_name;
				$request['email'] = $recipientDetails->email;
				$request['phone'] = $recipientDetails->phone;
				$request['country'] = $recipientDetails->country;
				$request['state'] = $recipientDetails->state;
				$request['city'] = $recipientDetails->city;
				$request['address'] = $recipientDetails->address_line_1;

				$productDetails = RecipientProductRedeem::saveRedeem($request);
				// }
			}
		} catch (\Exception $e) {
			// return response()->json(['success' => false,
			//     'message' =>  $e->getMessage().config('constants.SOMETHING_WENT_WRONG')], 200);
		}
	}
	public function campaignResend(Request $request)
	{

		$campdata = Campaign::with('clientDetail', 'user')->where(['id' => $request['id']])->first();
		$data = CampaignRecipient::with('recipient')->where('campaign_id', $request->id)->where('recipient_id', $request->recipent_id)->first();

		if ($campdata->is_whatsapp == 1) {
			$urlkey = $data['urlkey'];
			$shortData = DB::select("SELECT * FROM short_urls WHERE default_short_url = '$urlkey'");
			$urlRedeem = url($shortData[0]->default_short_url);
			$sendMessage['phone'] = $data['recipient']['phone'];
			$sendMessage['redeem_link'] = $urlRedeem;
			$sendMessage['name'] = ucwords($data['recipient']['first_name'] . ' ' . $data['recipient']['last_name']);
			$sendMessage['client_user_id'] = $campdata['clientDetail']['id'];
			$sendMessage['recipient_id'] = $data['recipient']['id'];
			$sendMessage['campaign_id'] = $request['id'];
			$sendMessage['template_name'] = $campdata['template_name'];
			$sendMessage['broadcast_name'] = $campdata['broadcast_name'];
			$sendMessage['url'] = $campdata['clientDetail']['url'];
			$sendMessage['token'] = $campdata['clientDetail']['token'];
			sendWhatsappMessage($sendMessage);
		}

		if ($campdata->is_mail == 1) {
			$emailData['request'] = 'send_redeem_gift_link_mail';
			$emailData['name'] = ucwords($data['recipient']['first_name'] . ' ' . $data['recipient']['last_name']);
			$emailData['email'] = trim($data['recipient']['email']);
			if (empty($campdata['subject']) || $campdata['subject'] == 'NULL') {
				$emailData['subject'] = 'Happy Diwali From Ek Matra (You have received a Gift)';
			} else {
				$emailData['subject'] = $campdata['subject'];
			}
			$emailData['client_name'] = $campdata->clientDetail->name;
			$emailData['redeem_link'] = url($data['redeem_link']);
			$emailData['client_user_id'] = $campdata['clientDetail']['id'];
			$emailData['recipient_id'] = $data['recipient']['id'];
			$emailData['campaign_id'] = $request['id'];
			$description  = $campdata['description'];
			if (empty($campdata['user']['client_admin_logo']) || $campdata['user']['client_admin_logo'] == 'NULL') {
				$emailData['logo'] = NULL;
			} else {
				$emailData['logo'] = getImage($campdata['user']['client_admin_logo'], "logo");
			}
			$emailData['email_description'] = emilDescription($campdata['template_id'], $data['recipient']['first_name'], $campdata['clientDetail']['name'], $data['recipient']['last_name'], $campdata['description']);
			dispatch(new SendEmailJob($emailData));
		}
		return response()->json([
			'success' => true,
			'message' =>  'Resend sucessfully'
		], 200);
	}

	public function manualRedeem(Request $request)
	{
		$recipent = CampaignRecipient::where('id', $request->campaign_recipient_id)->first();
		$count = count(@$recipent->campaign->campaignProduct);

		return response()->json([
			'success' => true,
			'url' =>  url($recipent->redeem_link)
		], 200);
	}

	public function campPreview($id)
	{
		$userId = \Auth::guard(getAuthGaurd())->user()->client_id;
		$client = Client::select('url', 'token')->where('id', $userId)->first();
		$data['url'] = $client['url'];
		$data['token'] = $client['token'];

		$whatsappTemplate = getTemplatePreview($data, $id);
		$findwords = $whatsappTemplate['customParams'];
		$words = [];
		foreach ($findwords as $value) {
			$words[] = "{{" . $value['paramName'] . "}}";
		}
		$replaceWords = [];
		foreach ($words as $key => $value) {
			$replaceWords[] =  $whatsappTemplate['customParams'][$key]['paramValue'];
		}
		$newPhrase = str_replace($words, $replaceWords, $whatsappTemplate['bodyOriginal']);
		echo $newPhrase;
		// $replaceWords   = [$first_name, $client_name];
		// print_r($words);
	}
	public function changeSession($id)
	{
		switch ($id) {
			case ('camp'):
				\Session::put('campaign_count', 0);
				break;
			case ('lead'):
				\Session::put('campaign_count', 0);
				break;
			case ('order'):
				\Session::put('order_count', 0);
				break;
			case ('redeemed'):
				\Session::put('redeemed_count', 0);
				break;
			case ('log'):
				\Session::put('log_count', 0);
				break;
			default:
		}
	}
}
