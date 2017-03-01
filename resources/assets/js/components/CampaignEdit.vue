<template>
    
    <div id="campaign-edit">

        <h1 class="page-title">Edit campaign 

            <a :href="`/${campaign.slug}`"
                v-if="editing"
                role="button" 
                target="_blank"
                class="btn-sm pull-right"
                >Preview campaign</a> 
        </h1>

        
        
        <form
            @submit.prevent="onSubmit" 
            action="campaigns" 
            method="POST"
            enctype="multipart/form-data">
            
            <fieldset>
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
                        <label class="pull-left">presave.tracks2.com/</label>
                        <div class="col4"><input type="text" v-model="campaign.slug" placeholder="URL" /></div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
            
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
            </fieldset>

            <fieldset>
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

                 <div class="form-row">
                    <label>Text colour</label>
                    <p class="description">Set text colour to improve visibility over background image</p>
                    <div class="text-colors">
                        <div 
                            v-for="(color, index) in colors"
                            @click="selectColor(index)"
                            class="swatch"
                            :class="{ active: selectedColorIndex === index }"
                            :style="{backgroundColor: `#${color}`}"
                            >
                            </div>
                    </div>
                </div>
            </fieldset>

            <button type="submit" class="pull-right">{{ submitButtonText }}</button>
            
            <a :href="`/${campaign.slug}`"
                v-if="success || editing"
                role="button" 
                target="_blank"
                class="btn-tertiary pull-right"
                >Preview campaign</a> 

        </form>
    </div>

</template>

<script>
    
    import {showErrors} from '../mixins';
    import Datepicker from 'vuejs-datepicker'
    import ArtistSearch from './ArtistSearch.vue';
    import FileUpload from './FileUpload.vue'

    export default {

        mixins: [showErrors],

        data() {
            return{
                editing: this.$route.name === 'campaigns-edit',
                success: false,
                campaign: {
                    release_title: null,
                    slug: this.UrlSlug,
                    description: null,
                    release_spotify_id: null,
                    release_artwork: null,
                    background_image: null,
                    release_date: null,
                    text_color: null,
                    artist: {}
                },
                colors: [
                    '222222', 'FFFFFF'
                ]
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
            selectedColorIndex(){
                if(this.campaign.text_color){
                    return this.colors.indexOf(this.campaign.text_color)
                }else{
                    return 0
                }
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
                this.campaign.artist = artist
            },
            setDate(e){
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
                }, 10000)
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
            },
            selectColor(index){
                this.selectedColorIndex = index
                this.campaign.text_color = this.colors[index]
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

    .text-colors{
        .swatch{
            border-radius: 4px;
            border: 1px solid $grey7;
            cursor: pointer;
            float: left;
            height:100px;
            width: 100px;
            margin: 0 $padding-half $padding-half 0;
            &.active{
                border: 4px solid $color-primary;
            }
        }
    }

</style>