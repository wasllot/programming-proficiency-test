<template>
  <button
    @click="$emit('click')"
    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
  >
    <slot>{{ label }}</slot>
  </button>
</template>

<script>
export default {
  name: 'Button',
  props: {
    label: {
      type: String,
      default: 'Button'
    }
  }
};
</script>