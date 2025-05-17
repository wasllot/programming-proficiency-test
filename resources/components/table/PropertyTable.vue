<template>
  <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-200
  hover:shadow-lg">
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th
              v-for="header in headers"
              :key="header.key"
              class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase
              tracking-wider"
            >
              {{ header.label }}
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <PropertyRow
            v-for="property in properties"
            :key="property.id"
            :property="property"
            :get-user-name="getUserName"
            :get-property-type-name="getPropertyTypeName"
            :compute-months-rented="computeMonthsRented"
            :is-currently-rented="isCurrentlyRented"
          />
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import PropertyRow from './PropertyRow.vue';

export default {
  name: 'PropertyTable',
  components: {
    PropertyRow,
  },
  props: {
    properties: {
      type: Array,
      required: true,
    },
    getUserName: {
      type: Function,
      required: true,
    },
    getPropertyTypeName: {
      type: Function,
      required: true,
    },
    computeMonthsRented: {
      type: Function,
      required: true,
    },
    isCurrentlyRented: {
      type: Function,
      required: true,
    },
  },
  data() {
    return {
      headers: [
        { key: 'id', label: 'ID' },
        { key: 'name', label: 'Nombre' },
        { key: 'type', label: 'Tipo' },
        { key: 'user', label: 'Usuario' },
        { key: 'months', label: 'Meses Alquilados' },
        { key: 'status', label: 'Actualmente Alquilado' },
      ],
    };
  },
};
</script>
