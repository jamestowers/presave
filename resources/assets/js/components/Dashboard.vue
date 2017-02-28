<template>
    
    <div id="dashboard" class="content group">

        <dashboard-nav></dashboard-nav>
        
        <main>
            <router-view></router-view>
        </main>

    </div>

</template>

<script>
    
    import DashboardNav from './Nav.vue'

    export default {

        components: {
            DashboardNav
        },

        created(){
            //console.log('[Dashboard]');
        }
    }
</script>


<style lang="scss">
    
    @import "../../sass/variables.scss";
    
    .content{
        display: flex;
    }
    #dashboard{
        min-height: 100vh;
        nav{
            flex: 0 0 100px;
        }
    }
    main{
        background: $grey8;
        padding: $padding;
        flex: 1 1 auto;
    }
</style>