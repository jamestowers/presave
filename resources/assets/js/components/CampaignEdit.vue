<template>
    
    <div id="campaign-edit">

        <h1 class="page-title">Edit campaign</h1>
        
        <form
            @submit.prevent="onSubmit" 
            action="campaigns" 
            method="POST"
            enctype="multipart/form-data">
            
            <div class="form-row">
                <label>Artist name</label>
                <artist-search 
                    @artistSelected="onArtistSelected" 
                    :artist="campaign.artist"
                    ></artist-search>
            </div>
            <div class="form-row">
                <label>Release title</label>
                <input type="text" v-model="campaign.release_title" placeholder="Album title" />
            </div>
            <div class="form-row">
                <label>Release spotify ID</label>
                <input type="text" v-model="campaign.release_spotify_id" placeholder="Spotify album id" />
            </div>
            <div class="form-row">
                <div class="group row">
                    <div class="pull-left">https://presave.tracks2.com/</div>
                    <div class="col4"><input type="text" v-model="campaign.slug" placeholder="URL prefix" /></div>
                </div>
            </div>
            <div class="form-row">
                <label>Release artwork</label>

                <div v-if="campaign.release_artwork" class="thumbnail col4">
                    <img :src="`/uploads/${campaign.release_artwork}`" alt="" />
                </div>
                
                <div class="col8">
                    <file-upload 
                        @uploadComplete="onFileUploadComplete"
                        @uploadSuccess="onReleaseArtworkUploadSuccess"
                        @uploadError="onFileUploadError"
                        label="Choose image"
                        name="release_artwork" 
                        action="/api/upload"
                        :multiple="true"
                        :maxSize=12
                        :auto="true"
                        accept='image/*'
                        >
                        </file-upload>
                </div>

            </div>
            <div class="form-row">
                <label>Description</label>
                <textarea v-model="campaign.description"></textarea>
            </div>
            <div class="form-row">
                <label>Release date</label>
                <datepicker 
                    @selected="setDate" 
                    placeholder="Release date" 
                    format="dd MMM yyyy"
                    :inline="true"
                    :value="campaign.release_date"
                    ></datepicker>
            </div>
            
            <div class="form-row">
                <label>Background image</label>

                <div v-if="campaign.background_image" class="thumbnail col4">
                    <img :src="`/uploads/${campaign.background_image}`" alt="" />
                </div>
                
                <div class="col8">
                    <file-upload 
                        @uploadComplete="onFileUploadComplete"
                        @uploadSuccess="onBackgroundImageUploadSuccess"
                        @uploadError="onFileUploadError"
                        label="Choose background image"
                        name="background_image" 
                        action="/api/upload"
                        :multiple="true"
                        :auto="true"
                        accept='image/*'
                        >
                        </file-upload>
                </div>
            </div>
            
            <input type="submit" name="submit" :value="submitButtonText" />

        </form>
    </div>

</template>

<script>
    
    import {showErrors} from '../mixins';
    import Datepicker from 'vuejs-datepicker'
    import ArtistSearch from './ArtistSearch.vue';
    //import FileUpload from 'vue-upload-component'
    import FileUpload from './FileUpload.vue'

    export default {

        mixins: [showErrors],

        props: {
            /*campaignId: {
                type: Number,
                default: null
            }*/
        },

        data() {
            return{
                editing: this.$route.name === 'campaigns-edit',
                campaign: {
                    release_title: null,
                    slug: this.UrlSlug,
                    description: null,
                    release_spotify_id: null,
                    release_artwork: null,
                    background_image: null,
                    release_date: null,
                    artist: {}
                }
            }
        },

        computed: {
            submitButtonText() {
                return this.success ? 'Saved': 'Save'
            },
            urlSlug(){
                if(this.campaign.release_title){
                    return this.campaign.release_title
                        .toLowerCase()
                        .replace(/[^\w ]+/g,'')
                        .replace(/ +/g,'-');
                }
            },
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
                if(this.$route.name === 'campaigns-edit'){
                    this.$http.get('campaigns/' + this.$route.params.campaignId)
                        .then(function(response){
                            this.campaign = response.data.campaign
                        }, function(error){
                            console.error(error)
                        })
                }
            },
            onArtistSelected(artist) {
                console.log(artist)
                this.campaign.artist = artist
            },
            setDate(e){
                //console.log(e); 
                this.campaign.release_date = e
            },
            onSubmit(){
                let requestType, url
                if(this.editing){
                    requestType =  'put'
                    url = 'campaigns/'+this.campaign.id
                }else{
                    requestType = 'post'
                    url = 'campaigns'
                }
                
                this.$http[requestType](url, this.campaign)
                    .then(this.onSuccess, this.onError);
            },
            onSuccess(response) {
                //console.log(response.data)
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
            },
            onReleaseArtworkUploadSuccess(files){
                this.campaign.release_artwork = files[0].name
            },
            onBackgroundImageUploadSuccess(files){
                this.campaign.background_image = files[0].name
            },
            onFileUploadError(error){
                this.showErrors(error)
            },
            onFileUploadComplete(){
                //
            }
        }
    }
</script>

<style lang="scss">
    
    @import "../../sass/variables.scss";

    #campaign-edit{
        .thumbnail{
            max-width: 200px;
        }
    }

</style>