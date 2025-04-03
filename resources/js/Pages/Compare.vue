<script setup>
import { useForm } from '@inertiajs/vue3';

import axios from 'axios';
import { onMounted, reactive, ref } from 'vue';
import PhoneData from './Components/PhoneData.vue';


const phone1 = ref();
const data_results = ref([]);
const data_results2 = ref([]);
const props = defineProps({
    phone1: String,
    phone2: String,
    dataphone1: Object,
    dataphone2: Object,
    
})

const form = useForm({
    phone1: props.phone1,
    phone2: props.phone2,
})

function autoComplete(){

    if(form.phone1.length > 2){

        axios.get('/autocomplete/search',{params: {phone1: form.phone1}}).then(response => {
       
       
        data_results.value = response.data;

 });

}else{
    data_results.value = [];
}

}


function autoComplete2(){

if(form.phone2.length > 2 ){

    axios.get('/autocomplete/search',{params: {phone1: form.phone2}}).then(response => {
   
   
    data_results2.value = response.data;

});

}else{
data_results2.value = [];
}

}

const compare = () => {
    form.get(route("phones.compare"))
  
   
}

function setResult(result) {
    form.phone1 = result;
    compare()
    data_results.value = [];

}

function setResult2(result) {
    form.phone2 = result;
    compare()
    data_results2.value = [];

}








</script>


<template>
    <div class="w-full block m-3 p-3 cols-8 offset-8">
        <Head :title="` | ${$page.component}` "/>
        
        <div class="flex flex-row justify-center">
            <form>
                <h3 class="font-bold text-xl m-3">Bandingkan Smartphone</h3>
                <label for="phone1">Smartphone 1</label>
                <input type="text" name="phone1" id="phone1" class="block w-xl m-5" v-model="form.phone1" v-on:keyup="autoComplete">
                    <ul v-if="data_results.length" class="border-2 border-slate-50 overflow-auto  shadow-lg rounded list-none">
                        <li class="hover:bg-blue-100 hover:text-blue-800 w-full list-none text-left py-2 px-3 cursor-pointer" v-for="result in data_results" @click="setResult(result.nama)">{{ result.nama }}</li>
                    </ul>
                <label for="phone2">Smartphone 2</label>
                <input type="text" name="phone2" id="phone2" class="block w-xl m-5" v-model="form.phone2" v-on:keyup="autoComplete2">
                <ul v-if="data_results2.length" class="border-2 border-slate-50 overflow-auto  shadow-lg rounded list-none">
                        <li class="hover:bg-blue-100 hover:text-blue-800 w-full list-none text-left py-2 px-3 cursor-pointer" v-for="result2 in data_results2" @click="setResult2(result2.nama)">{{ result2.nama }}</li>
                    </ul>
                
            </form>
        </div>

    
        <Head :title="` | ${$page.component}`"/>
        <div class="flex flex-row justify-center">
            <p class="text-md font-semibold m-3" v-if="props.dataphone1.length == 0">Tidak ada data...</p>
           <PhoneData v-for="phone1 in props.dataphone1" :key="phone1.id" :phone1="phone1"/>
           
           
        <p class="text-md font-semibold m-3" v-if="props.dataphone2.length == 0">Tidak ada data...</p>
           <PhoneData v-for="phone2 in props.dataphone2" :key="phone2.id" :phone1="phone2"/>
           

           
          
        </div>
        
    </div>
    
</template>