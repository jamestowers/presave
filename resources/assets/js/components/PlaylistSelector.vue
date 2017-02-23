<template>
    <div class="playlist-selector pad">
            
        <dropdown 
            @clicked="onPlaylistSelect"
            :options="playlists" 
            name="playlistId" 
            option-key="id" 
            option-value="name"
            ></dropdown>
    </div>
</template>

<script>
    
    import Dropdown from './Dropdown.vue';
    import {showErrors} from '../mixins';

    export default {
        
        mixins: [showErrors],

        data() {
            return {
                playlists: []
            }
        },

        components:{
            Dropdown
        },

        created() {
            this.fetchPlaylists()
        },

        methods: {
            fetchPlaylists() {
                let token = this.$store.getters.spotifyToken;
                this.$http.get('get-playlists?token=' + token)
                    .then(this.onSuccess, this.onError)
            },
            onSuccess(response){
                //console.log(response.data)
                this.playlists = response.data
            },
            onError(error){
                this.showErrors(error)
            },
            onPlaylistSelect(playlist){
                console.log(playlist);
            }
        }

    }
</script>