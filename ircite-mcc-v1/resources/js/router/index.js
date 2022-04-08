import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../components/views/HomeView.vue'
import EmployeeView from '../components/views/EmployeeView.vue'
import EmployeeDetailView from '../components/views/EmployeeDetailView.vue'
import EmployeeLogView from '../components/views/EmployeeLogView.vue'

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
    },
    {
        path: '/management/employee/:id/log',
        name: 'employee-log',
        component: EmployeeLogView,
        props: true
    }
]

export default createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})