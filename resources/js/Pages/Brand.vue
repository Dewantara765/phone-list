<script setup>
import Button from './Components/Button.vue'
</script>
<template>
<div>
    <Head :title="` | ${$page.component} List`"/>
    <div class="sm:w-xl md:w-2xl">
    <p class="text-xl font-bold  lg:block">List Brand</p>
    <div class="w-sm lg:w-xl p-2 flex flex-row justify-start flex-wrap">
        <Button nama="Samsung"/>
        <Button nama="Xiaomi"/>
        <Button nama="Apple"/>
        <Button nama="Asus"/>
        <Button nama="Oppo"/>
        <Button nama="Vivo"/>
        <Button nama="Realme"/>
        <Button nama="Infinix"/>
        <Button nama="Tecno"/>
        <Button nama="Itel"/>
        <Button nama="Huawei"/>
        <Button nama="Honor"/>
        <Button nama="ZTE"/>
        <Button nama="Motorola"/>
        <Button nama="Sony"/>
        <Button nama="Google"/>
        <Button nama="Oneplus"/>
        <Button nama="Meizu"/>
    </div>
    </div>
</div>
</template>