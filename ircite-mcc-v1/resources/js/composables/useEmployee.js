import { ref } from 'vue'
import axios from 'axios'

function useEmployee() {
    
    const employees = ref([])
    const employee = ref(null)

    const getEmployees = async () => {
        try {
            let response = await axios.get("/api/management/employee")
            employees.value = response.data.data
            console.log(employees.value)
        }
        catch (err){
            console.log(err.response.data)
        }
    }
    const getEmployee = async (id) => {
        try {
            let response = await axios.get("/api/management/employee/" + id)
            employee.value = response.data.data
        } 
        catch (error) {
            console.log(err.response.data)
        }
    }
    const saveEmployee = async (formData) => {
        try{     
            let response = await axios.post("/api/management/employee", formData)
            return response.data.data
        }
        catch(err){
            console.log(err.response.data)
        }
    }

    const deleteEmployee = async (id) => {
        try{     
            let response = await axios.delete("/api/management/employee/" + id)
            return response.data.data
        }
        catch(err){
            console.log(err.response.data)
        }
    }

    return { 
        employees, getEmployees, 
        employee, getEmployee,
        saveEmployee, deleteEmployee
    }
}

export default useEmployee