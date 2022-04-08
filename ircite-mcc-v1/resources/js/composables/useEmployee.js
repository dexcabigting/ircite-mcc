import { ref } from 'vue'
import axios from 'axios'

function useEmployee() {
    
    const employees = ref([])
    const employee = ref(null)

    const getEmployees = async () => {
        try {
            let response = await axios.get("/management/employee")
            employees.value = response.data.data
        }
        catch (err){
            console.log(err.response.data)
        }
    }
    const getEmployee = async (id) => {
        try {
            let response = await axios.get("/management/employee/" + id)
            employee.value = response.data.data
        } 
        catch (error) {
            console.log(error.response.data)
        }
    }
    const saveEmployee = async (formData) => {
        try{     
            let response = await axios.post("/management/employee", formData)
            alert("Added Employee!")
            getEmployees()
            return response.data.data
        }
        catch(err){
            alert("Employee already has a record in the database.")
            console.log(err.response.data)
        }
    }

    const updateEmployee = async (id, formData) => {
        try {
            await axios.put("/management/employee/" + id, { 
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
            let response = await axios.delete("/management/employee/" + id)
            getEmployees()
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