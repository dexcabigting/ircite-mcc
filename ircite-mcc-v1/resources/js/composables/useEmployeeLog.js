import { ref } from 'vue'
import axios from 'axios'

function useEmployeeLog() {
    
    const employees = ref([])
    const employeeLog = ref(null)

    const getEmployees = async () => {
        try {
            let response = await axios.get("/api/management/employee")
            employees.value = response.data.data
        }
        catch (err){
            console.log(err.response.data)
        }
    }

    return { 
        employees, getEmployees, 
        employee, getEmployee,
        saveEmployee, updateEmployee, 
        deleteEmployee
    }
}

export default useEmployee