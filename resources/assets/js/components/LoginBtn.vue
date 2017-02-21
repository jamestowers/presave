<template>
    <a 
        v-if="authUrl" 
        :href="authUrl" 
        role="button" 
        class="login-btn"
        >
        <svg xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 0 168 168"><path d="m84 0.3c-46.2 0-83.7 37.5-83.7 83.7 0 46.3 37.5 83.7 83.7 83.7 46.3 0 83.7-37.5 83.7-83.7 0-46.2-37.5-83.7-83.7-83.7l0 0zm38.4 120.8c-1.5 2.5-4.7 3.2-7.2 1.7-19.7-12-44.4-14.7-73.6-8.1-2.8 0.6-5.6-1.1-6.2-3.9-0.6-2.8 1.1-5.6 3.9-6.2 31.9-7.3 59.3-4.1 81.3 9.3 2.5 1.5 3.2 4.7 1.7 7.2zm10.3-22.8c-1.9 3.1-5.9 4-9 2.2-22.5-13.8-56.8-17.8-83.4-9.8-3.5 1-7.1-0.9-8.1-4.3-1-3.5 0.9-7.1 4.4-8.1 30.4-9.2 68.2-4.8 94.1 11.1 3.1 1.9 4 5.9 2.2 9v0zm0.9-23.7c-27-16-71.5-17.5-97.3-9.7-4.1 1.3-8.5-1.1-9.8-5.2-1.3-4.1 1.1-8.5 5.2-9.8 29.6-9 78.8-7.2 109.8 11.2 3.7 2.2 5 7 2.7 10.7-2.2 3.7-7 4.9-10.7 2.7z" fill="#FFFFFF"/></svg>
        Login to Pre-save
    </a>
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


<style lang="scss">
    
    @import "../../sass/variables.scss";

    .login-btn{
        color: $grey2;
    }

</style>
