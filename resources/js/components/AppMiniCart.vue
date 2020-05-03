<template>
    <div class="dropdown">
        <div class="cart-header" @click="showCart = !showCart">
            <i class="fa fa-shopping-cart"></i> <strong>{{total}} ₽</strong>
        </div>
        <transition name="fade">
            <div v-if="showCart && products.length != 0" class="dropdown-content">
                <div v-for="product in products" class="cart-products">
                    <div>
                        <img :src="'/images/' + (product.attributes.image !== null ? product.attributes.image : 'noimage.png')">
                    </div>
                    <div>
                        {{product.name}}
                    </div>
                    <div>
                        <button type="button" class="button-borderless" @click="removeFromCart(product.id)">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="cart-btns">
                    <div>
                        <a :href="routeCart" class="btn btn-outline-secondary btn-sm">Корзина</a>
                    </div>
                    <div>
                        <a href="#" class="text-dark" @click="showCart = false">Закрыть</a>
                    </div>
                </div>
            </div>
            <div v-else-if="error && showCart" class="dropdown-content">
                <div><span class="text-secondary">Ошибка загрузки корзины</span></div>
            </div>
        </transition>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "AppMiniCart",
        props: ['routeCart'],
        data(){
          return {
              showCart: false,
          }
        },
        computed: {
            ...mapGetters({
                total: 'cart/total',
                products: 'cart/all',
                error: 'cart/error'
            })
        },
        methods: {
            ...mapActions({
                removeFromCart: 'cart/remove',
            })
        }
    }
</script>

<style scoped>
    .dropdown {
        position: relative;
        display: inline-block;
    }
    .dropdown > .cart-header:hover {
        color: #fd5f5c;
        cursor: pointer;
    }
    .dropdown-content {
        display: block;
        border: 1px solid #ebebeb;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 260px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 9999;
        right: 0;
    }
    .dropdown-content > div {
        padding: 10px 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .dropdown div img{
        width: 50px;
        height: 50px;
    }
    .dropdown-content > .cart-products:hover {
        box-shadow: 0px 0px 2px 0px rgba(34, 60, 80, 0.4) inset;
    }
    .fade-enter-active {
        animation: fadeIn 0.6s;
    }
    .fade-leave-active {
        animation: fadeOut 0.2s;
    }
    @keyframes fadeIn {
        from{opacity: 0;}
        to{opacity: 1;}
    }
    @keyframes fadeOut {
        from{opacity: 1;}
        to{opacity: 0;}
    }
</style>
