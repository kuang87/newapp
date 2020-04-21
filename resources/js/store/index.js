import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

import cart from "./modules/cart";
import products from "./modules/products";

export default new Vuex.Store({
    modules:{
        cart,
        products
    },
    strict: process.env.NODE_ENV !== 'production'
});
