import { ref } from 'vue'
import axios from 'axios'

function useEmployee() {
    
    const employees = ref([])
    const employee = ref(null)

    const getEmployees = () => {
        try {
            console.log("Hello")
        } catch (error) {
            console.log(err.response.data)
        }
    }

    return { employees, getEmployees }
}

export default useEmployee