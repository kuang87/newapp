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
        delivery(state, getters){
            return getters.total < 1000 ? 500 : 0;
        },
        _map(state){
            let map = {};
            state.products.forEach((product, i) => {
                map[product.id.toString()] = i;
            });
            return map;
        },
        total(state){
            return state.products.reduce((total, product) => {
                return total = total + product.price * product.quantity;
            }, 0);
        },
        totalProduct(state, getters){
          return function (id) {
              let item = state.products[getters._map[id]];
              return item.price * item.quantity;
          }
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
        clear(state){
          state.products = [];
        },
        error(state, error){
            state.errLoad = error;
        },
        changeQuantity(state, data){
            let index = state.products.findIndex(product => product.id === data.id);
            state.products[index].quantity = data.quantity;
        },
        add(state, product){
            state.products.push(product);
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
                    .delete('api/cart/remove/' + id)
                    .then(response => {
                        if (response.data.remove === true){
                            store.commit('remove', id);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
        clear(store){
            server
                .delete('api/cart/clear/')
                .then(response => {
                    if (response.data.clear === true){
                        store.commit('clear');
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },
        changeQuantity(store, data) {
            if (isNaN(data.quantity) || data.quantity < 1){
                data.quantity = 1;
            }

            if (store.getters.inCart(data.id)
                && store.state.products[store.getters._map[data.id]].quantity !== data.quantity){
                server
                    .put('api/cart/update/' + data.id, {
                            quantity: data.quantity,
                    })
                    .then(response => {
                        if (response.data.update === true){
                            store.commit('changeQuantity', data);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
        add(store, id) {
            if(store.getters.inCart(id)){
                let quantity = store.state.products[store.getters._map[id]].quantity + 1;
                let data = {
                    id,
                    quantity
                };
                store.dispatch('changeQuantity', data);
            }
            else {
                server
                    .post('api/cart/addItem/' + id)
                    .then(response => {
                        if (response.data.product){
                            store.commit('add', response.data.product);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        }
    },
    modules: {}
}
