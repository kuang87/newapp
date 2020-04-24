import server from '../../server'


export default {
    namespaced: true,
    state: {
        products: [],
        errLoad: false
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
        },
        inCart(state){
            return function (id) {
                return state.products.some(el => el.id === id);
            }
        },
        error(state){
            return state.errLoad;
        }
    },
    mutations: {
        load(state, products){
            state.products = products;
        },
        remove(state, id){
            let index = state.products.findIndex(product => product.id === id);
            state.products.splice(index, 1);
        },
        error(state, error){
            state.errLoad = error;
        }
    },
    actions: {
        load(store) {
            server
                .get('api/cart')
                .then(response => {
                    let array = Object.values(response.data.cart);
                     store.commit('load', array);
                })
                .catch(error => {
                    store.commit('error', true);
                });
        },
        remove(store, id){
            if (store.getters.inCart(id)){
                server
                    .get('api/cart/remove/' + id)
                    .then(response => {
                        if (response.data.remove === true){
                            store.commit('remove', id);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });

                // return new Promise(function (resolve, reject) {
                // if (store.getters.inCart(id)){
                //     store.commit('remove', id);
                //     resolve();
                // }
            }
        },
    },
    modules: {}
}
