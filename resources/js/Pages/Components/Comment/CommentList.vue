<script setup>
import CommentItem from './CommentItem.vue'; 
import { router } from '@inertiajs/vue3';

const props = defineProps({
    comments: Object,
    
})

function goTo(url) {
  if (url) {
    router.get(url, {}, { preserveScroll: true, preserveState: true })
  }
  
}
</script>

<template>
    <div>
     
      
    <div v-if="comments">
      <p class="text-lg text-red-500">{{ comments.total }} komentar</p>
      <div v-for="comment in comments.data" :key="comment.id" class="border-t pt-4 mt-4">
            <CommentItem :comment="comment"/>
      </div>
      <!-- Pagination -->
    <div class="flex space-x-2 mt-4">
      <button
        v-for="link in comments.links"
        :key="link.label"
        @click="goTo(link.url)"
        v-html="link.label"
        class="px-3 py-1 border rounded"
        :class="{ 'bg-blue-500 text-white': link.active, 'opacity-50': !link.url }"
        :disabled="!link.url"
      />
    </div>
    </div>
      <div v-else>Tidak ada komentar</div>
    </div>
    
</template>