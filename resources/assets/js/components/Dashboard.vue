<template>
    
    <div id="dashboard" class="content group">

        <dashboard-nav></dashboard-nav>
        
        <main>
            <router-view></router-view>
        </main>

    </div>

</template>

<script>
    
    import DashboardNav from './dashboard/Nav.vue'

    export default {

        components: {
            DashboardNav
        }
    }
</script>


<style lang="scss">
    
    @import "../../sass/variables.scss";
    
    .content{
        display: flex;
    }
    #dashboard{
        nav{
            flex: 0 0 160px;
        }
    }
    main{
        background: $grey8;
        padding: $padding;
        flex: 1 1 auto;
    }
</style>