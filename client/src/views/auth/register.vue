<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Register</h4>
            </div>
            <div class="card-body">
                <div v-if="error" class="alert alert-danger">{{ error }}</div>
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" class="form-control" v-model="model.user.name">
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="email" class="form-control" v-model="model.user.email">
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="password" class="form-control" v-model="model.user.password">
                </div>
                <div class="mb-3">
                    <button type="button" @click="register" class="btn btn-primary" :disabled="loading">
                        {{ loading ? 'Registering...' : 'Register' }}
                    </button>
                    <router-link to="/auth/login" class="btn btn-link">Login instead</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default{
        name: 'Register',
        data(){
            return{
                model: {
                    user: {
                        name: '',
                        email: '',
                        password: ''
                    }
                },
                error: null,
                loading: false
            }
        },
        methods: {
            async register() {
                this.error = null;
                this.loading = true;
                try {
                    const response = await axios.post('http://127.0.0.1:8000/api/register', this.model.user);
                    // Registration successful
                    localStorage.setItem('access_token', response.data.access_token);
                    this.$router.push('/');
                } catch (error) {
                    if (error.response && error.response.data && error.response.data.message) {
                        this.error = error.response.data.message;
                    } else {
                        this.error = "An error occurred during registration.";
                    }
                } finally {
                    this.loading = false;
                }
            }
        }
    }
</script>