import { createRouter, createWebHashHistory } from 'vue-router'
import HomeView from '../components/views/HomeView.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomeView
    }
]

export default createRouter({
    history: createWebHashHistory(process.env.BASE_URL),
    routes
})