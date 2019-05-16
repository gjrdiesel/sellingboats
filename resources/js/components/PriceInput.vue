<template>
    <div>
        <money v-model="price" v-bind="money" :class="['form-control',error?'is-invalid':'']" autofocus
               required></money>
        <span class="invalid-feedback" role="alert">
            <strong>{{ error }}</strong>
        </span>
        <input type="hidden" name="price" :value="price">
    </div>
</template>
<script>
    import {Money} from 'v-money'

    export default {
        props: ['error', 'old'],
        components: {Money},
        mounted(){
            this.price = this.old;
        },
        data() {
            return {
                price: 0,
                money: {
                    decimal: '.',
                    thousands: ',',
                    prefix: '$',
                    suffix: '',
                    precision: 2,
                    masked: false
                }
            }
        }
    }
</script>