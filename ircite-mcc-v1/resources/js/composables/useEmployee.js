import { ref } from 'vue'
import axios from 'axios'

function useEmployee() {
    
    const employees = ref([{ 
        id: 1,
        firstName: 'Mark',
        lastName: 'Doe',
        position: 'Accounting',
        sickLeaveCredits: 4,
        vacationLeaveCredits: 4,
        hourlyRate: 1200
    }])
    const employee = ref(null)

    const getEmployees = async () => {
        try {
            employees.value = 
            [{ 
                id: 1,
                firstName: 'Mark',
                lastName: 'Doe',
                position: 'Accounting',
                sickLeaveCredits: 4,
                vacationLeaveCredits: 4,
                hourlyRate: 1200
            }]
        } catch (error) {
            console.log(err.response.data)
        }
    }
    const getEmployee = async (id) => {
        try {
            for(let emp in employees.value){
                if (emp.id === id) {
                    console.log(emp.id)
                    employee.value = employee
                }
            }
        } catch (error) {
            console.log(err.response.data)
        }
    }

    return { 
        employees, getEmployees, 
        employee, getEmployee 
    }
}

export default useEmployee