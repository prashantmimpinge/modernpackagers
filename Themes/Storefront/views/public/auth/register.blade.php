@extends('public.layout')

@section('title', trans('user::auth.register'))

@section('content')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <section class="form-wrap register-wrap"> 
        <div class="container">
            <div class="form-wrap-inner register-wrap-inner">
                <h2>{{ trans('user::auth.register') }}</h2>

                <form method="POST" action="{{ route('register.post') }}">
                    @csrf

                    <div class="form-group">
                        <label for="first-name">
                            {{ trans('user::auth.first_name') }}<span>*</span>
                        </label>

                        <input type="text" name="first_name" value="{{ old('first_name') }}" id="first-name" class="form-control">

                        @error('first_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="last-name">
                            {{ trans('user::auth.last_name') }}<span>*</span>
                        </label>

                        <input type="text" name="last_name" value="{{ old('last_name') }}" id="last-name" class="form-control">

                        @error('last_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">
                            {{ trans('user::auth.email') }}<span>*</span>
                        </label>

                        <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control">

                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="mobile">
                            Mobile<span>*</span>
                        </label>

                        <input type="tel" id="mobile" class="form-control" name="mobile">
                        <span id="valid-msg" class="hide">✓ Valid</span>
                        <span id="error-msg" class="hide"></span>

                        @error('mobile')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div> 
                    
                    
                    
                    
                    
                    
                    

                    <div class="form-group">
                        <label for="password">
                            {{ trans('user::auth.password') }}<span>*</span>
                        </label>

                        <input type="password" name="password" id="password" class="form-control">

                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="confirm-password">
                            {{ trans('user::auth.confirm_password') }}<span>*</span>
                        </label>

                        <input type="password" name="password_confirmation" id="confirm-password" class="form-control">

                        @error('password_confirmation')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group p-t-5">
                        @captcha
                        <input type="text" name="captcha" id="captcha" class="captcha-input" placeholder="{{ trans('storefront::layout.enter_captcha_code') }}">

                        @error('captcha')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-check terms-and-conditions">
                        <input type="hidden" name="privacy_policy" value="0">
                        <input type="checkbox" name="privacy_policy" value="1" id="terms" {{ old('privacy_policy', false) ? 'checked' : '' }}>

                        <label for="terms" class="form-check-label">
                            {{ trans('user::auth.i_agree_to_the') }} <a href="{{ $privacyPageUrl }}">{{ trans('user::auth.privacy_policy') }}</a>
                        </label>

                        @error('privacy_policy')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-create-account" data-loading disabled>
                        {{ trans('user::auth.create_account') }}
                    </button>
                </form>

                @include('public.auth.partials.social_login')

                <span class="have-an-account">
                    {{ trans('user::auth.already_have_an_account') }}
                </span>

                <a href="{{ route('login') }}" class="btn btn-default btn-sign-in">
                    {{ trans('user::auth.sign_in') }}
                </a>
            </div>
        </div>
    </section>
    
    
    @push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        
        
        var input = document.querySelector("#mobile"),
  errorMsg = document.querySelector("#error-msg"),
  validMsg = document.querySelector("#valid-msg");
  
  let item2 = $('.btn-create-account');

// here, the index maps to the error code returned from getValidationError - see readme
var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

// initialise plugin
var iti = window.intlTelInput(input, {
    hiddenInput: "mobile",
    initialCountry: "auto",
  geoIpLookup: function(callback) {
    $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
      var countryCode = (resp && resp.country) ? resp.country : "in";
      callback(countryCode);
    });
  },
  utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.3/build/js/utils.js"
});

var reset = function() {
  input.classList.remove("error");
  errorMsg.innerHTML = "";
  errorMsg.classList.add("hide");
  validMsg.classList.add("hide");
};
var secondBlur = false;
// on blur: validate
input.addEventListener('blur', function() {

    
    if(secondBlur)return;
    secondBlur = true;
reset();
  if (input.value.trim()) {
    if (iti.isValidNumber()) {
      validMsg.classList.remove("hide");
      //$('.btn-create-account').prop('disabled',false);
      
       let inputNumber = input.value.trim();
       
       console.log(inputNumber);
       
       let returnedOTP;
       
        var timeleft = 60;
        
       let otpUrl = `{{url('sendOtp')}}`;
  
        $.ajax({
       url: otpUrl,
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       } ,
       type: 'POST',
       data:{'mobile':input.value.trim()},
       success: function(data){
           returnedOtp = data.otp;
           console.log(`OTP is ${data.otp}`);
           (async () => {
    const {value: popotp} = await Swal.fire({
      title: 'Enter your OTP',
      input: 'text',
      html:
      '<p id="resendOtpPara">You can resend OTP in <span id="timerHere">60</span></p>' +
    '<button id="increase" class="btn btn-warning">' +
      'Click here to resend OTP'+
      '</button>' ,
      inputLabel: `Sent to number ${input.value.trim()}`,
      showCancelButton: false,
      allowEscapeKey: false,
      allowOutsideClick: false,
     didOpen: () => {
         
         
         var downloadTimer = setInterval(function(){
    timeleft--;
    document.getElementById("timerHere").textContent = timeleft;
    if(timeleft <= 0)
        clearInterval(downloadTimer);
    },1000);
         
         setTimeout(function(){
             $('#resendOtpPara').hide()
         },60000)
         
         
         $('#increase').hide()
         setTimeout(function(){
             $('#increase').show()
         },60000);
         
    
         
         $('#increase').on('click',function(){
             $.ajax({
                 url: otpUrl,
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       } ,
       type: 'POST',
       data:{'mobile':input.value.trim()},
       success: function(data2){
           returnedOtp = data2.otp;
           console.log(`OTP2 is ${data2.otp}`);
       }
             })
             
             
             //hide the resend button
             $('#increase').hide();
             $('#resendOtpPara').show();
             timeleft = 60;
            document.getElementById("timerHere").textContent = timeleft;
            var downloadTimer2 = setInterval(function(){
            timeleft--;
            document.getElementById("timerHere").textContent = timeleft;
            if(timeleft <= 0)
                clearInterval(downloadTimer2);
            },1000);
            
            
            setTimeout(function(){
                 $('#resendOtpPara').hide()
             },60000)
         
         
         
             setTimeout(function(){
                 $('#increase').show()
             },60000);
            
            
         });
         
         
     },
      
      
      
      inputValidator: (value) => {
        if (!value) {
          return 'Please Enter your OTP!'
        }else if((''+value).length !== 4){
            return 'Please enter at least 4 digit number'
        }else{
            otpVal = value;
        }
      },
      preConfirm: function(){
        if(otpVal == returnedOtp){
            Swal.fire('You shall pass')
            $('.btn-create-account').prop('disabled',false);
        }else{
            Swal.showValidationMessage('Incorrect OTP');
        }  
      },
      
      
      
       confirmButtonText:
        'Submit'
       
        
    })
    
    
    })()
          
       }
        
        });    
        
        
    } else {
      input.classList.add("error");
      var errorCode = iti.getValidationError();
      errorMsg.innerHTML = errorMap[errorCode];
      errorMsg.classList.remove("hide");
      $('.btn-create-account').prop('disabled',true);
    }
  }

});

// on keyup / change flag: reset
input.addEventListener('change', reset);
input.addEventListener('keyup', reset);
    
        
    </script>
    
    
    @endpush
    
@endsection
