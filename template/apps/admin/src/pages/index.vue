<template>
  <flex justify="center" border="b-1 gray-100" mb-5>
    <a href="https://vite.dev" target="_blank">
      <img src="/vite.svg" class="logo" alt="Vite logo" />
    </a>
    <a href="https://vuejs.org/" target="_blank">
      <img src="./assets/vue.svg" class="logo vue" alt="Vue logo" />
    </a>
  </flex>

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
  padding: 1.5em;
  will-change: filter;
  transition: filter 300ms;
}
.logo:hover {
  filter: drop-shadow(0 0 2em #646cffaa);
}
.logo.vue:hover {
  filter: drop-shadow(0 0 2em #42b883aa);
}
</style>
