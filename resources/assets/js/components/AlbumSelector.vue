<template>
    <div class="ul">
        <li v-for="album in albums">{{ album.album.name }} - {{ album.album.id }}</li>
    </div>
</template>

<script>
    
    import {showErrors} from '../mixins';

    export default {
        
        mixins: [showErrors],

        data() {
            return {
                albums: []
            }
        },

        created() {
            this.fetchAlbums()
        },

        methods: {
            fetchAlbums() {
                let token = this.$store.getters.spotifyToken;
                this.$http.get('get-albums?token=' + token)
                    .then(this.onSuccess, this.onError)
            },
            onSuccess(response){
                //console.log(response.data[0].album)
                this.albums = response.data
            },
            onError(error){
                this.showErrors(error)
            }
        }

    }
</script>