<template>
    <div v-if="campaign" id="campaign" class="text-center pad"> 

        <div class="background" :style="{ backgroundImage: 'url(/uploads/' + campaign.background_image + ')' }"></div>
        <div class="inner">
            <h1 class="huge">{{ campaign.artist.name }}</h1>
            
            <section v-if="!isLoggedIn">
                
                <h1>{{ campaign.release_title }}</h1>
                <!-- <div v-if="campaign.release_artwork" class="thumbnail col4">
                    <img :src="`uploads/${campaign.release_artwork}`" alt="" />
                </div> -->

                <div class="campaign-description">{{ campaign.description }}</div>

            </section>

            <login-btn v-if="!isLoggedIn" :redirect="campaign.slug"></login-btn>

            <div v-else>
                <h1>"{{ campaign.release_title }}" will be saved to your albums when it's released</h1>

                <h2>Alternatively, save it to this playlist:</h2>

                <ajax-form action="follow">
                    
                    <playlist-selector v-if="isLoggedIn"></playlist-selector>
                    
                    <input type="checkbox" name="mailing-list" id="mailing-list" checked="checked" value="1" />
                    <label for="mailing-list">Sign up to the official mailing list</label>

                    <input type="hidden" name="campaignId" :value="campaign.id" />

                </ajax-form>
            </div>
        </div>
    </div>
</template>

<script>

    import LoginBtn from './LoginBtn.vue';
    import AjaxForm from './AjaxForm.vue';
    import PlaylistSelector from './PlaylistSelector.vue';

    export default {

        props: ['campaign'],

        computed: {
            isLoggedIn(){
                return this.$store.getters.spotifyToken !== null
            }
        },

        components: {
            LoginBtn,
            AjaxForm,
            PlaylistSelector
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
    .campaign-description{
        margin-bottom: $padding;
    }
</style>