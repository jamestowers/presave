<template>
    <form 
        :action="action" 
        :method="method"
        ref="form"
        @submit.prevent="onSubmit">
        <slot></slot>

        <button v-if="loading" class="btn-primary is-loading" type="submit" disabled>
            <i class="icon-sync"></i> Saving</button>

        <button v-else-if="errors.length" class="is-error" type="submit">
            <i class="icon-cross2"></i> Save</button>
        
        <button v-else-if="success" class="is-success" type="submit">
            <i class="icon-check"></i> Saved</button>
        
        <button v-else class="btn-primary btn-lg" type="submit">Save</button>
    </form>
</template>

<script>
    
    import formToObject from "form_to_object"
    import {showErrors} from '../mixins';

    export default {

        mixins: [showErrors],

        props: {
            action: {
                type: String,
                default: '/'
            },
            method: {
                type: String,
                default: 'POST'
            }
        },

        data() {
            return {
                loading: false,
                success: false,
                errors: []
            }
        },

        computed: {
            //
        },

        methods: {
            beforeSubmit() {
                console.log('[AjaxFrom] Submitting...')
                this.loading = true
            },
            onSubmit() {
                this.beforeSubmit()
                let vm = this
                let requestType = this.getRequestType()
                let data = formToObject(this.$refs.form)
                this.$http[requestType](this.action, data)
                    .then(this.onSuccess, this.onError);
            },
            onSuccess(response) {
                console.log('[AjaxFrom] Success')
                this.loading = false
                this.success = true
                console.log(this.success);
                this.$emit('ajaxFormSuccess', response.data)
                this.onComplete()
                let vm = this
                setTimeout(function(){
                    vm.success = false
                }, 5000)
            },
            onError(errors) {
                this.showErrors(errors)
                this.$emit('ajaxFormError', errors)
                this.onComplete()
                this.loading = false
            },
            onComplete(){
                this.$emit('ajaxFormComplete')
            },
            getRequestType() {
                return this.method.toLowerCase()
            },
        }
    }

</script>