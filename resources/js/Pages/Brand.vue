<script setup>
import Button from './Components/Button.vue'
</script>
<template>
<div>
    <Head :title="` | ${$page.component} List`"/>
    <p class="text-xl font-bold">List Brand</p>
    <div class="block w-2xl m-3 p-3 flex flex-row justify-start flex-wrap">
        <Button nama="Samsung"></Button>
        <Button nama="Xiaomi"></Button>
        <Button nama="Apple"></Button>
        <Button nama="Asus"></Button>
        <Button nama="Oppo"></Button>
        <Button nama="Vivo"></Button>
        <Button nama="Realme"></Button>
        <Button nama="Infinix"></Button>
        <Button nama="Tecno"></Button>
        <Button nama="Itel"></Button>
        <Button nama="Huawei"></Button>
        <Button nama="Honor"></Button>
        <Button nama="ZTE"></Button>
        <Button nama="Motorola"></Button>
        <Button nama="Sony"></Button>
        <Button nama="Google"></Button>
        <Button nama="Oneplus"></Button>
    </div>
    
</div>
</template>