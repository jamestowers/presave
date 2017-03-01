<template>
    <div 
        v-if="campaign" 
        id="campaign" 
        class="text-center pad"
        :style="{ color: campaign.text_color }"
        > 

        <div class="background" :style="{ backgroundImage: 'url(' + backgroundImage + ')' }"></div>
        <div class="inner">

            <transition name="fade">
                <h1 v-if="!saved" class="huge">{{ campaign.artist.name }}</h1>
            </transition>

            <transition name="fade">
                <section v-if="!isLoggedIn">
                    
                    <h1>{{ campaign.release_title }}</h1>
                    <!-- <div v-if="campaign.release_artwork" class="thumbnail col4">
                        <img :src="`uploads/${campaign.release_artwork}`" alt="" />
                    </div> -->

                    <div class="campaign-description">{{ campaign.description }}</div>

                </section>
            </transition>
            
            <transition name="fade">
                <div v-if="isLoggedIn">
                    
                    <transition name="fade">
                        <div v-if="!saved">
                            <h1>"{{ campaign.release_title }}" will be saved to your albums when it's released</h1>

                            <h2>Alternatively, save it to this playlist:</h2>

                            <ajax-form 
                                @ajaxFormSuccess="onCampaignFollowed" 
                                action="follow">
                                
                                <playlist-selector 
                                    v-if="isLoggedIn"
                                    @playlistSelected="onPlaylistSelected"
                                    ></playlist-selector>
                                
                                <input type="checkbox" name="mailing-list" id="mailing-list" checked="checked" value="1" />
                                <label for="mailing-list">Sign up to the official mailing list</label>

                                <input type="hidden" name="campaignId" :value="campaign.id" />

                            </ajax-form>
                        </div>
                    
                        <div v-else>
                            <svg xmlns="http://www.w3.org/2000/svg" width="260" height="260" viewBox="0 0 640 640"><path d="M304 640c-81.2 0-157.5-31.6-215-89s-89-133.8-89-215c0-81.2 31.6-157.5 89-215s133.8-89 215-89c81.2 0 157.5 31.6 215 89s89 133.8 89 215-31.6 157.5-89 215c-57.4 57.4-133.8 89-215 89zM304 64c-150 0-272 122-272 272s122 272 272 272 272-122 272-272-122-272-272-272z"/><path d="M240 464c-4.1 0-8.2-1.6-11.3-4.7l-96-96c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0l84.7 84.7 212.7-212.7c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6l-224 224c-3.1 3.1-7.2 4.7-11.3 4.7z"/></svg>

                        </div>
                    </transition>
                </div>

                <login-btn v-else :redirect="campaign.slug"></login-btn>
            </transition>
        </div>
    </div>
</template>

<script>

    import LoginBtn from './LoginBtn.vue';
    import AjaxForm from './AjaxForm.vue';
    import PlaylistSelector from './PlaylistSelector.vue';

    export default {

        //props: ['campaign'],

        data(){
            return {
                campaign: null,
                saved: false
            }
        },

        created(){
            //console.log('[Campaign]');
            this.fetchCampaign()
        },
        beforeRouteUpdate(){
            document.title = this.campaign.release_title
        },

        computed: {
            isLoggedIn(){
                return this.$store.getters.spotifyToken !== null
            },
            backgroundImage(){
                return '/images/' + this.$store.getters.screenSize + '/' + this.campaign.background_image
            }
        },

        components: {
            LoginBtn,
            AjaxForm,
            PlaylistSelector
        },

        methods:{
            fetchCampaign(){
                this.$http.get('campaigns' + this.$route.params[0])
                    .then(this.onSuccess, this.onError)
            },
            onSuccess(response){
                this.campaign = response.data.campaign
                document.title = this.campaign.release_title
            },
            onError(error){
                if(error.status === 404){
                    console.error(error.statusText)
                    //this.$router.push({ name: '404'})
                }
            },
            onCampaignFollowed(response){
                //console.log(response);
                this.saved = true
            },
            onPlaylistSelected(playlist) {
                console.log(playlist);
            }
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