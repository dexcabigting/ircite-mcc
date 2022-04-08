<template>
  <div @click.self.prevent="closeModal" class="backdrop">
        <div class="modal">
            <h2> Edit Employee Details </h2>
            <form @submit.prevent="handleSubmit" action="post" class="employee-add-form" id="employeeform">
                <label> First name: </label>
                <input type="text" name="firstName" required v-model="firstName">
                <label> Last name: </label>
                <input type="text" name="lastName" required v-model="lastName">
                <label> Position: </label>
                <input type="text" name="position" required v-model="position">
                <label> Sick leave credits: </label>
                <input type="number" name="sickLeaveCredits" required v-model="sickLeaveCredits">
                <label> Vacation Leave Credits: </label>
                <input type="number" name="vacationLeaveCredits" required v-model="vacationLeaveCredits">
                <label> Hourly Rate: </label>
                <input type="number" name="hourlyRate" required v-model="hourlyRate">
                <div class="employee-form-btn-wrapper">
                    <input type="submit" value="Update">
                    <input @click.prevent="closeModal" type="button" value="Cancel">
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { toRefs, reactive, onMounted } from 'vue'
export default {
    props: [ "employee" ],
    emits: [ 'closeForm', 'submitted' ],
    setup(props,{ emit }){
        const formData = reactive
        ({
            firstName: props.employee.firstName,
            lastName: props.employee.lastName,
            position: props.employee.position,
            sickLeaveCredits: props.employee.sickLeaveCredits,
            vacationLeaveCredits: props.employee.vacationLeaveCredits,
            hourlyRate: props.employee.hourlyRate
        })
        const closeModal = () => {
            emit('closeForm', props.employee.id)
        }
        function handleSubmit(){
            emit('submitted', props.employee.id, new FormData(employeeform))
        }
        return { ...toRefs(formData), handleSubmit, closeModal }
    }
}
</script>
