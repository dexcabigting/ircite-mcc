<template>
  <div class="employee-details">
      <table>
          <tr> 
              <th colspan="7"><h2> Employee Detail </h2> </th>
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
          <tr v-if="employee">
              <td>{{ employee.firstName }}</td>
              <td>{{ employee.lastName }}</td>
              <td>{{ employee.position }}</td>
              <td>{{ employee.firstName }}</td>
              <td>{{ employee.sickLeaveCredits }}</td>
              <td>{{ employee.vacationLeaveCredits }}</td>
              <td>{{ employee.hourlyRate }}</td>
          </tr>
          <tr>
              <td colspan="7"> <router-link :to="{ name: 'employee' }"> <button class="btn-process"> Return to Employees List </button> </router-link></td>
          </tr>
      </table>
  </div>
</template>

<script>
import useEmployee from '../../composables/useEmployee'
import { onMounted } from 'vue'

export default {
    props: [ "id" ],
    setup(props) {
        const { employee , getEmployee } = useEmployee()

        onMounted(() => {
            getEmployee(props.id)
        })

        return { employee }
    }
}
</script>

<style>

</style>