export const showErrors = {
    methods: {
        showErrors(errors) {
            this.$store.dispatch('setErrors', [errors.data.message])
        }
    }
}