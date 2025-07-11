<script setup>

const props = defineProps({
    nama: String,
})

</script>
<template>
    <div>
        <Link :href="/brand/+ props.nama" class="decoration-none">
            <div class="w-20 rounded overflow-hidden shadow-lg m-1 p-1 bg-white hover:bg-gray-300">
                <div class="m-3">
                <p class="text-sm text-indigo-500 decoration-none font-bold hover:text-blue-300">{{ props.nama }}</p>
                </div>
            </div>
        </Link>
    </div>
</template>