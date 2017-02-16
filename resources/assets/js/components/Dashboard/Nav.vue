<template>
    <nav>
        <li>
            <router-link to="/dashboard">Campaigns</router-link>
        </li>
        <li>
            <router-link to="/dashboard/create">Create new campaign</router-link>
        </li>
    </nav>
</template>

<script>
    
    export default {

    }

</script>

<style lang="scss">
    
    @import "../../../sass/variables.scss";

    nav{
        background: $grey2;
        color: $white;
        padding: $padding;
    }
</style>