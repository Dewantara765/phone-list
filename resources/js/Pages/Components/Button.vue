<script setup>

const props = defineProps({
    nama: String,
})

</script>
<template>
    <div>
        <Link :href="/brand/+ props.nama" class="decoration-none">
            <div class="w-17 md:w-23 rounded overflow-hidden shadow-lg m-1 p-1 bg-blue-500 hover:bg-gray-300">
                <div class="m-1">
                <p class="text-xs md:text-base text-white decoration-none font-bold hover:text-blue-300">{{ props.nama }}</p>
                </div>
            </div>
        </Link>
    </div>
</template>