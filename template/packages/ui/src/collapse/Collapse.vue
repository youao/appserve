<template>
  <div class="overflow-hidden" :style="containerStyle">
    <slot name="title" :isActive="isActive">
      <div
        v-if="title"
        ref="titleRef"
        class="flex justify-between"
        @click="toggle"
      >
        <span>{{ title }}</span>
        <Icon v-if="loading" name="loading" />
        <Icon
          v-else
          name="down"
          :class="{ '-rotate-180': isActive }"
          :style="iconStyle"
        />
      </div>
    </slot>
    <div ref="contentRef" v-show="show || animating">
      <slot></slot>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from "vue";
import Icon from "../icon/Icon.vue";

const props = defineProps({
  title: String,
  visibility: {
    type: Boolean,
    default: false
  },
  duration: {
    type: Number,
    default: 250
  },
  beforeToggle: {
    type: Function
  },
  loading: {
    type: Boolean,
    default: false
  },
  disabled: {
    type: Boolean,
    default: false
  }
});

const emits = defineEmits(["change"]);

const isActive = ref(props.visibility);
const show = ref(props.visibility);
const titleRef = ref(null);
const contentRef = ref(null);
const containerH = ref("");
const animating = ref(false);

const waitDomMs = 50;

const containerStyle = computed(() => {
  if (!animating.value) return "";
  const transition = "height " + props.duration + "ms";
  return { transition, "height": containerH.value, "will-change": "height" };
});

const iconStyle = computed(() => {
  const transition = "rotate " + (props.duration + waitDomMs) + "ms";
  return { transition };
});

function toggle() {
  if (isActive.value) {
    toggleHide();
  } else {
    toggleShow();
  }
}

async function checkBeforeHandler() {
  if (typeof props.beforeToggle !== "function") return true;
  try {
    if ((await props.beforeToggle(isActive.value)) === false) return false;
  } catch {
    return false;
  }
  return true;
}

async function toggleShow() {
  if (animating.value || isActive.value || props.disabled) return;
  if (!(await checkBeforeHandler())) return;

  animating.value = true;
  isActive.value = true;
  emits("change", isActive.value);
  show.value = true;
  const titleH = getTitleHeight();
  containerH.value = titleH + "px";
  setTimeout(() => {
    const contentH = getContentHeight();
    containerH.value = titleH + contentH + "px";
    setTimeout(() => {
      animating.value = false;
    }, props.duration);
  }, waitDomMs);
}

async function toggleHide() {
  if (animating.value || !isActive.value || props.disabled) return;
  if (!(await checkBeforeHandler())) return;

  animating.value = true;
  isActive.value = false;
  emits("change", isActive.value);
  const titleH = getTitleHeight();
  const contentH = getContentHeight();
  containerH.value = titleH + contentH + "px";
  setTimeout(() => {
    containerH.value = titleH + "px";
    setTimeout(() => {
      show.value = false;
      animating.value = false;
    }, props.duration);
  }, waitDomMs);
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
