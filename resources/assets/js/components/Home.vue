<template>
    <div id="home">
        <album-selector v-if="isLoggedIn"></album-selector>
        <login-btn v-else></login-btn>
    </div>
</template>

<script>

    import LoginBtn from './LoginBtn.vue';
    import AlbumSelector from './AlbumSelector.vue';

    export default {

        created(){
            console.log('[Home] ready')
            this.checkForLoggedInUser()
        },

        computed: {
            isLoggedIn(){
                return this.$store.getters.authed
            }
        },

        components: {
            LoginBtn,
            AlbumSelector
        },

        methods:{
            checkForLoggedInUser(){
                console.log(this.$store.getters.user);
            }
        }
    }
</script>