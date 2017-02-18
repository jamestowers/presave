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
            //
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
            //
        }
    }
</script>