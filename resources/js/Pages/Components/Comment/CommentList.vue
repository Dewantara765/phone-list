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
    </div>
      <div v-else>Tidak ada komentar</div>
    </div>
    
</template>