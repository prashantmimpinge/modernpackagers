<?php

namespace Modules\Cart\Http\Controllers;
// use Modules\Cart\Facades\Cart;
//use Darryldecode\Cart\Cart;
use Darryldecode\Cart\Facades\CartFacade as MyCart;

class CartController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('public.cart.index');
    }

    public function shipping($weight,$dPin){
    	 $url = 'https://track.delhivery.com/api/kinko/v1/invoice/charges/.json?ss=DTO&md=S&cgm='.$weight.'&o_pin=160021&d_pin='.$dPin; 
		  $header = array();
		  $header[] = 'Content-type: application/json';
		  $header[] = 'Accept: application/json';
		  $header[] = 'Authorization: Token fe3718a4cd32a9cb7dae17356fb8368b06aee292';
		  $header[] = 'X-Requested-With: XMLHttpRequest';
		  $ch = curl_init();
      	curl_setopt($ch, CURLOPT_URL, $url);
	     curl_setopt($ch, CURLOPT_HTTPHEADER,$header); 
	     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);    
	     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	     curl_setopt($ch, CURLOPT_POST, 0);
	     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	     $response = curl_exec ($ch);
	     $err = curl_error($ch);  //if you need
	     curl_close ($ch);
	     $res = json_decode($response,true);
	     // $amounts = json_encode($res);
        // return	dd($res[0]['total_amount']);
		MyCart::addShippingMethod($res[0]['total_amount']);
    	// return dd(100+MyCart::getSubTotal());
    	// MyCart::customShippingPrice($dPin);
    	return MyCart::Instance();
     // return $response;
    }
}
