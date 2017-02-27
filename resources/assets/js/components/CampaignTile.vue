<template>
    
    <div class="campaign-tile">
        <div v-if="campaign.release_artwork" class="thumbnail">
            <img :src="`/uploads/${campaign.release_artwork}`" />
        </div>
        <div class="">
            <h2>{{ campaign.release_title}}</h2>
            
            <router-link 
                v-if="campaign.id" 
                :to="{ name: 'campaigns-edit', params: { campaignId: campaign.id }}"
                >Edit</router-link>

            <p class="small"><em>Released: {{ campaign.release_date }}</em></p>
            
            <p>{{ campaign.description }}</p>
        </div>
    </div>

</template>

<script>
    export default {

        props: {
            campaign: {
                type: Object,
                required: true
            }
        },

        data(){
            return {
                //
            }
        },

        methods: {
            //
        }
    }
</script>

<style lang="scss">
    
    @import "../../sass/variables.scss";

    .campaign-tile{
        display: flex;
        .thumbnail{
            flex: 0 0 160px;
            margin: 0 $padding $padding 0;
        }
    }

</style>