<template>
<div>
    <router-link :to="{ name: 'employee' }"> Employee </router-link>
    <!-- <router-link :to="{ name: 'employee-details', params: { 'id':1 } }"> Employee Details </router-link> -->
    <p> Hello </p>
</div>
</template>

<script>
import useEmployee from '../../composables/useEmployee'
import { onMounted } from 'vue'

export default {
    setup() {
        const { employees , getEmployees } = useEmployee()

        onMounted(() => {
            console.log("")
        })
    }
}
</script>