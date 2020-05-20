<template>
    <div class="col-6 col-md-4">
        <div class="product animated grid-view zoomIn"
             :style="productInCart && incartstyle"
             @mouseover="productInCart && (showStyle=false)"
             @mouseleave="productInCart && (showStyle=true)">
            <div class="product-img_block">
                <a class="product-img" :href="routeProductDetails"><img :src="image" alt=""></a>
            </div>
            <p v-if="productInCart" :class="{'incart-info': productInCart}">В корзине</p>
            <div class="product-info_block">
                <a class="product-name" :href="routeProductDetails">{{name}}</a>
                <h3 class="product-price">{{price}} ₽</h3>
                <p class="product-describe">{{info}}</p>
            </div>
            <div class="product-select">
                <button class="add-to-wishlist round-icon-btn pink">
                    <i class="far fa-heart"></i>
                </button>
                <button class="add-to-cart round-icon-btn pink" @click="onAddToCart(productId)">
                    <i class="fas fa-cart-arrow-down"></i>
                </button>
                <a :href="routeProductDetails"><button class="round-icon-btn pink">
                    <i class="fas fa-info"></i></button>
                </a>
            </div>
            <div class="product-select_list">
                <p class="delivery-status">Доставка бесплатно<br>(от 1000 ₽)</p>
                <h3 class="product-price">
                    {{price}} ₽
                </h3>
                <button class="add-to-cart pink normal-btn"
                        :class="{outline: !inCart(productId)}"
                        @click="onAddToCart(productId)">
                    {{inCart(productId) ? 'В корзине' : 'В корзину'}}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'

    export default {
        name: "AppProduct",
        data(){
            return {
                showStyle: true,
            }
        },
        props:{
            routeAddCart: String,
            routeProductDetails: String,
            productId: Number,
            image: String,
            name: String,
            category: String,
            price: String,
            info: String
        },
        computed: {
            ...mapGetters({
                inCart: 'cart/inCart'
            }),
            productInCart(){
              return this.inCart(this.productId)
            },
            incartstyle(){
                return this.showStyle ? {border: '1px solid tomato'} : ''
            }
        },
        methods: {
            ...mapActions({
                add: 'cart/add'
            }),
            onAddToCart(id){
                this.add(id);
            }
        }
    }
</script>

<style scoped>

</style>
