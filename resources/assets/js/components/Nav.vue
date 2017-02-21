<template>
    <nav>
        <ul>
            <li>
                <router-link to="/dashboard">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 640 640"><path d="M528 640h-448c-26.5 0-48-21.5-48-48v-416c0-26.5 21.5-48 48-48h448c26.5 0 48 21.5 48 48v416c0 26.5-21.5 48-48 48zM80 160c-8.8 0-16 7.2-16 16v416c0 8.8 7.2 16 16 16h448c8.8 0 16-7.2 16-16v-416c0-8.8-7.2-16-16-16h-448z"/><path d="M528 96h-448c-8.8 0-16-7.2-16-16s7.2-16 16-16h448c8.8 0 16 7.2 16 16s-7.2 16-16 16z"/><path d="M496 32h-384c-8.8 0-16-7.2-16-16s7.2-16 16-16h384c8.8 0 16 7.2 16 16s-7.2 16-16 16z"/><path d="M442.1 291.6c-3.7-3-8.6-4.3-13.3-3.3l-160 32c-7.5 1.5-12.9 8.1-12.9 15.7v86.2c-9.4-4-20.3-6.2-32-6.2-35.9 0-64 21.1-64 48s28.1 48 64 48 64-21.1 64-48v-114.9l128-25.6v66.7c-9.4-4-20.3-6.2-32-6.2-35.9 0-64 21.1-64 48s28.1 48 64 48 64-21.1 64-48v-128c0-4.8-2.1-9.3-5.9-12.4zM224 480c-19.5 0-32-9.5-32-16s12.5-16 32-16 32 9.5 32 16-12.5 16-32 16zM384 448c-19.5 0-32-9.5-32-16s12.5-16 32-16 32 9.5 32 16-12.5 16-32 16z"/></svg>
                    <span>My Campaigns</span>
                </router-link>
            </li>
            <li>
                <router-link to="/dashboard/create">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 640 640"><path d="M592 320h-272v-272c0-8.8-7.2-16-16-16s-16 7.2-16 16v272h-272c-8.8 0-16 7.2-16 16s7.2 16 16 16h272v272c0 8.8 7.2 16 16 16s16-7.2 16-16v-272h272c8.8 0 16-7.2 16-16s-7.2-16-16-16z"/></svg>
                    <span>Create new campaign</span>
                </router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
    
    export default {

    }

</script>

<style lang="scss">
    
    @import "../../sass/variables.scss";

    nav{
        background: $grey2;
        color: $white;
        ul{
            list-style: none;
            margin:0;
            li{
                padding: 0;
                margin: 2px;
                a{
                    background: $grey3;
                    color: $white;
                    display: block;
                    padding: $padding;
                    text-align: center;
                    width:100%;
                    span{
                        display: block;
                    }
                }
                svg{
                    path{
                        fill: $white;
                    }
                }
                font-size: 1rem;
            }
        }
    }
</style>