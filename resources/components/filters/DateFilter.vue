<template>
  <div>
    <label for="date" class="block text-sm font-medium text-gray-700">
      Fecha
    </label>
    <input
      type="date"
      id="date"
      :value="selectedDate"
      @input="$emit('update:date', $event.target.value)"
      class="mt-1 block w-full border border-gray-300 rounded-md p-2 hover:border-blue-500
      focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
    />
  </div>
</template>

<script>
export default {
  name: 'DateFilter',
  props: {
    selectedDate: String,
  },
};
</script>
