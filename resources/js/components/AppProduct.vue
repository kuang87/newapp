<template>
    <div class="col-6 col-md-4">
        <div class="product pink" :class="{incart: inCart(productId)}">
            <a class="product-img" :href="routeProductDetails"><img :src="image" alt=""></a>
            <p v-if="inCart(productId)" :class="{'incart-info': inCart(productId)}">В корзине</p>
            <h5 class="product-type">{{category}}</h5>
            <h3 class="product-name">{{name}}</h3>
            <h3 class="product-price">{{price}} ₽</h3>
            <div class="product-select">
                <button class="add-to-wishlist round-icon-btn pink"><i class="far fa-heart"></i></button>
                <button class="add-to-cart round-icon-btn pink" @click="onAddToCart(productId)"><i class="fas fa-cart-arrow-down"></i></button>
                <a :href="routeProductDetails"><button class="round-icon-btn pink"><i class="fas fa-info"></i></button></a>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'

    export default {
        name: "AppProduct",
        props:{
            routeAddCart: String,
            routeProductDetails: String,
            productId: Number,
            image: String,
            name: String,
            category: String,
            price: String
        },
        computed: {
            ...mapGetters({
                inCart: 'cart/inCart'
            })
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
