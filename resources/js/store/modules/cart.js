import server from '../../server'


export default {
    namespaced: true,
    state: {
        products: []
    },
    getters: {
        all(state){
            return state.products;
        },
        cnt(state){
            return state.products.length;
        },
        total(state){
            return state.products.reduce((total, product) => {
                return total = total + product.price * product.quantity;
            }, 0);
        }
    },
    mutations: {
        load(state, products){
            state.products = products;
        }
    },
    actions: {
        load(store) {
            server.get('api/cart').then((response) => {
                let array = Object.values(response.data.cart);
                 store.commit('load', array);
            })
        }
    },
    modules: {
    }
}
