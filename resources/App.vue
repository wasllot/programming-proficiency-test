<template>
  <div id="app">
    <table>
      <tr>
        <th>id</th>
        <th>name</th>
      </tr>
      <tr v-for="item in properties" :key="item.name">
        <td v-text="item.id"/>
        <td v-text="item.name"/>
      </tr>
    </table>
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
