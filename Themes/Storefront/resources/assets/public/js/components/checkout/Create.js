import store from '../../store';
import Errors from '../../Errors';
import CartHelpersMixin from '../../mixins/CartHelpersMixin';
import ProductHelpersMixin from '../../mixins/ProductHelpersMixin';
import axios  from 'axios';

export default {
    mixins: [
        CartHelpersMixin,
        ProductHelpersMixin,
    ],

    props: ['customerEmail', 'gateways', 'countries'],

    data() {
        return {
            form: {
                customer_email: this.customerEmail,
                billing: {},
                shipping: {},
                shipping_price:'',
                totalAmountWithPrice:'',
                errorMessage: 'hiii'
            },
            states: {
                billing: {},
                shipping: {},
            },
            placingOrder: false,
            errors: new Errors(),
            stripe: null,
            stripeCardElement: null,
            stripeError: null,
        };
    },

    computed: {
        firstCountry() {
            return Object.keys(this.countries)[0];
        },

        hasBillingStates() {
            return Object.keys(this.states.billing).length !== 0;
        },

        hasShippingStates() {
            return Object.keys(this.states.shipping).length !== 0;
        },

        hasNoPaymentMethod() {
            return Object.keys(this.gateways).length === 0;
        },

        firstPaymentMethod() {
            return Object.keys(this.gateways)[0];
        },

        shouldShowPaymentInstructions() {
            return ['bank_transfer', 'check_payment'].includes(this.form.payment_method);
        },

        paymentInstructions() {
            if (this.shouldShowPaymentInstructions) {
                return this.gateways[this.form.payment_method].instructions;
            }
        },
    },

    watch: {
        'form.billing.city': function (newCity) {
            if (newCity) {
               this.addTaxes();
            }
        },

        'form.shipping.city': function (newCity) {
            if (newCity) {
                this.addTaxes();
            }
        },

        'form.billing.zip': function (newZip) {
            if (newZip) {
                this.addTaxes();
            }
        },

        'form.shipping.zip': function (newZip) {
            if (newZip) {
                this.addTaxes();
            }
        },

        'form.billing.state': function (newState) {
            if (newState) {
                this.addTaxes();
            }
        },

        'form.shipping.state': function (newState) {
            if (newState) {
                this.addTaxes();
            }
        },

        'form.ship_to_a_different_address': function () {
            this.addTaxes();
        },

        'form.terms_and_conditions': function () {
            this.errors.clear('terms_and_conditions');
        },

        'form.payment_method': function (newPaymentMethod) {
            if (newPaymentMethod === 'paypal') {
                this.$nextTick(this.renderPayPalButton);
            }

            if (newPaymentMethod !== 'stripe') {
                this.stripeError = '';
            }
        },
    },

    created() {
        this.changeBillingCountry(this.firstCountry);
        this.changeShippingCountry(this.firstCountry);

        this.$nextTick(() => {
            if (this.firstPaymentMethod) {
               this.changePaymentMethod(this.firstPaymentMethod);
            }

            if (this.firstShippingMethod) {
               this.updateShippingMethod(this.firstShippingMethod);
            }

            if (window.Stripe) {
               this.stripe = window.Stripe(FleetCart.stripePublishableKey);
               this.renderStripeElements();
            }
        });
    },

    methods: {
        changeBillingCity(city) {
            this.$set(this.form.billing, 'city', city);
        },

        changeShippingCity(city) {
            this.$set(this.form.shipping, 'city', city);
        },
        
         changeBillingZip(zip) {
            this.addTaxes();
            console.log(this.form.shipping.zip)
            if(this.form.shipping.zip === undefined ){
               let weight = document.getElementById('productsTotalWeight').value;
            this.$set(this.form.billing, 'zip', zip);
            this.loadingOrderSummary = true;
            axios.get('https://test.cors.workers.dev/?https://track.delhivery.com/c/api/pin-codes/json/?filter_codes='+zip,{
               cors:'mode',
               headers: {
                  'Authorization': 'Token fe3718a4cd32a9cb7dae17356fb8368b06aee292',
                  'Access-Control-Allow-Origin': 'https://track.delhivery.com',
                  'Content-Type':'application/json',
                    'x-cors-headers': JSON.stringify({
                      // allows to send forbidden headers
                      // https://developer.mozilla.org/en-US/docs/Glossary/Forbidden_header_name
                      'cookies': 'x=123'
                    }) 
                 }
               })
               .then((response) => {
                  // console.log(response,'response')
                  // console.log(response.data.delivery_codes.length > 0)
                  if(response.data.delivery_codes.length > 0){
                     $.ajax({
                        method: 'POST',
                        url: route('cart.shipping', {weight: weight, dPin: zip}),
                     }).then((cart) => {
                        this.loadingOrderSummary = false;
                        // console.log(cart,'cartcart')
                        document.getElementById('zipcodeError').style.display = 'none';
                        document.getElementById('zipcodeError').textContent = '';
                        this.$set(this.form.billing, 'shipping_price', cart.shippingCost.formatted);
                        this.$set(this.form.billing, 'totalAmountWithPrice', cart.total.formatted)
                     }).catch((xhr) => {
                        // console.log(xhr,'xhr')
                        this.$notify(xhr.responseJSON.message);
                        this.loadingOrderSummary = false;
                     })
                  }else{
                     this.$set(this.form.billing, 'shipping_price', '');
                     this.$set(this.form.billing, 'totalAmountWithPrice', '')
                     document.getElementById('zipcodeError').textContent = 'Shipping service is not avialable on this zip';
                     this.$set(this.form.billing,'errorMessage','Shipping service is not avialable on this zip code.')
                     this.$notify("Shipping service is not avialable on this zip code.");
                     this.loadingOrderSummary = false;
                  }
               })
               .catch(function (error) {
                // handle error
                  console.log(error);
               })
               .then(function () {
                // always executed
               });
            }
            
            
         },
        changeShippingZip(zip) {
          this.addTaxes();
            console.log(zip)
            this.$set(this.form.shipping, 'zip', zip);
            let weight = document.getElementById('productsTotalWeight').value;
            // this.$set(this.form.billing, 'zip', zip);
            this.loadingOrderSummary = true;
            axios.get('https://test.cors.workers.dev/?https://track.delhivery.com/c/api/pin-codes/json/?filter_codes='+zip,{
               cors:'mode',
               headers: {
                  'Authorization': 'Token fe3718a4cd32a9cb7dae17356fb8368b06aee292',
                  'Access-Control-Allow-Origin': 'https://track.delhivery.com',
                  'Content-Type':'application/json',
                'x-cors-headers': JSON.stringify({
                  // allows to send forbidden headers
                  // https://developer.mozilla.org/en-US/docs/Glossary/Forbidden_header_name
                  'cookies': 'x=123'
                }) 
                 }
               })
               .then((response) => {
                  // console.log(response,'response')
                  // console.log(response.data.delivery_codes.length > 0)
                  if(response.data.delivery_codes.length > 0){
                     $.ajax({
                        method: 'POST',
                        url: route('cart.shipping', {weight: weight, dPin: zip}),
                     }).then((cart) => {
                        this.loadingOrderSummary = false;
                        // console.log(cart,'cartcart')
                        document.getElementById('zipcodeError2').style.display = 'none';
                        document.getElementById('zipcodeError2').textContent = '';
                        this.$set(this.form.billing, 'shipping_price', cart.shippingCost.formatted);
                        this.$set(this.form.billing, 'totalAmountWithPrice', cart.total.formatted)
                     }).catch((xhr) => {
                        // console.log(xhr,'xhr')
                        this.$notify(xhr.responseJSON.message);
                        this.loadingOrderSummary = false;
                     })
                  }else{
                     this.$set(this.form.billing, 'shipping_price', '');
                     this.$set(this.form.billing, 'totalAmountWithPrice', '')
                     document.getElementById('zipcodeError2').textContent = 'Shipping service is not avialable on this zip';
                     this.$set(this.form.shipping,'errorMessage','Shipping service is not avialable on this zip code.')
                     this.$notify("Shipping service is not avialable on this zip code.");
                     this.loadingOrderSummary = false;
                  }
               })
               .catch(function (error) {
                // handle error
                  console.log(error);
               })
               .then(function () {
                // always executed
               });
            
        },

        changeBillingCountry(country) {
            this.$set(this.form.billing, 'country', country);

            this.fetchStates(country, (states) => {
                this.$set(this.states, 'billing', states);
                this.$set(this.form.billing, 'state', '');
            });
        },

        changeShippingCountry(country) {
            this.$set(this.form.shipping, 'country', country);

            this.fetchStates(country, (states) => {
                this.$set(this.states, 'shipping', states);
                this.$set(this.form.shipping, 'state', '');
            });
        },

        fetchStates(country, callback) {
            $.ajax({
                method: 'GET',
                url: route('countries.states.index', { code: country }),
            }).then(callback);
        },

        changeBillingState(state) {
            this.$set(this.form.billing, 'state', state);
        },

        changeShippingState(state) {
            this.$set(this.form.shipping, 'state', state);
        },

        changePaymentMethod(paymentMethod) {
            this.$set(this.form, 'payment_method', paymentMethod);
        },

        changeShippingMethod(shippingMethod) {
            this.$set(this.form, 'shipping_method', shippingMethod.name);
        },

        addTaxes() {
            this.loadingOrderSummary = true;

            $.ajax({
                method: 'POST',
                url: route('cart.taxes.store'),
                data: this.form,
            }).then((cart) => {
                store.updateCart(cart);
            }).catch((xhr) => {
                this.$notify(xhr.responseJSON.message);
            }).always(() => {
                this.loadingOrderSummary = false;
            });
        },

        placeOrder() {
         console.log(this.form.billing.shipping_price,this.form.terms_and_conditions)
            this.placingOrder = true;
            if(this.form.billing.shipping_price === undefined ){
               document.getElementById('zipcodeError').textContent = 'This field is required.';
               document.getElementById('zipcodeError2').textContent = 'This field is required.';
            }
            document.getElementById('zipcodeError').style.display = 'block'
            document.getElementById('zipcodeError').style.display = 'block'
            if (this.form.terms_and_conditions && this.placingOrder) {
               this.placingOrder = true;
               $.ajax({
                   method: 'POST',
                   url: route('checkout.create'),
                   data: this.form,
               }).then((response) => {
                   if (response.redirectUrl) {
                       window.location.href = response.redirectUrl;
                   } else if (this.form.payment_method === 'stripe') {
                       this.confirmStripePayment(response);
                   } else if (this.form.payment_method === 'razorpay') {
                       this.confirmRazorpayPayment(response);
                   } else {
                       this.confirmOrder(response.orderId, this.form.payment_method);
                   }
               }).catch((xhr) => {
                   if (xhr.status === 422) {
                       this.errors.record(xhr.responseJSON.errors);
                   }

                   this.$notify(xhr.responseJSON.message);

                   this.placingOrder = false;
               });
            }else{
               this.placingOrder = false;
                return;
            }

            
        },

        confirmOrder(orderId, paymentMethod, params = {}) {
            $.ajax({
                method: 'GET',
                url: route('checkout.complete.store', { orderId, paymentMethod, ...params }),
            }).then(() => {
                window.location.href = route('checkout.complete.show');
            }).catch((xhr) => {
                this.placingOrder = false;
                this.loadingOrderSummary = false;

                this.deleteOrder(orderId);
                this.$notify(xhr.responseJSON.message);
            });
        },

        deleteOrder(orderId) {
            if (! orderId) {
                return;
            }

            $.ajax({
                method: 'GET',
                url: route('checkout.payment_canceled.store', { orderId }),
            });
        },

        renderPayPalButton() {
            let vm = this;
            let response;

            window.paypal.Buttons({
                async createOrder() {
                    try {
                        response = await $.ajax({
                            method: 'POST',
                            url: route('checkout.create'),
                            data: vm.form,
                        });

                        return response.resourceId;
                    } catch (xhr) {
                        if (xhr.status === 422) {
                            vm.errors.record(xhr.responseJSON.errors);
                        } else {
                            vm.$notify(xhr.responseJSON.message);
                        }
                    }
                },
                onApprove() {
                    vm.loadingOrderSummary = true;

                    vm.confirmOrder(response.orderId, 'paypal', response);
                },
                onError() {
                    vm.deleteOrder(response.orderId);
                },
                onCancel() {
                    vm.deleteOrder(response.orderId);
                },
            }).render('#paypal-button-container');
        },

        renderStripeElements() {
            this.stripeCardElement = this.stripe.elements().create('card', {
                hidePostalCode: true,
            });

            this.stripeCardElement.mount('#stripe-card-element');
        },

        async confirmStripePayment({ orderId, clientSecret }) {
            let result = await this.stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: this.stripeCardElement,
                    billing_details: {
                        email: this.form.customer_email,
                        name: `${this.form.billing.first_name} ${this.form.billing.last_name}`,
                        address: {
                            city: this.form.billing.city,
                            country: this.form.billing.country,
                            line1: this.form.billing.address_1,
                            line2: this.form.billing.address_2,
                            postal_code: this.form.billing.zip,
                            state: this.form.billing.state,
                        },
                    },
                },
            });

            if (result.error) {
                this.placingOrder = false;
                this.stripeError = result.error.message;

                this.deleteOrder(orderId);
            } else {
                this.confirmOrder(orderId, 'stripe', result);
            }
        },

        confirmRazorpayPayment(razorpayOrder) {
            this.placingOrder = false;

            let vm = this;

            new window.Razorpay({
                key: FleetCart.razorpayKeyId,
                name: FleetCart.storeName,
                description: `Payment for order #${razorpayOrder.receipt}`,
                image: FleetCart.storeLogo,
                order_id: razorpayOrder.id,
                handler(response) {
                    vm.placingOrder = true;

                    vm.confirmOrder(razorpayOrder.receipt, 'razorpay', response);
                },
                modal: {
                    ondismiss() {
                        vm.deleteOrder(razorpayOrder.receipt.receipt);
                    },
                },
                prefill: {
                    name: `${vm.form.billing.first_name} ${vm.form.billing.last_name}`,
                    email: vm.form.customer_email,
                    contact: vm.form.customer_phone,
                },
            }).open();
        },
    },
};
