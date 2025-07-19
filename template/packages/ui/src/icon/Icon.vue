<template>
    <component v-if="icon" :is="icon" class="inline-block"></component>
</template>
<script setup>
import { computed } from "vue";

import IcBaselineChevronRight from "~icons/ic/baseline-chevron-right";
import IcBaselineArrowBackIos from "~icons/ic/baseline-arrow-back-ios";
import IcBaselineKeyboardArrowUp from "~icons/ic/baseline-keyboard-arrow-up";
import IcBaselineKeyboardArrowDown from "~icons/ic/baseline-keyboard-arrow-down";
import IcBaselineCheck from "~icons/ic/baseline-check";
import IcBaselineClear from "~icons/ic/baseline-clear";
import SvgSpinners180Ring from '~icons/svg-spinners/180-ring'

const iconMaps = {
  back: IcBaselineArrowBackIos,
  more: IcBaselineChevronRight,
  up: IcBaselineKeyboardArrowUp,
  down: IcBaselineKeyboardArrowDown,
  check: IcBaselineCheck,
  close: IcBaselineClear,
  loading: SvgSpinners180Ring
};

const props = defineProps({
  name: String
});

const icon = computed(() => {
  if (!props.name || !iconMaps[props.name]) return false;
  return iconMaps[props.name];
});
</script>
