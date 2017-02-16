<template>
    <div class="artist-search">
        <input @keyup="artistSearch" v-model="searchTerm" type="text" placeholder="Artist name" />
        <input v-if="artist" name="artist_id" type="hidden" :value="artist.id" />
        <div v-if="artists.length" class="artist-search-results" :class="{ open: this.isOpen }">
            <ul>
                <li 
                    v-for="artist in artists" 
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

        props: ['value'],

        data() {
            return {
                searchTerm: '',
                artist: {
                    id: this.value
                },
                artists: [],
                isOpen: false
            }
        },

        methods: {
            onClick(artist){
                this.artist = artist
                this.isOpen = false
                this.$emit('artistSelected', this.artist);
            },
            artistSearch(e){
                this.$http.get('search?term=' + this.searchTerm + '&type=artist')
                    .then(this.onSuccess, this.onError)
            },
            onSuccess(response){
                this.artists = response.data.artists.items
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
    
    .artist-search-results{
        display: none;
        &.open{
            display: block;
        }
        li{
            background: $white;
            border-bottom: 1px solid $grey7;
            display: flex;
            align-items: center;
            font-weight: $font-weight-bold;
            padding: 0;
        }
        .thumbnail{
            margin-right: $padding-half;
            flex: 0 0 60px;
            height: 60px;
            position: relative;
            img {
                border-radius: 100%;
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