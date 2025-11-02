<script setup>

import { useForm, router } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({
  phoneId: Number,
  comments: Object,

})

const form2 = useForm({
  body: '',
})

const allComments = ref([...props.comments.data])
const nextPageUrl = ref(props.comments.next_page_url)
const loading = ref(false)

function submitComment() {
  form2.post(route('phones.comments.store', props.phoneId), {
    onSuccess: (page) => { 
      form2.reset('body')
      allComments.value.push(page.props.comment);
    },  
    preserveState: false,
    preserveScroll: true,
  })
}


</script>

<template>
    <div>
      
     <form @submit.prevent="submitComment" class="mb-6 flex flex-col">
        <textarea v-model="form2.body" class="w-11/12 h-30 border p-2 rounded" placeholder="Tulis komentar..."></textarea>
        <button class="m-3 bg-blue-500 text-white px-4 py-2 rounded" :disabled="form2.processing">Kirim</button>
      </form>
    </div>
</template>