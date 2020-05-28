import server from "../../server";

export default {
    namespaced: true,
    state: {
        productsFound: [],
        resultEmpty: false
    },
    getters: {
        resultSearch(state){
            return state.productsFound;
        },
        resultEmpty(state){
            return state.resultEmpty;
        }
    },
    mutations: {
        loadBySearch(state, products){
            state.productsFound = products;
        },
        clearFound(state, products){
            state.productsFound = [];
            state.resultEmpty = false;
        },
        resultEmpty(state, isEmpty){
            state.resultEmpty = isEmpty;
        }
    },
    actions: {
        search(store, text) {
            server
                .get('api/search', {
                    params: {
                        text: text,
                    }
                })
                .then(response => {
                    let result = response.data.data;
                    if (result.length === 0) {
                        store.commit('resultEmpty', true);
                    }
                    store.commit('loadBySearch', result);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        clearFound(store){
            store.commit('clearFound');
        }
    },
    modules: {
    }
}
