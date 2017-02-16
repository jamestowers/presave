<template>
    
    <div id="campaign-edit">

        <h1 class="page-title">Edit campaign</h1>
        
        <form
            @submit.prevent="onSubmit" 
            action="campaigns" 
            method="POST"
            enctype="multipart/form-data">
            
            <input type="text" v-model="campaign.album_title" placeholder="Album title" />

            <textarea v-model="campaign.description"></textarea>

            <input type="text" v-model="campaign.album_spotify_id" placeholder="Spotify album id" />

            <artist-search @artistSelected="onArtistSelected" :value="campaign.artist.spotify_id"></artist-search>

            <datepicker @selected="setDate" placeholder="Release date" :value="campaign.release_date"></datepicker>
            
            <file-upload 
                title="Add upload files"
                :name="bg_image" 
                :drop="true"
                :auto="true"
                accept='image/*'
                post-action="/post.method"
                put-action="/put.method">
                </file-upload>
            
            <input type="submit" name="submit" :value="submitButtonText" />

        </form>
    </div>

</template>

<script>
    
    import {showErrors} from '../mixins';
    import Datepicker from 'vuejs-datepicker'
    import ArtistSearch from './ArtistSearch.vue';
    import FileUpload from 'vue-upload-component'

    export default {

        mixins: [showErrors],

        props: {
            campaign_id: {
                type: Number,
                default: null
            }
        },

        data() {
            return{
                campaign: {
                    album_title: null,
                    description: null,
                    album_spotify_id: null,
                    bg_image: null,
                    release_date: null,
                    artist: {}
                }
            }
        },

        computed: {
            submitButtonText() {
                return this.success ? 'Saved': 'Save'
            }
        },

        created(){
            this.fetchCampaign()
        },

        components: {
            Datepicker,
            ArtistSearch,
            FileUpload
        },

        methods: {
            fetchCampaign(){
                if(this.campaign_id === null){
                    return false;
                }
                this.$http.get('campaigns/' + this.campaign_id)
                    .then(function(reponse){
                        this.campaign = response.data
                    }, function(error){
                        console.error(error)
                    })
            },
            onArtistSelected(artist) {
                console.log(artist)
                this.campaign.artist = artist
            },
            setDate(e){
                console.log(e); 
                this.campaign.release_date = e
            },
            onSubmit(){
                console.log(this.campaign);
                this.$http.post('/campaigns', this.campaign)
                    .then(this.onSuccess, this.onError);
            },
            onSuccess(response) {
                console.log('[Campaign submit] Success')
                this.loading = false
                this.success = true
                let vm = this
                setTimeout(function(){
                    vm.success = false
                }, 5000)
            },
            onError(errors) {
                this.showErrors(errors)
                this.loading = false
            }
        }
    }
</script>