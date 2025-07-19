<template>
  <div flex mb-5>
    <a href="https://vite.dev" target="_blank">
      <img src="@/assets/vite.svg" class="logo" alt="Vite logo" />
    </a>
    <a href="https://vuejs.org/" target="_blank">
      <img src="@/assets/vue.svg" class="logo vue" alt="Vue logo" />
    </a>
  </div>

  <router-link to="/user">user</router-link>

  <HelloWorld msg="Vite + Vue" />
</template>

<script setup>
import HelloWorld from "@/components/HelloWorld.vue";
import { Button } from "@pkg/ui";
import { time } from "@pkg/utils";

console.log(time());

const icon = "i-weui";
const icona = "add-friends-filled";
</script>

<style scoped>
.logo {
  height: 6em;
}
</style>
