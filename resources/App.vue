<template>
  <div id="app">
    //WORK HERE
  </div>
</template>

<script>
import { users, propertyTypes, properties } from '@/libs/api';

export default {
  name: 'App',
  data: () => ({
    users,
    propertyTypes,
    properties,
  }),
};
</script>
