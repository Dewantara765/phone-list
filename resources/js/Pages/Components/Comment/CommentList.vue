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
const allComments = ref([...props.comments.data])
const nextPageUrl = ref(props.comments.next_page_url)
const loading = ref(false)

watch(
  () => props.comments.data,
  (newData) => {
    allComments.value = [...newData]
    nextPageUrl.value = props.comments.next_page_url
  }
)

function loadMore() {
  if (!nextPageUrl.value) return
  loading.value = true

  router.get(nextPageUrl.value, {}, {
    preserveScroll: true,
    preserveState: true,
    replace: false,
    onSuccess: (page) => {
      const newComments = page.props.comments.data
      allComments.value.push(...newComments)
      nextPageUrl.value = page.props.comments.next_page_url
      loading.value = false
    },
  })
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
      <p class="text-lg text-red-500">{{ comments.total}} komentar</p>
        <div v-for="comment in allComments" :key="comment.id" class="border-t pt-4 mt-4">
              <CommentItem :comment="comment"/>
        </div>

      <div class="mt-4">
        <button
          v-if="nextPageUrl"
          @click="loadMore"
          class= " px-4 py-2 rounded text-sm text-blue-500 bg-blue-200"
          :disabled="loading"
        >
          <span v-if="!loading">Load More...</span>
          <span v-else>Loading...</span>
      </button>
     
    </div>
      
    </div>
    <div v-else>Tidak ada komentar</div>
    </div>
    
</template>