<template>
  <div>
    <div style="display: flex">
      <div style="margin-right: 30px">
        <span>Please Select a dish</span>
        <div>
          <select v-model="dish">
            <option
              v-for="(item, index) in props.listDish"
              :key="index"
              :value="item.name"
            >
              {{ item.name }}
            </option>
          </select>
        </div>
      </div>

      <div>
        <div>Please enter number of serving</div>
        <input max="10" min="0" v-model="numServing" type="number" />
      </div>
    </div>

    <div style="margin-top: 10px">
      <button style="background-color: chartreuse" @click="addDish()">
        Add
      </button>
    </div>

    <div>
      <ul>
        <li v-for="item in listDishSelect" :key="item">
          {{ item.name }} - {{ item.numServing }}
        </li>
      </ul>
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
  if (
    props.defaultData &&
    props.defaultData.listDishSelect &&
    props.defaultData.listDishSelect.length
  ) {
    console.log(props.defaultData.listDishSelect);
    listDishSelect.value = props.defaultData.listDishSelect;

    console.log();
  }
});

const listDishSelect = ref([]);

const numServing = ref(1);

const dish = ref({});

const props = defineProps(["listDish", "numPeople", "defaultData"]);

const emit = defineEmits(["nextReview", "previousStep"]);

const addDish = () => {
  listDishSelect.value.push({
    name: dish.value,
    numServing: numServing.value,
  });
};

const submitData = () => {
  const sumServing = listDishSelect.value.reduce(
    (accumulator, currentValue) => accumulator + currentValue.numServing,
    0
  );

  if (sumServing > 10) {
    alert("You can only choose a maximum of 10 servings");
    return;
  }

  if (sumServing < props.numPeople) {
    alert(
      "The number of servings must be greater than or equal to the number of people"
    );
    return;
  }

  emit("nextStepReview", listDishSelect.value);
};
</script>

<style></style>
