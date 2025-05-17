<template>
  <div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="p-6">
      <h2 class="text-lg font-semibold text-gray-800 mb-4">Filtros de Búsqueda</h2>
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <PropertyTypeFilter
          :selected-type="selectedType"
          :property-types="propertyTypes"
          @update:type="$emit('update:type', $event)"
        />
        <UserFilter
          :selected-user="selectedUser"
          :users="users"
          @update:user="$emit('update:user', $event)"
        />
        <DateFilter
          :selected-date="selectedDate"
          @update:date="$emit('update:date', $event)"
        />
        <div class="flex items-end">
          <button
            @click="$emit('reset')"
            class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2
            rounded-lg transition-all duration-200 hover:scale-105"
          >
            Resetear Filtros
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import PropertyTypeFilter from './PropertyTypeFilter.vue';
import UserFilter from './UserFilter.vue';
import DateFilter from './DateFilter.vue';

export default {
  name: 'FilterSection',
  components: {
    PropertyTypeFilter,
    UserFilter,
    DateFilter,
  },
  props: {
    selectedType: String,
    selectedUser: String,
    selectedDate: String,
    propertyTypes: Array,
    users: Array,
  },
};
</script>
