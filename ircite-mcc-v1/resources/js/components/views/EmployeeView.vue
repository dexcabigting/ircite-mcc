<template>
  <div class="employee-details">
      <table>
          <tr colspan="8"> 
              <th><h2> Employees List </h2> </th>
          </tr>
          <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Position</th>
              <th>First Name</th>
              <th>Sick Leave Credits</th>
              <th>Vacation Leave Credits</th>
              <th>Hourly rate</th>
          </tr>
          <tr v-for="employee in employees" :key="employee.id">
              <td>{{ employee.firstName }}</td>
              <td>{{ employee.lastName }}</td>
              <td>{{ employee.position }}</td>
              <td>{{ employee.firstName }}</td>
              <td>{{ employee.sickLeaveCredits }}</td>
              <td>{{ employee.vacationLeaveCredits }}</td>
              <td>{{ employee.hourlyRate }}</td>
              <td> <router-link :to="{ name: 'employee-details', params: { id: employee.id }}"> Details </router-link> </td>
          </tr>
      </table>
  </div>
</template>

<script>
import useEmployee from '../../composables/useEmployee'
import { onMounted } from 'vue'

export default {
    setup() {
        const { employees , getEmployees } = useEmployee()

        onMounted(() => {
            getEmployees()
        })

        return { employees }
    }
}
</script>

<style>
    td, th, h2 {
        text-align: center;
    }
</style>