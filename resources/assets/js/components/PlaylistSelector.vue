<template>
    <div class="playlist-selector pad">
        <ajax-form
            action="save-to-playlist">
            
            <dropdown 
                @clicked="onPlaylistSelect"
                :options="playlists" 
                name="playlistId" 
                option-key="id" 
                option-value="name"
                ></dropdown>

            <input type="checkbox" name="mailing-list" id="mailing-list" checked="checked" value="1" />
            <label for="mailing-list">Sign up to the official mailing list</label>

        </ajax-form>
    </div>
</template>

<script>
    
    import AjaxForm from './AjaxForm.vue';
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
            AjaxForm,
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