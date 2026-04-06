<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Login</h4>
            </div>
            <div class="card-body">
                <div v-if="error" class="alert alert-danger">{{ error }}</div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="email" class="form-control" v-model="model.user.email" @keyup.enter="login">
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="password" class="form-control" v-model="model.user.password" @keyup.enter="login">
                </div>
                <div class="mb-3">
                    <button type="button" @click="login" class="btn btn-primary" :disabled="loading">
                        {{ loading ? 'Logging in...' : 'Login' }}
                    </button>
                    <router-link to="/auth/register" class="btn btn-link">Register</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default{
        name: 'Login',
        data(){
            return{
                model: {
                    user: {
                        email: '',
                        password: ''
                    }
                },
                error: null,
                loading: false
            }
        },
        methods: {
            async login() {
                this.error = null;
                this.loading = true;
                try {
                    const response = await axios.post('http://127.0.0.1:8000/api/login', this.model.user);
                    localStorage.setItem('access_token', response.data.access_token);
                    this.$router.push('/');
                } catch (error) {
                    if (error.response && error.response.data && error.response.data.message) {
                        this.error = error.response.data.message;
                    } else if (error.response && error.response.data && error.response.data.email) {
                        this.error = error.response.data.email[0];
                    } else {
                        this.error = "An error occurred during login.";
                    }
                } finally {
                    this.loading = false;
                }
            }
        }
    }
</script>
