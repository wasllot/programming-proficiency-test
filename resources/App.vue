<template>
  <div class="min-h-screen bg-gray-50">
    <Navbar />
    <div class="py-8 px-4 sm:px-6 lg:px-8">
      <div class="max-w-7xl mx-auto space-y-6">
        <FilterSection
          :selected-type="selectedPropertyType"
          :selected-user="selectedUser"
          :selected-date="selectedDate"
          :property-types="propertyTypes"
          :users="users"
          @update:type="selectedPropertyType = $event"
          @update:user="selectedUser = $event"
          @update:date="selectedDate = $event"
          @reset="resetFilters"
        />
        <PropertyTable
          :properties="filteredProperties"
          :get-user-name="getUserName"
          :get-property-type-name="getPropertyTypeName"
          :compute-months-rented="computeMonthsRented"
          :is-currently-rented="isCurrentlyRented"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { users, propertyTypes, properties } from './mocks/api';
import FilterSection from './components/filters/FilterSection.vue';
import PropertyTable from './components/table/PropertyTable.vue';
import Navbar from './components/common/Navbar.vue';

export default {
  name: 'App',
  components: {
    FilterSection,
    PropertyTable,
    Navbar,
  },
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
        if (
          this.selectedPropertyType !== ''
          && property.typeId !== parseInt(this.selectedPropertyType, 10)
        ) {
          return false;
        }
        if (
          this.selectedUser !== ''
          && property.userId !== parseInt(this.selectedUser, 10)
        ) {
          return false;
        }
        if (this.selectedDate !== '') {
          const filterDate = new Date(this.selectedDate);
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
            return false;
          }
        }
        return true;
      });
    },
  },
  methods: {
    getUserName(userId) {
      const user = this.users.find((u) => u.id === userId);
      return user ? user.name : 'Desconocido';
    },
    getPropertyTypeName(typeId) {
      const type = this.propertyTypes.find((t) => t.id === typeId);
      return type ? type.name : 'Desconocido';
    },
    computeMonthsRented(property) {
      if (!property.rentedFrom) return 0;
      const start = property.rentedFrom;
      const end = property.rentedTo ? property.rentedTo : new Date();
      let months = (end.getFullYear() - start.getFullYear()) * 12;
      months += end.getMonth() - start.getMonth();
      return months;
    },
    isCurrentlyRented(property) {
      if (!property.rentedFrom) return false;
      if (property.rentedTo === null) return true;
      const now = new Date();
      return now >= property.rentedFrom && now <= property.rentedTo;
    },
    resetFilters() {
      this.selectedUser = '';
      this.selectedPropertyType = '';
      this.selectedDate = '';
    },
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
