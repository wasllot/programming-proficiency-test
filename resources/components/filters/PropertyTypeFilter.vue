<template>
  <div>
    <label for="propertyType" class="block text-sm font-medium text-gray-700 mb-2">
      Tipo de Propiedad
    </label>
    <select
      id="propertyType"
      :value="selectedType"
      @input="$emit('update:type', $event.target.value)"
      class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500
      focus:ring-blue-500 transition duration-200"
    >
      <option value="">Todos</option>
      <option
        v-for="type in propertyTypes"
        :key="type.id"
        :value="type.id"
      >
        {{ type.name }}
      </option>
    </select>
  </div>
</template>

<script>
export default {
  name: 'PropertyTypeFilter',
  props: {
    selectedType: String,
    propertyTypes: Array,
  },
};
</script>
