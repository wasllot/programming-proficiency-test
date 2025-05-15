<template>
  <div class="container mx-auto p-4">
    <!-- Sección de Filtros -->
    <div class="mb-4 flex gap-4 flex-wrap">
      <!-- Filtro por Tipo de Propiedad -->
      <div class="mx-2">
        <label for="propertyType" class="block text-sm font-medium text-gray-700">
          Tipo de Propiedad
        </label>
        <select
          id="propertyType"
          v-model="selectedPropertyType"
          class="mt-1 block w-full border border-gray-300 rounded-md p-2"
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

      <!-- Filtro por Usuario -->
      <div class="mx-2">
        <label for="user" class="block text-sm font-medium text-gray-700">
          Usuario
        </label>
        <select
          id="user"
          v-model="selectedUser"
          class="mt-1 block w-full border border-gray-300 rounded-md p-2"
        >
          <option value="">Todos</option>
          <option
            v-for="user in users"
            :key="user.id"
            :value="user.id"
          >
            {{ user.name }}
          </option>
        </select>
      </div>

      <!-- Filtro por Fecha -->
      <div class="mx-2">
        <label for="date" class="block text-sm font-medium text-gray-700">
          Fecha
        </label>
        <input
          type="date"
          id="date"
          v-model="selectedDate"
          class="mt-1 block w-full border border-gray-300 rounded-md p-2"
        />
      </div>

      <!-- Botón para reiniciar filtros -->
      <div class="flex items-end mx-2" >
        <button
          @click="resetFilters"
          class="bg-blue-500 text-white px-4 py-2 rounded"
        >
          Resetear Filtros
        </button>
      </div>
    </div>

    <!-- Tabla de Propiedades -->
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg overflow-hidden mt-4">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500
            uppercase tracking-wider">
              ID
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500
            uppercase tracking-wider">
              Nombre
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500
            uppercase tracking-wider">
              Tipo
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500
            uppercase tracking-wider">
              Usuario
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500
            uppercase tracking-wider">
              Meses Alquilados
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500
            uppercase tracking-wider">
              Actualmente Alquilado
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr
            v-for="property in filteredProperties"
            :key="property.id"
            class="hover:bg-gray-100 transition-colors duration-200"
          >
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
              {{ property.id }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
              {{ property.name }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
              {{ getPropertyTypeName(property.typeId) }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
              {{ getUserName(property.userId) }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
              {{ computeMonthsRented(property) }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold">
              <span
                v-if="isCurrentlyRented(property)"
                class="text-green-600"
              >
                Sí
              </span>
              <span v-else class="text-red-600">
                No
              </span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import { users, propertyTypes, properties } from '@/mocks/api';

export default {
  name: 'App',
  data() {
    return {
      users,
      propertyTypes,
      properties,
      selectedUser: '',
      selectedPropertyType: '',
      selectedDate: '',
    };
  },
  computed: {
    filteredProperties() {
      return this.properties.filter((property) => {
        // Filtrar por tipo de propiedad
        if (
          this.selectedPropertyType !== ''
          && property.typeId !== parseInt(this.selectedPropertyType, 10)
        ) {
          return false;
        }
        // Filtrar por usuario
        if (
          this.selectedUser !== ''
          && property.userId !== parseInt(this.selectedUser, 10)
        ) {
          return false;
        }
        // Filtrar por fecha:
        // Si se selecciona una fecha, se verifica que la fecha esté entre 'rentedFrom' y 'rentedTo'
        if (this.selectedDate !== '') {
          const filterDate = new Date(this.selectedDate);
          // Si la propiedad nunca ha sido alquilada, se descarta del filtrado
          if (!property.rentedFrom) {
            return false;
          }
          const start = property.rentedFrom;
          const end = property.rentedTo;
          if (end) {
            if (filterDate < start || filterDate > end) {
              return false;
            }
          } else if (filterDate < start) {
            // Si 'rentedTo' es null, se asume que sigue alquilada a partir de 'rentedFrom'
            return false;
          }
        }
        return true;
      });
    },
  },
  methods: {
    // Devuelve el nombre del usuario a partir del userId
    getUserName(userId) {
      const user = this.users.find((u) => u.id === userId);
      return user ? user.name : 'Desconocido';
    },
    // Devuelve el nombre del tipo de propiedad según su typeId
    getPropertyTypeName(typeId) {
      const type = this.propertyTypes.find((t) => t.id === typeId);
      return type ? type.name : 'Desconocido';
    },
    // Calcula la cantidad de meses alquilados.
    computeMonthsRented(property) {
      if (!property.rentedFrom) return 0;
      const start = property.rentedFrom;
      const end = property.rentedTo ? property.rentedTo : new Date();
      let months = (end.getFullYear() - start.getFullYear()) * 12;
      months += end.getMonth() - start.getMonth();
      return months;
    },
    // Determina si la propiedad se encuentra actualmente alquilada.
    isCurrentlyRented(property) {
      if (!property.rentedFrom) return false;
      if (property.rentedTo === null) return true;
      const now = new Date();
      return now >= property.rentedFrom && now <= property.rentedTo;
    },
    // Reinicia todos los filtros
    resetFilters() {
      this.selectedUser = '';
      this.selectedPropertyType = '';
      this.selectedDate = '';
    },
    // Lee los parámetros de la URL y setea los filtros iniciales
    parseURLParams() {
      const params = new URLSearchParams(window.location.search);
      if (params.has('user')) {
        this.selectedUser = params.get('user');
      }
      if (params.has('propertyType')) {
        this.selectedPropertyType = params.get('propertyType');
      }
      if (params.has('date')) {
        this.selectedDate = params.get('date');
      }
    },
  },
  mounted() {
    this.parseURLParams();
  },
};
</script>
