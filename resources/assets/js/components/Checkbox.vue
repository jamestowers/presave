<template>
    <div class="checkbox" :class="{'checkbox-small': small}">
        <input 
            @click="onClick" 
            type="checkbox" 
            :checked="isChecked"
            :name="name" 
            :value="value" 
            :id="id"
             />
        <div></div>
        <label :for="id">{{ label }}</label>
    </div>
</template>

<script>

export default {

    props: {
        isChecked: {
            type: Boolean,
            default: false
        },
        label: {
            type: String,
            required: true
        },
        name: {
            type: String,
            required: true
        },
        value: {
            type: String,
            required: true
        },
        small: {
            type: Boolean,
            default: false
        }
    },

    computed:{
        id(){
            return _.snakeCase(this.name)
        }
    },

}

</script>

<style lang="scss">
    
    @import "../../sass/variables.scss";

    .checkbox,
    .checkbox-small{
      position: relative;
      margin: $padding-half auto;
      label {
        position: relative;
        cursor: pointer;
        display: inline-block;
        padding-right: 4px;
        text-align: left;
      }
    }

    .checkbox input[type="checkbox"] {
      position: absolute;
      opacity: 0;
      left:0;
      top:0;
      width:100%;
      height:100%;
      & + div {
        cursor: pointer;
        display: inline-block;
        margin-right: 4px;
        vertical-align: middle;
        width:42px;
        height: 26px;
        border: 1px solid $grey6;
        border-radius: 999px;
        background: $grey7;
        overflow: hidden;
        transition: all 0.2s $ease-out-quint;
        &:before {
          content: '';
          float: left;
          width: 24px;
          height: 24px;
          margin: 0;
          border-radius: inherit;
          background: $white;
        }
      }
      &:checked + div {
        background-color: $color-primary;
        padding-left: 16px;
      }
      &:active + div:before {
        
      }
      &:focus + div {
      }
    }

    .checkbox-small{
      input[type="checkbox"] {
        & + div {
          width:34px;
          height: 20px;
          &:before {
            width: 19px;
            height: 19px;
          }
        }
        &:checked + div {
          padding-left: 14px;
        }
      }
    }

</style>