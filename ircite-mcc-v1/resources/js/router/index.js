import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../components/views/HomeView.vue'
import OtherView from '../components/views/OtherView.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomeView
    },
    {
        path: '/other',
        name: 'other',
        component: OtherView
    }
]

export default createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})