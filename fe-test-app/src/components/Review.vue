<script setup>
import { onMounted, ref } from "vue";

const props = defineProps(["dataReview"]);
</script>

<template>
  <div style="width: 500px">
    <div style="margin-left: 50px; margin-right: 50px">
      <div style="display: flex; justify-content: space-between">
        <span style="width: 60px">Meal</span>
        <span>{{ props.dataReview.meal }}</span>
      </div>
      <div style="display: flex; justify-content: space-between">
        <span>No of people</span>
        <span>{{ props.dataReview.numberPeople }}</span>
      </div>
      <div style="display: flex; justify-content: space-between">
        <span>Restaurant</span>
        <span>{{ props.dataReview.restaurant }}</span>
      </div>
      <div style="display: flex; justify-content: space-between">
        <span>Dishes</span>
        <ul>
          <li v-for="item in props.dataReview.listDishSelect" :key="item">
            {{ item.name }} - {{ item.numServing }}
          </li>
        </ul>
      </div>
    </div>
    <br />
    <div style="display: flex; justify-content: space-between">
      <button
        @click="$emit('previousStep')"
        style="float: right; margin-top: 10px; background-color: cadetblue"
      >
        Previous
      </button>
      <button
        style="float: right; margin-top: 10px; background-color: cadetblue"
      >
        Submit
      </button>
    </div>
  </div>
</template>

<style scoped></style>
