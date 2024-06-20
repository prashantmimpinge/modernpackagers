<?php

namespace Modules\User\Http\Controllers;

use Exception;
use Modules\Page\Entities\Page;
use Modules\User\Entities\User;
use Modules\User\Entities\Onetimepassword;
use Modules\User\LoginProvider;
use Illuminate\Support\Facades\Cache;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Modules\User\Http\Requests\PhoneRequest;

class AuthController extends BaseAuthController
{
    /**
     * Where to redirect users after login..
     *
     * @return string
     */
    protected function redirectTo()
    {
        return route('account.dashboard.index');
    }

    /**
     * The login URL.
     *
     * @return string
     */
    protected function loginUrl()
    {
        return route('login');
    }

    /**
     * Show login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('public.auth.login', [
            'providers' => LoginProvider::enabled(),
        ]);
    }
    public function postPhone(PhoneRequest $request)
    {
        $registeredUser = $this->auth->registerAndActivate([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => str_random(),
        ]);

        $this->assignCustomerRole($registeredUser);

        auth()->login($registeredUser);

        return redirect($this->redirectTo());
    }

    /**
     * Redirect the user to the given provider authentication page.
     *
     * @param string $provider
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        if (! LoginProvider::isEnable($provider)) {
            abort(404);
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from the given provider.
     *
     * @param string $provider
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        if (! LoginProvider::isEnable($provider)) {
            abort(404);
        }

        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', $e->getMessage());
        }

        if (User::registered($user->getEmail())) {
            auth()->login(
                User::findByEmail($user->getEmail())
            );

            return redirect($this->redirectTo());
        }

        
        [$firstName, $lastName] = $this->extractName($user->getName());
        $email = $user->getEmail();
        $data['firstName'] = $firstName;
        $data['lastName'] = $lastName;
        $data['email'] = $email;
        return view('public.auth.partials.phone')->with(compact('data'));
    }

    private function extractName($name)
    {
        return explode(' ', $name, 2);
    }

    /**
     * Show registrations form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('public.auth.register', [
            'privacyPageUrl' => $this->getPrivacyPageUrl(),
            'providers' => LoginProvider::enabled(),
        ]);
    }

    /**
     * Get privacy page url.
     *
     * @return string
     */
    private function getPrivacyPageUrl()
    {
        return Cache::tags('settings')->rememberForever('privacy_page_url', function () {
            return Page::urlForPage(setting('storefront_privacy_page'));
        });
    }

    /**
     * Show reset password form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getReset()
    {
        return view('public.auth.reset.begin');
    }

    /**
     * Reset complete form route.
     *
     * @param \Modules\User\Entities\User $user
     * @param string $code
     * @return string
     */
    protected function resetCompleteRoute($user, $code)
    {
        return route('reset.complete', [$user->email, $code]);
    }

    /**
     * Password reset complete view.
     *
     * @return string
     */
    protected function resetCompleteView()
    {
        return view('public.auth.reset.complete');
    }
    public function UserDeletionCallback()
    {
        return response()->json([
            'message' => 'User Deleted',
            'code' => 200
        ]);
    }
    
    public function dataDeletionCallback(Request $request)
    {
        $signed_request = $request->get('signed_request');
        $data = $this->parse_signed_request($signed_request);
        $user_id = $data['user_id'];
        
        $code = rand(1111,9999);

        // here will delete the user base on the user_id from facebook
        User::where([
            ['provider' => 'facebook'],
            ['provider_id' => $user_id]
        ])->forceDelete();

        // here will check if the user is deleted
        $isDeleted = User::withTrashed()->where([
            ['provider' => 'facebook'],
            ['provider_id' => $user_id]
        ])->find();


        if ($isDeleted ===null) {
            return response()->json([
                'url' => 'https://modernpackagers.com/status/fb', 
                'code' => $code, // <------ i dont know what is the logic of this code
            ]);
        }

        return response()->json([
            'message' => 'operation not successful'
        ], 500);
    }

    private function parse_signed_request($signed_request) {
        list($encoded_sig, $payload) = explode('.', $signed_request, 2);

        $secret = config('2e4633092f8c90174186cd97fed4e028'); // Use your app secret here

        // decode the data
        $sig = $this->base64_url_decode($encoded_sig);
        $data = json_decode($this->base64_url_decode($payload), true);

        // confirm the signature
        $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
        if ($sig !== $expected_sig) {
            error_log('Bad Signed JSON signature!');
            return null;
        }

        return $data;
    }

    private function base64_url_decode($input) {
        return base64_decode(strtr($input, '-_', '+/'));
    }
    
    public function checkNum($num){
        return dd($num);
    }
    
    public function sendOtp(Request $request){
        
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
    
    public function checkOtp(Request $request)
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
