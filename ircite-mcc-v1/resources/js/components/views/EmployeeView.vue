<template>
  <div class="employee-details">
      <table>
          <tr> 
              <th colspan="10"><h2> Employees List </h2> </th>
          </tr>
          <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Position</th>
              <th>Sick Leave Credits</th>
              <th>Vacation Leave Credits</th>
              <th>Hourly rate</th>
              <th colspan="3">Actions</th>
          </tr>
          <tr v-for="employee in employees" :key="employee.id">
              <td>{{ employee.firstName }}</td>
              <td>{{ employee.lastName }}</td>
              <td>{{ employee.position }}</td>
              <td>{{ employee.sickLeaveCredits }}</td>
              <td>{{ employee.vacationLeaveCredits }}</td>
              <td>{{ employee.hourlyRate }}</td>
              <td> <router-link :to="{ name: 'employee-details', params: { id: employee.id }}"> <button class="act-button btn-process"> Details </button> </router-link> </td>
              <td> <a @click="toggleEmpEditForm(employee.id)"> <button class="act-button btn-process"> Edit </button> </a> </td>
              <td> <a @click="removeEmployee(employee.id)"> <button class="act-button btn-hot"> Delete </button> </a> </td>
          </tr>
          <tr>
              <td colspan="10"> <button class="act-button btn-process" @click="toggleEmpAddForm"> Add Employee </button> </td>
          </tr>
      </table>
      <div v-if="showEmpAddForm">
        <EmployeeAdd @submitted="addEmployee" @closeForm="toggleEmpAddForm" />
      </div>
      <div v-if="showEmpEditForm">
        <EmployeeEdit :employee="employee" @submitted="editEmployee" @closeForm="toggleEmpEditForm" />
      </div>

  </div>
</template>

<script>
import EmployeeAdd from '../EmployeeAdd.vue'
import EmployeeEdit from '../EmployeeEdit.vue'
import useEmployee from '../../composables/useEmployee'
import { ref, onMounted } from 'vue'

export default {
    components: { EmployeeAdd, EmployeeEdit },
    setup() {
        const { employees , getEmployees, employee, getEmployee, saveEmployee, updateEmployee, deleteEmployee } = useEmployee()

        const showEmpAddForm = ref(false)
        const showEmpEditForm = ref(false)

        onMounted(() => {
            getEmployees()
        })

        const toggleEmpAddForm = () => {
            showEmpAddForm.value = !showEmpAddForm.value
        }

        const toggleEmpEditForm = async (id) => {
            await getEmployee(id)
            showEmpEditForm.value = !showEmpEditForm.value
        }

        const addEmployee = async (formData) => {
            await saveEmployee(formData)
            getEmployees()
            toggleEmpAddForm()
        }

        const editEmployee = async (id, formData) => {
            await updateEmployee(id, formData)
        }

        const removeEmployee = async (id) => {
            await deleteEmployee(id)
            alert("Employee removed")
            getEmployees()
        }

        return { 
            toggleEmpAddForm,
            showEmpAddForm,
            toggleEmpEditForm,
            showEmpEditForm,
            employees,
            employee,
            addEmployee,
            editEmployee,
            removeEmployee
        }
    }
}
</script>

<style>
    table{
        margin: 0;
        margin: 0 auto;
        border: 1px solid black;
    }

    td, th {
        text-align: center;
        border: 1px solid black;
        padding: 10px;
    }

    .act-button{
        padding: 7px, 5px;
        margin: 0 10px;
        font-weight: bold;
        text-decoration: none;
        color: white;
    }
    .btn-process{
        background: var(--process-button);
    }
    .btn-hot{
        background: var(--hot-button);
    }
</style>