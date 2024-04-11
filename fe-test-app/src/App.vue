<script setup>
import axios from "axios";
import { ref } from "vue";
import Step1 from "./components/Step1.vue";
import Step2 from "./components/Step2.vue";
import Step3 from "./components/Step3.vue";
import Review from "./components/Review.vue";

const step = ref(1);

let listRestaurantFilter = [];

let listDish = [];

let dataReview = ref({});

const nextStep2 = async (meal, numPeople) => {
  const data = await axios.get(
    "http://127.0.0.1:8000/api/filter-step-1?meal=" + meal
  );

  listRestaurantFilter = data.data;

  dataReview.value.numberPeople = numPeople;

  dataReview.value.meal = meal;

  step.value = 2;
};

const nextStep3 = async (restaurant) => {
  const data = await axios.get(
    "http://127.0.0.1:8000/api/filter-step-2?meal=" +
      dataReview.value.meal +
      "&restaurant=" +
      restaurant
  );

  listDish = data.data;

  dataReview.value.restaurant = restaurant;

  step.value = 3;
};

const nextStepReview = async (listDishSelect) => {
  dataReview.value.listDishSelect = listDishSelect;

  step.value = 4;
};

const previousStep = async () => {
  step.value--;
};
</script>

<template>
  <Step1 v-if="step == 1" @nextStep2="nextStep2" :defaultData="dataReview" />
  <Step2
    v-if="step == 2"
    :defaultData="dataReview"
    :listRestaurant="listRestaurantFilter"
    @nextStep3="nextStep3"
    @previousStep="previousStep"
  />
  <Step3
    v-if="step == 3"
    :defaultData="dataReview"
    :listDish="listDish"
    :numPeople="dataReview.numberPeople"
    @nextStepReview="nextStepReview"
    @previousStep="previousStep"
  />

  <Review
    v-if="step == 4"
    :dataReview="dataReview"
    @nextStepReview="nextStepReview"
    @previousStep="previousStep"
  />
</template>

<style scoped>
.logo {
  height: 6em;
  padding: 1.5em;
  will-change: filter;
  transition: filter 300ms;
}
.logo:hover {
  filter: drop-shadow(0 0 2em #646cffaa);
}
.logo.vue:hover {
  filter: drop-shadow(0 0 2em #42b883aa);
}
</style>
