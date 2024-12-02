<template>
    <div class="product-card card-box mb-4">
        <div class="card h-100 text-center">
            <div class="in-col position-relative rounded">
                <button class="wish-col badge bg-body position-absolute top-0 m-2 end-0 rounded-circle" :class="{ 'added': inWishlist }"
                        :title="$trans('storefront::product_card.wishlist')"
                        @click="syncWishlist">
                    <i class="icon-heart-o"></i>
                </button>
                <a :href="productUrl" class="view-col badge bg-body position-absolute top-0 mt-4 end-0 rounded-circle">
                    <i class="fa-regular fa-eye"></i>
                </a>
                <img :src="baseImage" class="card-in-img" :class="{ 'image-placeholder': ! hasBaseImage }" alt="product image">
                <button
                    v-if="hasNoOption || product.is_out_of_stock"
                    class="add-cart btn btn-sm btn-danger rounded-bottom w-100"
                    :class="{ 'btn-loading': addingToCart }"
                    :disabled="product.is_out_of_stock"
                    @click="addToCart"
                >
                    {{ $trans('storefront::product_card.add_to_cart') }}
                </button>
            </div>
            <div class="card-text mt-2">
                <h6>{{ product.name }}</h6>
                <p class="my-1" v-html="product.formatted_price"></p>
                <div class="star-icon mt-1 d-flex align-items-center">
                    <ProductRating :ratingPercent="product.rating_percent" :reviewCount="product.reviews.length"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ProductRating from './ProductRating.vue';
    import ProductCardMixin from '../mixins/ProductCardMixin';

    export default {
        components: { ProductRating },

        mixins: [
            ProductCardMixin,
        ],

        props: ['product'],
    };
</script>
