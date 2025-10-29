<script setup>
import {ref, watch} from 'vue'
import { usePage } from '@inertiajs/vue3';
import CommentItem from './CommentItem.vue'; 
import { router } from '@inertiajs/vue3';
import Pagination from '../Pagination.vue';

const props = defineProps({
    comments: Object,
    
})

const page = usePage();
const comments = ref(props.comments);

function goTo(url) {
  if (url) {
    router.get(url, {}, { preserveScroll: true, preserveState: true })
  }
  
}

// const loadMore = () => {
//   if(!comments.value.next_page_url) return;
//   router.get(comments.value.next_page_url, {}, { 
//     preserveScroll: true, 
//     preserveState: true,
//     onSuccess: (newPage) => {
//       comments.value = {
//         ...newPage.props.comments,
//         data: [...comments.value.data, ...newPage.props.comments.data]
//       }
//     }
//   })
// }
</script>

<template>
    <div>
     
      
    <div v-if="comments">
      <p class="text-lg text-red-500">{{ comments.total}} komentar</p>
      <div v-for="comment in comments.data" :key="comment.id" class="border-t pt-4 mt-4">
            <CommentItem :comment="comment"/>
      </div>
      <Pagination :links="comments.links" @click="goTo(url)" />
      <!-- <button v-if="comments.next_page_url" @click="loadMore">Load more...</button> -->
    </div>
      <div v-else>Tidak ada komentar</div>
    </div>
    
</template>