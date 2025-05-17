<template>
  <tr class="hover:bg-gray-50 transition-colors duration-200">
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
        :class="isCurrentlyRented(property) ? 'text-green-600' : 'text-red-600'"
        class="px-2 py-1 rounded-full text-xs font-semibold"
      >
        {{ isCurrentlyRented(property) ? 'Sí' : 'No' }}
      </span>
    </td>
  </tr>
</template>

<script>
export default {
  name: 'PropertyRow',
  props: {
    property: {
      type: Object,
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
};
</script>
