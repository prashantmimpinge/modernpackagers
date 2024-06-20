<?php

namespace Modules\Checkout\Http\Controllers;

use Exception;
use Modules\Support\Country;
use Modules\Cart\Facades\Cart;
use Modules\Page\Entities\Page;
use Illuminate\Routing\Controller;
use Modules\Payment\Facades\Gateway;
use Modules\User\Services\CustomerService;
use Modules\Checkout\Services\OrderService;
use Modules\Cart\Http\Middleware\CheckCartStock;
use Modules\Order\Http\Requests\StoreOrderRequest;
use Modules\Cart\Http\Middleware\CheckCouponUsageLimit;
use Modules\Cart\Http\Middleware\RedirectIfCartIsEmpty;
use Modules\User\Entities\Onetimepassword;
use Illuminate\Http\Request;

class CheckoutController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware([
            RedirectIfCartIsEmpty::class,
            CheckCartStock::class,
            CheckCouponUsageLimit::class,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cart = Cart::instance();
        $countries = Country::supported();
        $gateways = Gateway::all();
        $termsPageURL = Page::urlForPage(setting('storefront_terms_page'));
        $shippingcost = (setting('flat_rate_enabled') == 1) ? setting('flat_rate_cost') : 0;
        $default_currency = setting('default_currency');

        return view('public.checkout.create', compact('cart', 'countries', 'gateways', 'termsPageURL', 'shippingcost', 'default_currency'));

        // return view('public.checkout.create', compact('cart', 'countries', 'gateways', 'termsPageURL'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Modules\Order\Http\Requests\StoreOrderRequest $request
     * @param \Modules\User\Services\CustomerService $customerService
     * @param \Modules\Checkout\Services\OrderService $orderService
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request, CustomerService $customerService, OrderService $orderService)
    {
        if (auth()->guest() && $request->create_an_account) {
            $customerService->register($request)->login();
        }

        $order = $orderService->create($request);

        $gateway = Gateway::get($request->payment_method);

        try {
            $response = $gateway->purchase($order, $request);
        } catch (Exception $e) {
            $orderService->delete($order);

            return response()->json([
                'message' => $e->getMessage(),
            ], 403);
        }

        return response()->json($response);
    }
    
    public function checkoutsendOtp(Request $request){

        
        
       /* $request->validate([
            'mobile' => 'required|unique:onetimepasswords',
        ]);*/
        
      
        $FourDigitRandomNumber = mt_rand(1111,9999);
        
       /* $password = new Onetimepassword();
        
        $password->otp = $FourDigitRandomNumber;
        $password->mobile = $request->mobile;
        $password->confirm = '0';
        $password->save();*/
        
        // Account details
    	$apiKey = urlencode('NGI0ZjY2NmMzODczNTg2NDRiNzIzMjUwNmI0MjZjNzY=');
    	
    	// Message details
    	$numbers = $request->mobile;
    	$sender = urlencode('MPKGRS');
    	$message = $FourDigitRandomNumber.' is your ModernPackagers.com account verification code';
     
     
    	// Prepare data for POST request
    	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
     
    	// Send the POST request with cURL
    	$ch = curl_init('https://api.textlocal.in/send/');
    	curl_setopt($ch, CURLOPT_POST, true);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	$response = curl_exec($ch);
    	curl_close($ch);
    	
    	// Process your response here
    	//return dd($response);
    	
    	return response()->json([
    	    'message' => 'success',
    	    'otp' => $FourDigitRandomNumber
    	    ]);
        
    }
    
    public function checkoutcheckOtp(Request $request)
    {
        
        $password = Onetimepassword::where('mobile',$request->phone)->first();
        if($password->otp == $request->popotp){
            $password->confirm = '1';
            $password->save();
            
            return response()->json([
                    'otp' => $password->otp,
                    'error' => false
                ],200);
        }else{
            return response()->json([
                    'error' => true,
                    'msg' => 'Incorrect OTP'
                ],201);
        }
        
        
        
        //print_r($password->confirm);
    }
}
