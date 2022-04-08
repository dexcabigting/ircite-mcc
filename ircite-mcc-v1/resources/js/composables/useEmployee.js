import { ref } from 'vue'
import axios from 'axios'

function useEmployee() {
    
    const employees = ref([])
    const employee = ref(null)

    const getEmployees = async () => {
        try {
            let response = await axios.get("/api/management/employee")
            employees.value = response.data.data
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
            console.log(error.response.data)
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

    const updateEmployee = async (id, formData) => {
        try {
            await axios.put("/api/management/employee/" + id, { 
                firstName: formData.get('firstName'),
                lastName: formData.get('lastName'),
                position: formData.get('position'),
                sickLeaveCredits: formData.get('sickLeaveCredits'),
                vacationLeaveCredits: formData.get('vacationLeaveCredits'),
                hourlyRate: formData.get('hourlyRate'),
             })
        } 
        catch (err) {
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
        saveEmployee, updateEmployee, 
        deleteEmployee
    }
}

export default useEmployee