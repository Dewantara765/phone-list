<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
const user = computed(() => usePage().props.user);

</script>

<template>
    <div>
    <div class="max-w-md mx-auto mt-10">
    <p class="mb-2">
     Selamat, anda berhasil login sebagai <b>{{ user.username }}</b>
    </p>
    <p class="mb-4">
        Kini anda bisa memberikan like dan komentar
    </p>
        <Link :href="route('phones.index')" class="bg-teal-300 p-2">Kembali ke home</Link>
  
  </div>
    </div>
</template>