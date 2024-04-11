<script setup>
import { onMounted, ref } from "vue";

onMounted(() => {
  if (
    props.defaultData &&
    props.defaultData.meal &&
    props.defaultData.numberPeople
  ) {
    meal.value = props.defaultData.meal;
    numPeople.value = props.defaultData.numberPeople;
  }
});

const listMeal = ref(["breakfast", "lunch", "dinner"]);

const meal = ref(null);

const numPeople = ref(0);

const emit = defineEmits(["nextStep2"]);

const props = defineProps(["defaultData"]);

const submitData = async () => {
  if (meal.value && numPeople.value) {
    emit("nextStep2", meal.value, numPeople.value);
  } else {
    alert("Please enter complete information");
  }
};
</script>

<template>
  <div>
    <span>Please Select a meal</span>
    <div>
      <select v-model="meal">
        <option v-for="(item, index) in listMeal" :key="index" :value="item">
          {{ item }}
        </option>
      </select>
    </div>
    <br />
    <div>Please enter number of people</div>

    <div><input max="10" min="0" v-model="numPeople" type="number" /></div>

    <div>
      <button
        @click="submitData()"
        style="float: right; margin-top: 10px; background-color: cadetblue"
      >
        Next
      </button>
    </div>
  </div>
</template>

<style scoped></style>
