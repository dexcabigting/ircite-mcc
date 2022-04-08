<template>
  <table>
      <tr>
        <th colspan="5">Employee Attendance Log</th>
      </tr>
      <tr>
        <th> Time in: </th>
        <th> Time Out: </th>
      </tr>
      <tr>
        <td> <input type="datetime-local" v-model="timein"> </td>
        <td> <input type="datetime-local" v-model="timeout"> </td>
      </tr>
      <tr>
        <td colspan="2"><button> Register Time-in and Time-Out</button></td>
      </tr>
  </table>
</template>

<script>
import { ref } from 'vue'
export default {
  props: [ "id" ],
  setup(){
     const timein = ref( new Date())
     const timeout = ref("2022-06-12T19:30")


    return { timein, timeout }
  }
}
</script>

<style>

</style>