<template>
  <h1>test <Icon name="loading" class="text-green text-sm" /></h1>
  <Collapse title="title">
    <div class="bg-gray-200">
      <ul>
        <li>213</li>
        <li>213</li>
        <li>213</li>
        <li>213</li>
      </ul>
      <Collapse
        title="title123"
        :before-toggle="onBeforeToggle"
        :loading="loading"
      >
        <div class="bg-gray-400">
          <ul>
            <li>212312313</li>
          </ul>
        </div>
      </Collapse>
    </div>
  </Collapse>
</template>

<script setup>
import { ref } from "vue";
import { Collapse, Icon } from "@pkg/ui";
import { sleep } from "@pkg/utils";

const loading = ref(false);

async function onBeforeToggle(val) {
  if (!val) {
    loading.value = true;
    await sleep(2000);
    loading.value = false;
  }
  return true;
}
</script>
