<template>
<div>
    <div class="row">
        <div class="col">
            Cart Total: {{total}}
            <slot></slot>
        </div>
    </div>
</div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "AppCart",
        computed: {
            ...mapGetters({
                total: 'cart/total'
            })
        },
        methods: {
            ...mapActions({
                loadCart: 'cart/load'
            })
        }
    }
</script>

<style scoped>

</style>
