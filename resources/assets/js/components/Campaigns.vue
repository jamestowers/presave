<template>
    
    <div class="campaigns">
        
        <h1 class="page-title">Campaigns</h1>
        
        <div v-if="campaigns.length > 0">
            <campaign-tile 
                v-for="campaign in campaigns" 
                :campaign="campaign"
                ></campaign-tile>
        </div>

        <div v-else>
            <div class="flex-center full-height flex-column full-width">
                <router-link :to="{ name: 'campaigns-create'}" role="button">Create a campaign</router-link>
            </div>
        </div>

    </div>

</template>

<script>

    import CampaignTile from './CampaignTile.vue';

    export default {

        data(){
            return {
                campaigns: []
            }
        },

        created(){
            this.fetchCampaigns()
        },

        components: {
            CampaignTile
        },

        methods: {
            fetchCampaigns(){
                this.$http.get('campaigns')
                    .then(this.onSuccess, this.onError)
            },
            onSuccess(response){
                //console.log(response.data)
                this.campaigns = response.data.campaigns
            },
            onError(error){
                console.error(error.data)
            }  
        }
    }
</script>

<style lang="scss">
    
    @import "../../sass/variables.scss";

</style>