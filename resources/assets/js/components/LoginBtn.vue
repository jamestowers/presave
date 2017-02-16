<template>
    <a v-if="authUrl" :href="authUrl" role="button">Login</a>
</template>

<script>

    import {showErrors} from '../mixins';

    export default {
        
        mixins: [showErrors],

        data() {
            return {
                authUrl: null
            }
        },

        created(){
            this.getAuthUrl()
        },

        methods: {
            getAuthUrl(){
                this.$http.get('login')
                    .then(this.onSuccess, this.onError);
            },
            onSuccess(response) {
                this.authUrl = response.data
                this.loading = false
            },
            onError(errors) {
                this.showErrors(errors)
                this.loading = false
            }
        }
        
    }
</script>