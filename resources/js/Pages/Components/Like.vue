<script setup>
import { defineEmits } from 'vue'
const props = defineProps({
    phone: Object,
    liked: Boolean,
    likeCount: Number,
})

const emit = defineEmits(['toggle-like'])

const toggleLike = () => {
    emit('toggle-like')
}
</script>

<template>
    <div>
        <button @click="toggleLike" :class="liked ? 'text-red-500' : 'text-gray-500'">
                        ❤️
                        </button>
    <span>{{ likeCount }} </span>
    </div>
</template>