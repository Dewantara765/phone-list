<script setup>
import Button from './Components/Button.vue'
</script>
<template>
<div>
    <Head :title="` | ${$page.component} List`"/>
    <div class="sm:w-xl md:w-2xl">
    <p class="text-xl font-bold sm:hidden md:hidden lg:block">List Brand</p>
    <div class="w-sm lg:w-xl p-2 flex flex-row justify-start flex-wrap">
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
        <Button nama="Meizu"></Button>
    </div>
    </div>
</div>
</template>