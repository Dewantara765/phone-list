<script setup>

import { useForm } from '@inertiajs/vue3'
const props = defineProps({
  phoneId: Number,

})

const form2 = useForm({
  body: '',
})

function submitComment() {
  form2.post(route('phones.comments.store', props.phoneId), {
    onSuccess: () => form2.reset('body'),
    preserveScroll: true,
  })
}


</script>

<template>
    <div>
      
     <form @submit.prevent="submitComment" class="mb-6  flex items-center">
                      <textarea v-model="form2.body" class="w-3/4 h-30 border p-2 rounded" placeholder="Tulis komentar..."></textarea>
                      <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded" :disabled="form2.processing">Kirim</button>
      </form>
    </div>
</template>