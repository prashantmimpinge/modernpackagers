@extends('public.layout')

@section('title', trans('storefront::checkout.checkout'))

@section('content')
<checkout-create customer-email="{{ auth()->user()->email ?? null }}" :gateways="{{ $gateways }}" :countries="{{ json_encode($countries) }}" inline-template>
    <section class="checkout-wrap">
        <div class="container">
            @include('public.cart.index.steps')

            <form @submit.prevent="placeOrder" @input="errors.clear($event.target.name)">
                <div class="checkout">
                    <div class="checkout-inner">
                        <div class="checkout-left">
                            <div class="checkout-form">
                                @include('public.checkout.create.form.account_details')
                                @include('public.checkout.create.form.billing_details')
                                @include('public.checkout.create.form.shipping_details')
                                @include('public.checkout.create.form.order_note')
                            </div>
                        </div>

                        <div class="checkout-right">
                            @include('public.checkout.create.payment')
                            @include('public.checkout.create.coupon')
                        </div>
                    </div>

                    @include('public.checkout.create.order_summary')
                </div>
            </form>
        </div>
    </section>
</checkout-create>
@endsection

@push('pre-scripts')
@if (setting('paypal_enabled'))
<script src="https://www.paypal.com/sdk/js?client-id={{ setting('paypal_client_id') }}&currency={{ setting('default_currency') }}&disable-funding=credit,card,venmo,sepa,bancontact,eps,giropay,ideal,mybank,p24,p24"></script>
@endif

@if (setting('stripe_enabled'))
<script src="https://js.stripe.com/v3/"></script>
@endif

@if (setting('razorpay_enabled'))
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@endif
<!--  <script>
       document.addEventListener("DOMContentLoaded", function() {
          let productName = document.querySelector('.product-name').textContent;
          let qty = parseInt(document.querySelector('.product-quantity').textContent);
          let myShippingRate = document.getElementById('my-shipping-rate');
          let weight;
let resWeight = 10;
          const API_URL = `https://cors-anywhere.herokuapp.com/https://track.delhivery.com/api/kinko/v1/invoice/charges/.json?ss=DTO&md=S&cgm=${resWeight}`;
          
   fetch(API_URL, {
    method: 'GET', // *GET, POST, PUT, DELETE, etc.
    cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
    headers: {
        'Authorization' : 'Token fe3718a4cd32a9cb7dae17356fb8368b06aee292',
      'Content-Type': 'application/json',
      'Accept' : 'application/json'
      // 'Content-Type': 'application/x-www-form-urlencoded',
    },
    redirect: 'follow', // manual, *follow, error
    referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
    //body: JSON.stringify(data) // body data type must match "Content-Type" header
  }).then(res => res.json())
    .then(data => {
        console.log(data[0].total_amount);
        myShippingRate.textContent = data[0].total_amount;
       
        
        let fp = document.getElementById('first_price').textContent;
        
        let firstPrice = fp.substring(1, fp.length);
        
        firstPrice = parseFloat(firstPrice);
        
        let totPrice = data[0].total_amount + firstPrice;
        
        totPrice = totPrice.toFixed(2);
        document.getElementById('my_own_total').textContent = totPrice;
    });
        
    
          
        });
    </script> -->



<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(function() { // this will be called when the DOM is ready


        var input = document.querySelector("#phone"),
            errorMsg = document.querySelector("#error-msg"),
            validMsg = document.querySelector("#valid-msg");

        var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

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

        input.addEventListener('blur', function() {
            if (secondBlur) return;
            secondBlur = true;
            reset();
            console.log(input.value.trim());
            if (input.value.trim()) {
                if (iti.isValidNumber()) {
                    validMsg.classList.remove("hide");


                    if (document.getElementById('terms-and-conditions').checked) {
                        document.querySelector('.btn-place-order').disabled = false;
                    }
                    //$('.btn-create-account').prop('disabled',false);

                    let inputNumber = input.value.trim();

                    console.log(inputNumber);

                    let returnedOTP;

                    var timeleft = 60;

                    let otpUrl = `{{url('checkoutsendOtp')}}`;

                    $.ajax({
                        url: otpUrl,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        data: {
                            'mobile': input.value.trim()
                        },
                        success: function(data) {
                            console.log(data);
                            returnedOtp = data.otp;
                            console.log(`OTP is ${data.otp}`);
                            (async () => {
                                const {
                                    value: popotp
                                } = await Swal.fire({
                                    title: 'Enter your OTP',
                                    input: 'text',
                                    html: '<p id="resendOtpPara">You can resend OTP in <span id="timerHere">60</span></p>' +
                                        '<button id="increase" class="btn btn-warning">' +
                                        'Click here to resend OTP' +
                                        '</button>',
                                    inputLabel: `Sent to number ${input.value.trim()}`,
                                    showCancelButton: false,
                                    allowEscapeKey: false,
                                    allowOutsideClick: false,
                                    didOpen: () => {


                                        var downloadTimer = setInterval(function() {
                                            timeleft--;
                                            document.getElementById("timerHere").textContent = timeleft;
                                            if (timeleft <= 0)
                                                clearInterval(downloadTimer);
                                        }, 1000);

                                        setTimeout(function() {
                                            $('#resendOtpPara').hide()
                                        }, 60000)


                                        $('#increase').hide()
                                        setTimeout(function() {
                                            $('#increase').show()
                                        }, 60000);



                                        $('#increase').on('click', function() {
                                            $.ajax({
                                                url: otpUrl,
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                type: 'POST',
                                                data: {
                                                    'mobile': input.value.trim()
                                                },
                                                success: function(data2) {
                                                    returnedOtp = data2.otp;
                                                    console.log(`OTP2 is ${data2.otp}`);
                                                }
                                            })


                                            //hide the resend button
                                            $('#increase').hide();
                                            $('#resendOtpPara').show();
                                            timeleft = 60;
                                            document.getElementById("timerHere").textContent = timeleft;
                                            var downloadTimer2 = setInterval(function() {
                                                timeleft--;
                                                document.getElementById("timerHere").textContent = timeleft;
                                                if (timeleft <= 0)
                                                    clearInterval(downloadTimer2);
                                            }, 1000);


                                            setTimeout(function() {
                                                $('#resendOtpPara').hide()
                                            }, 60000)



                                            setTimeout(function() {
                                                $('#increase').show()
                                            }, 60000);


                                        });


                                    },



                                    inputValidator: (value) => {
                                        if (!value) {
                                            return 'Please Enter your OTP!'
                                        } else if (('' + value).length !== 4) {
                                            return 'Please enter at least 4 digit number'
                                        } else {
                                            otpVal = value;
                                        }
                                    },
                                    preConfirm: function() {
                                        if (otpVal == returnedOtp) {
                                            Swal.fire('You shall pass')
                                        } else {
                                            Swal.showValidationMessage('Incorrect OTP');
                                        }
                                    },



                                    confirmButtonText: 'Submit'


                                })


                            })()

                        }

                    });
                } else {
                    input.classList.add("error");
                    var errorCode = iti.getValidationError();
                    errorMsg.innerHTML = errorMap[errorCode];
                    errorMsg.classList.remove("hide");
                    $('.btn-place-order').prop('disabled', true);
                }



            }
        });



        document.getElementById('terms-and-conditions').addEventListener('change', function() {
            if (this.checked) {
                if (input.value.trim()) {
                    document.querySelector('.btn-place-order').disabled = false;
                }
            } else {
                console.log("Checkbox is not checked..");
            }
        })


    });
    input.addEventListener('change', reset);
    input.addEventListener('keyup', reset);
</script>










@endpush