<template>
    <div v-if="campaign" id="campaign"> 

        <div class="background" :style="{ backgroundImage: 'url(/uploads/' + campaign.bg_image + ')' }"></div>
        <div class="inner">
            <h1>{{ campaign.album_title }}</h1>
            <div class="campaign-description">{{ campaign.description }}</div>
            <album-selector v-if="isLoggedIn"></album-selector>
            <login-btn v-else></login-btn>
        </div>
    </div>
</template>

<script>

    import LoginBtn from './LoginBtn.vue';
    import AlbumSelector from './AlbumSelector.vue';

    export default {

        props: ['campaign'],

        data(){
            return {
                //
            }
        },

        created(){
            console.log(this.campaign);
            //this.fetchCampaign()
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
            /*getCampaignSlug(){
                let parts = window.location.host.split(".");
                return parts[0];
            },
            fetchCampaign(){
                this.$http.get('campaigns/'+this.slug)
                    .then(this.onSuccess, this.onError)
            },
            onSuccess(response){
                console.log(response.data)
            },
            onError(error){
                console.error(error)
            }*/
        }
    }
</script>

<style lang="scss">
    
    @import "../../sass/variables.scss";

    #campaign{
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        min-height:100vh;
        .background{
            background-size: cover;
            background-position: 50% 50%;
            position: absolute;
            height:100%;
            width:100%;
            top:0;
            left:0;
            bottom: 0;
            right:0;
            z-index: -1;
        }
    }
</style>