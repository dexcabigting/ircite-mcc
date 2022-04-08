<template>
  <div @click.self="closeModal" class="backdrop">
        <div class="modal">
            <h2> Add Form </h2>
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
                    <input type="submit" value="Add">
                    <input @click="closeModal" type="button" value="Cancel">
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { toRefs, reactive } from 'vue'
export default {
    props: [ "id" ],
    emits: [ 'closeForm', 'submitted' ],
    setup(props,{ emit }){
        const formData = reactive
        ({
            firstName: 'Mark',
            lastName: 'Doe',
            position: 'Accounting',
            sickLeaveCredits: 4,
            vacationLeaveCredits: 4,
            hourlyRate: 1200
        })
        const closeModal = () => {
            emit('closeForm')
        }
        function handleSubmit(){
            emit('submitted', new FormData(employeeform))
        }
        return { ...toRefs(formData), handleSubmit, closeModal }
    }
}
</script>

<style>
    .modal {
        width: 400px;
        padding: 20px;
        margin: 100px auto;
        background: white;
        border-radius: 10px;
    }
    .backdrop {
        top: 0;
        position: fixed;
        background: rgba(0, 0, 0, 0.5);
        width: 100%;
        height: 100%;
    }
    .employee-add-form{
        display: flex;
        flex-direction: column;
    }
    .employee-add-form > input[type="text"] .employee-add-form > input[type="number"]{
        height: 1.4rem;
        border-radius: 10px;
    }
    .employee-form-btn-wrapper{
        display: flex;
        justify-content: space-evenly;
        margin-top: 10px;
    }
    input[value="Add"], input[value="Update"]{
        padding: 1.4rem;
        background-color: var(--process-button);
        border-radius: 10px;
    }
    input[value="Cancel"]{
        padding: 1.4rem;
        background-color: var(--hot-button);
        border-radius: 10px;
    }
</style>
