<script setup>
import Layout from '../Layouts/Layout.vue';
import Pagination from './Components/Pagination.vue'
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
    phones : Object,
    keyword : String,
    brand : String,
    
});

const user = computed(() => usePage().props.user);

</script>
<template>
     <div>
       
            <Head v-if="brand" :title="` | All ${props.brand} phones`"/>
            <Head v-else :title="` | ${$page.component}`"/>
    
          <Link v-if="user" :href="route('phones.create')" class="bg-sky-500 p-3 m-6 rounded-md text-white">Tambah data</Link>

          <p v-if="keyword" class="m-3 p-2">Menampilkan hasil untuk <b>{{ props.keyword }}</b></p>
          <div class="relative text-align-center text-red-500 font-bold flex justify-center" v-if="brand">
            <img :src="/image/+'brand/' + props.brand+'.jpg'" class="m-3 p-2 h-[400px] border-black border-2"/>
            <div class="absolute bottom-20 sm:left-20 lg:left-150 text-2xl" style="text-shadow: 1px 1px 2px black;">All {{ props.brand }} phones </div>
          </div>          
     
        <div class="flex flex-row flex-wrap justify-center">
           <div v-for="phone in props.phones.data" :key="phone.id">
            <div class="max-w-lg rounded overflow-hidden shadow-lg mx-6 p-3">
                <Link :href="route('phones.show', {'slug': phone.slug})">
                    <img :src="/image/ + phone.gambar" class="w-50% m-4" :alt="phone.nama"/>
                    
               
                
            <div class="m-3">
                <p class="text-base text-blue-700 decoration-none font-bold">{{phone.nama}}</p>
                
            </div>
                </Link> 
        
            </div>
          
            
        </div>
    </div>
    <p class="m-3 p-3 flex flex-row justify-center" v-if="props.phones.data.length == 0">Tidak ada data..</p>
    
       
    </div>
    <div class="m-3 p-3 flex flex-row justify-center">
        <Pagination class="mt-6" :links="props.phones.links" />
    </div>
     
</template>