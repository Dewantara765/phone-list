<script setup>

const props = defineProps({
    data: String,
    entity: String,
    height: String,
})



</script>

<template>
    
    <div>
        <li class="border-gray-300 border-1 text-xs md:text-base" :style="`height:${props.height}`"><span class="font-bold text-red-500 ml-5 text-xs md:text-base" >{{ props.entity }} :</span> {{props.data }}</li>
    </div>
  
</template>