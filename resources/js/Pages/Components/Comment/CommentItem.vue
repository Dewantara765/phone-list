<script setup>
import { router } from '@inertiajs/vue3'
import { inject } from 'vue'
import { ref } from 'vue'
const props = defineProps({
    comment: Object,
    
})
const expanded = ref(false)
const maxLength = 150
const sharedUseAuth = inject('sharedUseAuth')

function deleteComment() {
  if (confirm('Yakin ingin menghapus komentar ini?')) {
    router.delete(route('comments.destroy', props.comment.id))
  }
}
</script>

<template>
    <div class="mb-5">
        <p class="font-semibold">{{ comment.user.username }}</p>
         <span v-if="!expanded && comment.body.length > maxLength">
        {{ comment.body.slice(0, maxLength) }}...
        <button @click="expanded = true" class="text-blue-600 text-sm ml-1">Lihat selengkapnya</button>
      </span>
      <span v-else>
        <p>{{ comment.body }}</p>
        <button
          v-if="comment.body.length > maxLength"
          @click="expanded = false"
          class="text-blue-600 text-sm ml-1"
        >Tutup</button>
        </span>
        <p class="text-xs text-gray-500">{{ new Date(comment.created_at).toLocaleString() }}</p>
        <!-- Tombol hapus hanya untuk pemilik komentar -->
    <button
      v-if="sharedUseAuth && sharedUseAuth.id === comment.user.id"
      @click="deleteComment"
      class="bg-red-500 text-white p-2 rounded sm:text-xs md:text-sm lg:text-md">
      Hapus
    </button>
    </div>
</template>