import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../components/views/HomeView.vue'
import EmployeeView from '../components/views/EmployeeView.vue'
import EmployeeDetailView from '../components/views/EmployeeDetailView.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomeView
    },
    {
        path: '/management/employee/:id',
        name: 'employee-details',
        component: EmployeeDetailView,
        props: true
    },
    {
        path: '/management/employee',
        name: 'employee',
        component: EmployeeView,
    }
]

export default createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})