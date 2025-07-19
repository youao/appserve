<template>
  <h1>test</h1>
  <Collapse title="title">
    <div class="bg-gray-200">
      <ul>
        <li>213</li>
        <li>213</li>
        <li>213</li>
        <li>213</li>
      </ul>
    </div>
  </Collapse>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import { Collapse } from "@pkg/ui";

const isShow = ref(true);
const title = ref(null);
const content = ref(null);

const titleH = ref(0);
const contentH = ref(0);

const animating = ref(false);
const duration = 300;

const style = ref({
  overflow: "hidden",
  transition: "height " + duration + "ms",
  height: "auto"
});

onMounted(() => {

});

function toggle() {
  if (animating.value) return;
  animating.value = true;
  titleH.value = title.value.offsetHeight;
  if (isShow.value) {
    style.value["height"] = titleH.value + "px";
    setTimeout(() => {
      isShow.value = false;
      animating.value = false;
    }, duration);
  } else {
    isShow.value = true;
    setTimeout(() => {
      contentH.value = content.value.offsetHeight;
      style.value["height"] = titleH.value + contentH.value + "px";
      setTimeout(() => {
        animating.value = false;
      }, duration);
    }, 100);
  }
}
</script>

<style scoped></style>
