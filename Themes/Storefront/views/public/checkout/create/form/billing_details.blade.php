<div class="billing-details">
    <h4 class="section-title">{{ trans('storefront::checkout.billing_details') }}</h4>

    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                <label for="billing-first-name">
                    {{ trans('checkout::attributes.billing.first_name') }}<span>*</span>
                </label>

                <input
                    type="text"
                    name="billing[first_name]"
                    v-model="form.billing.first_name"
                    id="billing-first-name"
                    class="form-control"
                >

                <span
                    class="error-message"
                    v-if="errors.has('billing.first_name')"
                    v-text="errors.get('billing.first_name')"
                >
                </span>
            </div>
        </div>

        <div class="col-md-9">
            <div class="form-group">
                <label for="billing-last-name">
                    {{ trans('checkout::attributes.billing.last_name') }}<span>*</span>
                </label>

                <input
                    type="text"
                    name="billing[last_name]"
                    v-model="form.billing.last_name"
                    id="billing-last-name"
                    class="form-control"
                >

                <span
                    class="error-message"
                    v-if="errors.has('billing.last_name')"
                    v-text="errors.get('billing.last_name')"
                >
                </span>
            </div>
        </div>

        <div class="col-md-18">
            <div class="form-group">
                <label for="billing-address-1">
                    {{ trans('checkout::attributes.street_address') }}<span>*</span>
                </label>

                <input
                    type="text"
                    name="billing[address_1]"
                    v-model="form.billing.address_1"
                    id="billing-address-1"
                    class="form-control"
                    placeholder="{{ trans('checkout::attributes.billing.address_1') }}"
                >

                <span
                    class="error-message"
                    v-if="errors.has('billing.address_1')"
                    v-text="errors.get('billing.address_1')"
                >
                </span>
            </div>

            <div class="form-group">
                <input
                    type="text"
                    name="billing[address_2]"
                    v-model="form.billing.address_2"
                    class="form-control"
                    placeholder="{{ trans('checkout::attributes.billing.address_2') }}"
                >
            </div>
        </div>

        <div class="col-md-9">
            <div class="form-group">
                <label for="billing-city">
                    {{ trans('checkout::attributes.billing.city') }}<span>*</span>
                </label>

                <input
                    type="text"
                    name="billing[city]"
                    :value="form.billing.city"
                    id="billing-city"
                    class="form-control"
                    @change="changeBillingCity($event.target.value)"
                >

                <span
                    class="error-message"
                    v-if="errors.has('billing.city')"
                    v-text="errors.get('billing.city')"
                >
                </span>
            </div>
        </div>

        <div class="col-md-9">
            <div class="form-group">
                <label for="billing-zip">
                    {{ trans('checkout::attributes.billing.zip') }}<span>*</span>
                </label>

                <input
                    type="text"
                    name="billing[zip]"
                    :value="form.billing.zip"
                    id="billing-zip"
                    class="form-control"
                    @change="changeBillingZip($event.target.value)"
                >

                <span
                    class="error-message"
                    id="zipcodeError"
                >
                </span>
            </div>

            @if(session()->has('shipping'))
                <div class="alert alert-danger"> 
                {!! session('shipping') !!}
                </div>
            @endif


        </div>

        <div class="col-md-9">
            <div class="form-group">
                <label for="billing-country">
                    {{ trans('checkout::attributes.billing.country') }}<span>*</span>
                </label>

                <select
                    name="billing[country]"
                    :value="form.billing.country"
                    id="billing-country"
                    class="form-control arrow-black"
                    @change="changeBillingCountry($event.target.value)"
                >
                    <option
                        v-for="(name, code) in countries"
                        :value="code"
                        v-text="name"
                    >
                    </option>
                </select>

                <span
                    class="error-message"
                    v-if="errors.has('billing.country')"
                    v-text="errors.get('billing.country')"
                >
                </span>
            </div>
        </div>

        <div class="col-md-9">
            <div class="form-group">
                <label for="billing-state">
                    {{ trans('checkout::attributes.billing.state') }}<span>*</span>
                </label>

                <input
                    type="text"
                    name="billing[state]"
                    :value="form.billing.state"
                    id="billing-state"
                    class="form-control"
                    v-if="! hasBillingStates"
                    @change="changeBillingState($event.target.value)"
                >

                <select
                    name="billing[state]"
                    v-model="form.billing.state"
                    id="billing-state"
                    class="form-control arrow-black"
                    v-else
                    v-cloak
                >
                    <option value="">{{ trans('storefront::checkout.please_select') }}</option>

                    <option
                        v-for="(name, code) in states.billing"
                        :value="code"
                        v-text="name"
                    >
                    </option>
                </select>

                <span
                    class="error-message"
                    v-if="errors.has('billing.state')"
                    v-text="errors.get('billing.state')"
                >
                </span>
            </div>
        </div>
    </div>
</div>
