import { createRouter, createWebHistory } from 'vue-router'
import authRegister from '../views/auth/register.vue'
import authLogin from '../views/auth/login.vue'


const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'Home',
            redirect: '/movies'
        },
        {
            path: '/movies',
            name: 'Movies',
            component: () => import('../views/movies/index.vue'),
            meta: { requiresAuth: true }
        },
        {
            path: '/auth/register',
            name: 'Register',
            component: authRegister,
            meta: { guest: true }
        },
        {
            path: '/auth/login',
            name: 'Login',
            component: authLogin,
            meta: { guest: true }
        }
    ]
})

router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem('access_token');

    if (to.meta.requiresAuth && !isAuthenticated) {
        next('/auth/login');
    } else if (to.meta.guest && isAuthenticated) {
        next('/movies');
    } else {
        next();
    }
});

export default router