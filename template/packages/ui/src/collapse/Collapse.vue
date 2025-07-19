<template>
  <div class="overflow-hidden will-change-[height]" :style="style">
    <div
      v-if="title"
      ref="titleRef"
      class="flex justify-between"
      @click="toggle"
    >
      <span>{{ title }}</span>
      <span>{{ show ? 1 : 0 }}</span>
    </div>
    <div ref="contentRef" v-show="show || animating">
      <slot></slot>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from "vue";

const props = defineProps({
  title: String,
  duration: {
    type: Number,
    default: 300
  },
  visibility: {
    type: Boolean,
    default: false
  }
});

const show = ref(props.visibility);
const titleRef = ref(null);
const contentRef = ref(null);
const containerH = ref("");
const animating = ref(false);

const style = computed(() => {
  if (!animating.value) return "";
  const transition = "height " + props.duration + "ms";
  return { transition, height: containerH.value };
});

function toggle() {
  if (animating.value) return;
  if (show.value) {
    toggleHide();
  } else {
    toggleShow();
  }
}

function toggleShow() {
  animating.value = true;
  show.value = true;
  const titleH = getTitleHeight();
  containerH.value = titleH + "px";
  setTimeout(() => {
    const contentH = getContentHeight();
    containerH.value = titleH + contentH + "px";
    setTimeout(() => {
      animating.value = false;
    }, props.duration);
  }, 100);
}

function toggleHide() {
  animating.value = true;
  const titleH = getTitleHeight();
  const contentH = getContentHeight();
  containerH.value = titleH + contentH + "px";
  setTimeout(() => {
    containerH.value = titleH + "px";
    setTimeout(() => {
      show.value = false;
      animating.value = false;
    }, props.duration);
  }, 100);
}

function getTitleHeight() {
  if (!props.title || !titleRef.value) return 0;
  return titleRef.value.offsetHeight;
}

function getContentHeight() {
  if (!contentRef.value) return 0;
  return contentRef.value.offsetHeight;
}
</script>
