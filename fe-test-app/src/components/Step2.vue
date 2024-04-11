<template>
  <div>
    <span>Please Select a Restaurant</span>
    <div>
      <select v-model="restaurant">
        <option
          v-for="(item, index) in props.listRestaurant"
          :key="index"
          :value="item.restaurant"
        >
          {{ item.restaurant }}
        </option>
      </select>
    </div>

    <div
      style="display: flex; justify-content: space-between; margin-top: 150px"
    >
      <button
        @click="$emit('previousStep')"
        style="float: right; margin-top: 10px; background-color: cadetblue"
      >
        Previous
      </button>
      <button
        @click="submitData()"
        style="float: right; margin-top: 10px; background-color: cadetblue"
      >
        Next
      </button>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from "vue";

onMounted(() => {
  if (props.defaultData && props.defaultData.restaurant) {
    restaurant.value = props.defaultData.restaurant;
  }
});

const restaurant = ref("");

const props = defineProps(["listRestaurant", "defaultData"]);

const emit = defineEmits(["nextStep3"]);

const submitData = () => {
  if (restaurant.value) {
    emit("nextStep3", restaurant.value);
  } else {
    alert("Please Select a Restaurant!");
  }
};
</script>

<style></style>
