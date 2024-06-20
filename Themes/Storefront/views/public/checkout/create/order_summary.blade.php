<aside class="order-summary-wrap">
    <div class="order-summary">
        <div class="order-summary-top">
            <h3 class="section-title">{{ trans('storefront::cart.order_summary') }}</h3>
            <ul class="list-inline cart-item">
               <input type="hidden" id="productsTotalWeight" :value="cart.totalWeight">

               <li v-for="cartItem in cart.items">
                    <label>
                        <a :href="productUrl(cartItem.product)" class="product-name" v-text="cartItem.product.name"></a>
                        <span class="product-quantity" v-text="'x' + cartItem.qty"></span>
                    	</label>
                    	<span class="price-amount" v-html="cartItem.unitPrice.inCurrentCurrency.formatted"></span>
               </li>
            </ul>
        </div>
        <div class="order-summary-middle" :class="{ loading: loadingOrderSummary }">
            <ul class="list-inline order-summary-list">
                <li>
                    <label>{{ trans('storefront::cart.subtotal') }}</label>

                    <span
                        class="price-amount"
                        v-html="cart.subTotal.inCurrentCurrency.formatted"
                    >
                    </span>
                </li>

                <li v-for="tax in cart.taxes">
                    <label v-text="tax.name"></label>

                    <span
                        class="price-amount"
                        v-html="tax.amount.inCurrentCurrency.formatted"
                    >
                    </span>

                </li>

                <li v-if="hasCoupon" v-cloak>
                    <label>
                        {{ trans('storefront::cart.coupon') }}

                        <span class="coupon-code">
                            [@{{ cart.coupon.code }}]
                            <span class="btn-remove-coupon" @click="removeCoupon">
                                <i class="las la-times"></i>
                            </span>
                        </span>
                    </label>

                    <span
                        class="price-amount"
                        v-html="'-' + cart.coupon.value.inCurrentCurrency.formatted"
                    >
                    </span>
                </li>
            </ul>

            <div class="shipping-methods" v-cloak style="display:flex;justify-content: space-between;">
               <h6>Shipping Price</h6>

               <div id="total-price"><!-- @{{cart.customShippingPrice}} --></div>
               <div class="form-group">
                	<!-- @{{cart.shippingCost.inCurrentCurrency.formatted}} -->
                	<input type="hidden" name="shipping_price_custom" value="{{number_format($shippingcost,2)}}">
                	<!-- <input type="hidden" name="shipping_price_custom" :value="form.billing.shipping_price"> -->
                	<!-- <span
                     class="price-amount"
                     v-if="form.billing.shipping_price"
                  >
                  	@{{form.shipping.shipping_price ? form.shipping.shipping_price : form.billing.shipping_price}}
                  </span>

                  <span
                     class="price-amount"
                     v-else
                  >
                  	0.00
                  </span> -->
                    <span class="price-amount">{{number_format($shippingcost,2)}}</span>
               </div>

                <!-- <span class="error-message" v-else>
                    {{ trans('storefront::cart.shipping_method_is_not_configured') }}
                </span> -->
            </div>
	
            <div class="order-summary-total">

               <label>{{ trans('storefront::cart.total') }}</label>
               <div v-if="cart.coupon.value && cart.coupon.value.inCurrentCurrency.formatted">	              
	              	<span>@{{cart.total.inCurrentCurrency.formatted}}</span>
              </div>
              <div v-else>
              		<span
	              		v-if="form.billing.totalAmountWithPrice"
	                  class="price-amount"
	                  v-html="form.billing.totalAmountWithPrice"
	              	>
	              	</span>
	              	<span v-else >@{{cart.total.inCurrentCurrency.formatted}}</span>
              </div>
            </div>
        </div>

        <div class="order-summary-bottom">
            <div class="form-group checkout-terms-and-conditions">
                <div class="form-check">
                    <input type="checkbox" v-model="form.terms_and_conditions" id="terms-and-conditions">

                    <label for="terms-and-conditions" class="form-check-label">
                        {{ trans('storefront::checkout.i_agree_to_the') }}
                        <a href="{{ $termsPageURL }}">
                            {{ trans('storefront::checkout.terms_&_conditions') }}
                        </a>
                    </label>

                    <span class="error-message" v-if="errors.has('terms_and_conditions')" v-text="errors.get('terms_and_conditions')"></span>
                </div>
            </div>

           

            <button
                type="submit"
                class="btn btn-primary btn-place-order"
                :class="{ 'btn-loading': placingOrder }"
                :disabled="!form.terms_and_conditions" 
                v-cloak
            disabled>
                {{ trans('storefront::checkout.place_order') }}
            </button>
        </div>
    </div>
</aside>
