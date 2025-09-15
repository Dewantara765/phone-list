<script setup>
import CommentItem from './CommentItem.vue'; 

const props = defineProps({
    comments: Array,
    
})

</script>

<template>
    <div>
    <div v-if="comments">
      <p class="text-lg text-red-500">{{ props.comments.length }} komentar</p>
      <div v-for="comment in comments" :key="comment.id" class="border-t pt-4 mt-4">
            <CommentItem :comment="comment"/>
      </div>
    </div>
      <div v-else>Tidak ada komentar</div>
    </div>
    
</template>