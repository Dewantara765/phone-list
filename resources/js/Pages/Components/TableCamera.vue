<script setup>
const props = defineProps({
    value: String,
    name: String,
})
</script>

<template>
    <span v-if="props.value" class="bold-entity-name">{{ props.name }} : </span><br v-if="props.value"><span class="entity-value">{{ props.value}}</span>
    <br v-if="props.value">
</template>