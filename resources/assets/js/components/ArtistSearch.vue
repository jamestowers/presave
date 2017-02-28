<template>
    <div class="artist-search">

        <input 
            @keyup="artistSearch" 
            v-model="searchTerm" 
            type="text"
            class="artist-search-input" 
            placeholder="Artist name" />

        <input v-if="artist" name="artist_id" type="hidden" :value="artistId" />
        
        <div v-if="results.length" class="artist-search-results" :class="{ open: this.isOpen }">
            <ul>
                <li 
                    v-for="artist in results" 
                    @click="onClick(artist)"
                    class="group row">
                    <div class="thumbnail">
                        <img v-if="artist.images.length > 0" :src="artist.images[0].url" />
                    </div>
                    <div class="artist-name">
                        {{ artist.name }}   
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    
    export default {

        props: {
            artist: {
                type: Object,
                default(){
                    return {}
                }
            }
        },

        data() {
            return {
                initialSearchTerm: this.artist.name ? this.artist.name : '',
                searchTerm: '',
                spotifyArtist: {},
                results: [],
                isOpen: false
            }
        },

        computed: {
            selectedArtist(){
                if(this.artist){
                    return this.artist
                }else{
                    return this.spotifyArtist
                }
            },
            artistId(){
                if(this.spotifyArtist.id){ // if artist has come from Spotify API call
                    return this.spotifyArtist.id
                }else{
                    // artist has come from the database
                    return this.artist.spotify_id
                }
            }
            /*searchTerm(){
                if(this.searchTerm !== this.initialSearchTerm && )
                if(this.artist.name){
                    return this.artist.name
                } else{
                    return ''
                }
            }*/
        },

        watch: {
            artist: function(){
                this.searchTerm = this.artist.name
            }
        },

        methods: {
            onClick(artist){
                this.spotifyArtist = artist
                this.isOpen = false
                this.searchTerm = this.spotifyArtist.name
                this.$emit('artistSelected', this.spotifyArtist);
            },
            artistSearch(e){
                //console.log(this.searchTerm);
                if(this.searchTerm.length > 1){
                    this.$http.get('search?term=' + this.searchTerm + '&type=artist')
                        .then(this.onSuccess, this.onError)
                }
            },
            onSuccess(response){
                this.results = response.data.artists.items
                this.isOpen = true
            },
            onError(error){
                console.error(error.data)
            }   
        }
    }

</script>


<style lang="scss">
    
    @import "../../sass/variables.scss";
    
    .artist-search{
        position: relative;
    }

    input[type="text"].artist-search-input{
        margin-bottom: 0;
    }

    .artist-search-results{
        display: none;
        background: $grey4;
        color: $white;
        position: absolute;
        top:100%;
        width: 100%;
        z-index: 2;
        &.open{
            display: block;
        }
        ul{
            margin: 0;
        }
        li{
            border: 1px solid $grey3;
            border-width: 0 1px 1px 1px;
            cursor: pointer;
            display: flex;
            font-size: 1.2rem;
            align-items: center;
            padding: 0;
            &:hover{
                background: $grey3;
            }
        }
        .thumbnail{
            margin-right: 10px;
            flex: 0 0 40px;
            height: 40px;
            position: relative;
            img {
                position: absolute;
                display: block;
                content: '';
                top:0;
                left:0;
                overflow: hidden;
            }
        }
        .artist-name{
            flex: 1 1 auto;
        }
    }
    
</style>