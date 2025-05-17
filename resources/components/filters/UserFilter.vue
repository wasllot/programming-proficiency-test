<template>
  <div>
    <label for="user" class="block text-sm font-medium text-gray-700">
      Usuario
    </label>
    <select
      id="user"
      :value="selectedUser"
      @input="$emit('update:user', $event.target.value)"
      class="mt-1 block w-full border border-gray-300 rounded-md p-2 hover:border-blue-500
      focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
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
</template>

<script>
export default {
  name: 'UserFilter',
  props: {
    selectedUser: String,
    users: Array,
  },
};
</script>
