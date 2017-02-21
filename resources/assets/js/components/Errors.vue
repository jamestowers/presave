<template>
    <div v-if="errors.length" class="alert alert-danger" :class="classObject">
        <ul>
            <li v-for="error in errors">{{ error }}</li>
        </ul>
        <a class="close btn btn-icon icon-sm icon-cross2" href="#" @click.stop.prevent="clear()"></a>
    </div>
</template>

<script>
    
    export default{


        computed: {

          errors() {
            return this.$store.getters.errors
          },
          
          classObject() {
              return {
                  'on': this.errors.length
              }
          }
        },

        methods: {
            clear() {
                return this.$store.dispatch('clearErrors')
            }
        }
    }

</script>

<style lang="scss">
    @import "../../sass/_variables.scss";
    @import "../../sass/_mixins.scss";

    #wrapper > .alert{
      position: fixed;
      width:100%;
    }
    .alert{
      display: none;
      background: $color-message;
      //padding: $padding-half;
      text-align: center;
      margin-bottom: 20px;
      position: fixed;
      transform: perspective(1000px) rotate3d(1, 0, 0, -90deg);
      transform-origin: top center;
      transition: transform 0.4s ease-out;
      backface-visibility: visible !important;
      opacity:0;
      width: 100%;
      z-index: 11;
      &.on{
        @include flipInX();
        opacity:1;
        display: block;
      }
      .close{
        color: $white;
        border-color: $white;
        position: absolute;
        right: $padding-half;
        top:50%;
        transform: translateY(-50%);
      }
      ul{
        margin: 0;
      }
      &.message{
        color:$grey2;
      }
      &.error,
      &.alert-danger{
        background: $color-error;
        color:$white;
      }
      &.success,
      &.alert-success{
        background: $color-success;
        color:$white;
      }
    }
    .no-csstransforms3d.csstransforms{
      .alert{
        transform: translateY(-100%);
        -ms-transform: translateY(-100%);
        &.on{
          transform: translateY(0);
          -ms-transform: translateY(0);
        }
      }
    }

    .success{
      color:$color-success;
    }
    .error{
      color:$color-error;
    }

</style>