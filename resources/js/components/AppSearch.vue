<template>
    <div class="website-search">
        <div class="row no-gutters">
            <div class="col-10 col-md-10 col-lg-10 col-xl-11">
                <div class="search-input">
                    <input class="no-round-input no-border" type="text" placeholder="Поиск"
                           @input="onSearchInput($event)"
                           @focus="focusInput = true"
                           @blur="focusInput = false"
                    >
                    <template v-if="focusInput === true">
                        <div v-if="products.length !== 0" class="search-row">
                            <div v-for="(product, i) in products" class="search-item">
                                <div class="img-product">
                                    <img :src="'/images/' + (product.image !== null ? product.image : 'noimage.png')">
                                </div>
                                <div class="info-product">
                                    <a :href="'/products/' + product.id" v-html="highlightText(product.name)"></a>
                                </div>
                            </div>
                            <div class="search-item">
                                <div class="show-search">
                                    <a :href="showResult + '/?text=' + text">Показать все результаты</a>
                                </div>
                            </div>
                        </div>
                        <div v-else-if="(products.length === 0) && resultEmpty" class="search-row">
                            <div class="search-item">
                                <div class="show-search">
                                    Ничего не найдено
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            <div class="col-2 col-md-2 col-lg-2 col-xl-1">
                <button class="no-round-btn pink" @click="goToProductDetails(showResult + '/?text=' + text)"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex'

    export default {
        name: "AppSearch",
        props: {
          showResult: String,
        },
        data(){
          return {
              timerId: Number,
              focusInput: false,
              text: ''
          }
        },
        computed:{
            ...mapGetters({
                products: 'products/resultSearch',
                resultEmpty: 'products/resultEmpty'
            }),
        },
        methods: {
            ...mapActions({
                search: 'products/search',
                clear: 'products/clearFound'
            }),
            onSearchInput(e){
                clearTimeout(this.timerId);
                let text = e.target.value.trim();
                this.text = text;
                this.timerId = setTimeout(() => {
                    if (text.length <= 1) {
                        this.clear();
                    }
                    else {
                        this.search(text);
                    }
                }, 1500);
            },
            highlightText(str, text = this.text) {
                let regex = new RegExp(text, "i");
                let pos = str.search(regex);
                console.log(pos);
                if (pos >= 0 && text.length > 1) {
                    let textInStr = str.substr(pos, text.length);
                    let highligt = `<span style="font-weight: bold; color: #1078ff">${textInStr}</span>`;
                    return str.replace(regex, highligt);
                }
                return str;
            },
            goToProductDetails(url){
                window.location = url;
            }
        }
    }
</script>

<style scoped>
    .search-input{
        position: relative;
    }
    .search-row{
        position: absolute;
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        background: white;
        z-index: 9999;
        cursor: pointer;
    }
    .search-item:hover{
        background: #e8e7e8;
    }
    .search-item:hover .info-product a{
        color: #db7a46;
    }
    .search-item{
        display: flex;
        align-items: center;
        outline: 1px solid #ebebeb;
        width: 100%;
        min-height: 50px;
    }
    .img-product{
        flex-basis: 45px;
        flex-shrink: 0;
        margin: 1px;
    }
    .img-product img{
        max-width: 100%;
    }
    .info-product{
        flex-grow: 1;
        margin-left: 10px;
    }
    .info-product a{
        text-decoration: none;
        color: black;
    }
    .show-search{
        margin: auto;
    }
    .show-search a{
        text-decoration: none;
        color: black;
    }
    .show-search:hover{
        font-weight: bold;
    }
</style>
