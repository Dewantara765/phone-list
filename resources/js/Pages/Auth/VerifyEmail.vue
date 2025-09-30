<script setup>
import { useForm, router, Link } from '@inertiajs/vue3'
import { ref } from 'vue'

const form = useForm({})

defineProps({
    status: String,
})
const submit = () => {
    form.post(route('verification.send'))
}


</script>

<template>
  <div class="max-w-md mx-auto mt-10">
    <h1 class="text-xl font-bold mb-4">Verify Your Email</h1>
    <p class="mb-4">
      Thanks for signing up! Before getting started, could you verify your email address by
      clicking on the link we just emailed to you?
    </p>

    <p v-if="status">{{ status }}</p>

    <form @submit.prevent="submit">
        <button class="bg-teal-300 p-2">Kirim lagi Verifikasi</button>
    </form>
  </div>
</template>