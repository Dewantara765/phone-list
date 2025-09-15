<script setup>

const props = defineProps({
    data: String,
    entity: String,
})
</script>

<template>
    <div>
         <div v-show="props.data"><span class="font-bold text-red-500 ml-5 text-sm md:text-base" v-show="props.data">{{props.entity}} :</span> {{props.data}}</div>
    </div>
</template>