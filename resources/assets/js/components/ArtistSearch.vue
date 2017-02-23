<template>
    <div class="artist-search">

        <input 
            @keyup="artistSearch" 
            v-model="searchTerm" 
            type="text"
            class="artist-search-input" 
            placeholder="Artist name" />

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
                    id: this.value,
                    name: ''
                },
                artists: [],
                isOpen: false
            }
        },

        methods: {
            onClick(artist){
                this.artist = artist
                this.isOpen = false
                this.searchTerm = this.artist.name
                this.$emit('artistSelected', this.artist);
            },
            artistSearch(e){
                if(this.searchTerm.length > 1){
                    this.$http.get('search?term=' + this.searchTerm + '&type=artist')
                        .then(this.onSuccess, this.onError)
                }
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