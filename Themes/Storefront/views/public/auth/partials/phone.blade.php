@extends('public.layout')

@section('title', trans('user::auth.register'))

@section('content')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<section class="form-wrap register-wrap">
    <div class="container">
        <div class="form-wrap-inner register-wrap-inner">
            <h2>Enter Phone Number before {{ trans('user::auth.register') }}</h2>

            <form method="POST" action="{{ route('phone.post') }}">
                @csrf

                <div class="form-group">
                    <input type="hidden" name="first_name" value="{{ $data['firstName'] }}" id="first-name" class="form-control">

                </div>

                <div class="form-group">

                    <input type="hidden" name="last_name" value="{{ $data['lastName'] }}" id="last-name" class="form-control">

                </div>

                <div class="form-group">

                    <input type="hidden" name="email" value="{{ $data['email'] }}" id="email" class="form-control">

                </div>

                <div class="form-group">
                    <label for="mobile">
                        Mobile<span>*</span>
                    </label>

                    <input type="tel" id="mobile" class="form-control" name="mobile">
                    <input type="hidden" id="otp" class="form-control" name="otp" value="false">
                    <span id="valid-msg" class="hide">✓ Valid</span>
                    <span id="error-msg" class="hide"></span>

                    @error('mobile')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary btn-create-account">
                    Submit
                </button>
            </form>
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
    // var secondBlur = false;
    // on blur: validate
    // input.addEventListener('blur', function() {
    $('.btn-create-account').on('click', function(e) {
        var otp = $("#otp").val();
        if (otp == 'false') {
            e.preventDefault();


            // if (secondBlur) return;
            // secondBlur = true;
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
                        },
                        type: 'POST',
                        data: {
                            'mobile': input.value.trim()
                        },
                        success: function(data) {
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
                                            Swal.fire('You shall pass');
                                            $("#otp").val('true');
                                            // $('.btn-create-account').prop('disabled', false);
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
                    $(".otp").val('false');
                    // $('.btn-create-account').prop('disabled', true);
                }
            }
        }

    });

    // on keyup / change flag: reset
    input.addEventListener('change', reset);
    input.addEventListener('keyup', reset);
</script>


@endpush

@endsection