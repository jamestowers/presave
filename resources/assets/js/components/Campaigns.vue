<template>
    
    <div class="campaigns">
        
        <div class="row masthead">
            <h1 class="page-title pull-left">Campaigns</h1>
            <router-link :to="{ name: 'campaigns-create'}" role="button" class="btn-sm no-flex pull-right">Create a campaign</router-link>
        </div>
        
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
    import {showErrors} from '../mixins';

    export default {

        mixins: [showErrors],

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
                this.showErrors(error)
            }  
        }
    }
</script>

<style lang="scss">
    
    @import "../../sass/variables.scss";

</style>