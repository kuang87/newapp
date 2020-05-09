<template>
    <div class="container">
        <template v-if="products.length != 0">
        <div  class="row">
                <div class="col-12">
                    <div class="product-table">
                        <table class="table table-responsive">
                            <colgroup>
                                <col span="1" style="width: 15%">
                                <col span="1" style="width: 30%">
                                <col span="1" style="width: 15%">
                                <col span="1" style="width: 15%">
                                <col span="1" style="width: 15%">
                                <col span="1" style="width: 10%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="product-iamge" scope="col"></th>
                                    <th class="product-name" scope="col">Наименование</th>
                                    <th class="product-price" scope="col">Цена</th>
                                    <th class="product-quantity" scope="col">Количество</th>
                                    <th class="product-total" scope="col">Итого</th>
                                    <th class="product-clear" scope="col"></th>
                                </tr>
                            </thead>

                            <tbody>

                            <tr v-for="(product, i) in products" ref="products">
                                <td class="product-iamge">
                                    <div class="img-wrapper"><img
                                        :src="'/images/' + (product.attributes.image !== null ? product.attributes.image : 'noimage.png')" alt="">
                                    </div>
                                </td>
                                <td class="product-name">{{product.name}}</td>
                                <td class="product-price">{{product.price}} ₽</td>
                                <td class="product-quantity">
                                    <button class="btn btn-sm" title="Меньше" @click="minus1(product.id, i)">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="quantity no-round-input" type="number" min="1"
                                           name="pro_qty[]" :value="product.quantity" @change="onChangeQuantity(product.id, i, $event)">
                                    <button class="btn btn-sm" title="Больше" @click="plus1(product.id, i)">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </td>
                                <td class="product-total">{{totalProduct(product.id)}} ₽</td>
                                <td class="product-clear">
                                    <a class="button-borderless" href="" @click.prevent="removeFromCart(product.id)">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-sm-8">
                </div>
                <div class="col-12 col-sm-4 text-right">
                    <button class="no-round-btn pink cart-update" @click="clear">Очистить корзину</button>
                </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="cart-total_block">
                    <h2>Итог</h2>
                    <table class="table">
                        <colgroup>
                            <col span="1" style="width: 50%">
                            <col span="1" style="width: 50%">
                        </colgroup>
                        <tbody>
                        <tr>
                            <th>Заказ</th>
                            <td>{{total}} ₽</td>
                        </tr>
                        <tr>
                            <th>Доставка</th>
                            <td>
                                {{delivery}} ₽
                            </td>
                        </tr>
                        <tr>
                            <th>Всего</th>
                            <td>{{total + delivery}} ₽</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="checkout-method">
                        <a :href="routeCheckout"><button class="normal-btn pink">Оформить заказ</button></a>
                    </div>
                </div>
            </div>
        </div>
        </template>

        <div v-else class="row">
            <div class="col">
                Ваша корзина пуста
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "AppCart",
        props: ['routeCheckout'],
        data(){
          return {
              showCart: false,
          }
        },
        computed: {
            ...mapGetters({
                total: 'cart/total',
                products: 'cart/all',
                error: 'cart/error',
                totalProduct: 'cart/totalProduct',
                delivery: 'cart/delivery'
            })
        },
        methods: {
            ...mapActions({
                removeFromCart: 'cart/remove',
                clear: 'cart/clear',
                changeQuantity: 'cart/changeQuantity'
            }),
            onChangeQuantity(id, i, e){
                let quantity = parseInt(e.target.value.trim());
                if (isNaN(quantity) || quantity < 1){
                    quantity = 1;
                }
                this.changeQuantity({id, quantity});
                if ((quantity !== e.target.value) && (quantity === this.products[i].quantity)){
                    this.$forceUpdate();
                }
            },
            plus1(id, i){
                let quantity = this.products[i].quantity + 1;
                this.changeQuantity({id, quantity});
            },
            minus1(id, i){
                let quantity = this.products[i].quantity - 1;
                this.changeQuantity({id, quantity});
            },
        }
    }
</script>

<style scoped>
</style>
