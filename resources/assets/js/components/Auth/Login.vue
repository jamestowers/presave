<template>
    <div class="flex-center full-height flex-column full-width bg-dark">
        <div class="alert alert-danger" v-if="error">
            <p>There was an error, unable to sign in with those credentials.</p>
        </div>

        <h1>Login</h1>
        <form autocomplete="off" v-on:submit.prevent="signin">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" placeholder="Email address" v-model="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" v-model="password" required>
            </div>
            <router-link to="/register" class="pull-left">register</router-link>
            <button type="submit" class="btn btn-default">Sign in</button>
        </form>

    </div>
</template>
<script>
import auth from '../../auth.js';

export default {
    data() {
            return {
                email: null,
                password: null,
                error: false
            }
        },
        methods: {
            signin() {
                auth.login(this, this.email, this.password)
            }
        }
}
</script>