<script setup>
import { useForm } from '@inertiajs/vue3'
defineProps({ comments: Array })

const form = useForm({ body: '' })

function submit() {
  form.post(route('comments.store'), {
    onSuccess: () => form.reset('body'),
  })
}
</script>

<template>
  <div class="max-w-xl mx-auto space-y-6">
    <form @submit.prevent="submit">
      <textarea v-model="form.body" class="w-full border p-2 rounded" rows="3" placeholder="Write a comment..."></textarea>
      <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded" :disabled="form.processing">
        Submit
      </button>
    </form>

    <div v-for="comment in comments" :key="comment.id" class="border-b py-4">
      <p class="font-semibold">{{ comment.user }}</p>
      <p>{{ comment.body }}</p>
      <p class="text-sm text-gray-500">{{ new Date(comment.created_at).toLocaleString() }}</p>
    </div>
  </div>
</template>