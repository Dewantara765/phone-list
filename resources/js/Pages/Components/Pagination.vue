<script setup>
import { Link } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3';

const props = defineProps({
    links: Array,
});
</script>
<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap my-4">
      <button
        v-for="link in links"
        :key="link.label"
        :disabled="!link.url"
        @click="link.url && router.visit(link.url)"
        v-html="link.label"
        class="px-3 py-1 border mx-1 hover:bg-gray-200 disabled:opacity-50"
      />
    </div>
  </div>
</template>