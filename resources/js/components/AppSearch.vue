<template>
    <div class="website-search">
        <div class="row no-gutters">
            <div class="col-10 col-md-10 col-lg-10 col-xl-11">
                <div class="search-input">
                    <input class="no-round-input no-border" type="text" placeholder="Поиск" @input="onSearchInput($event)">
                </div>
            </div>
            <div class="col-2 col-md-2 col-lg-2 col-xl-1">
                <button class="no-round-btn pink"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions} from 'vuex'

    export default {
        name: "AppSearch",
        methods: {
            ...mapActions({

            }),
            onSearch(){

            },
            onSearchInput(e){
                setTimeout(() => {
                    console.log('search query: ' + e.target.value);
                }, 1500)
            }
        }
    }
</script>

<style scoped>

</style>
