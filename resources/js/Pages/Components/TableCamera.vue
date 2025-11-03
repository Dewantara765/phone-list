<script setup>
const props = defineProps({
    value: String,
    name: String,
})
</script>

<template>
    <span v-if="props.value" class="bold-phone-name">{{ props.name }} : </span><br v-if="props.value">{{ props.value}}
    <br v-if="props.value">
</template>