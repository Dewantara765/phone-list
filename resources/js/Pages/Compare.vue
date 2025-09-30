<script setup>
import { useForm } from '@inertiajs/vue3';

import axios from 'axios';
import { onMounted, reactive, ref, provide } from 'vue';
import PhoneData from './Components/PhoneData.vue';

import DiffCamera from './Components/Compare/DiffCamera.vue';
import DiffRow from './Components/Compare/DiffRow.vue';


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

function highlightDiff(str1, str2) {
    let maxLen = Math.max(str1.length, str2.length);
      let res1 = "", res2 = "";

      for (let i = 0; i < maxLen; i++) {
        if (str1[i] !== str2[i]) {
          res1 += str1[i] ? `<span class="text-red-500 font-bold">${str1[i]}</span>` : "";
          res2 += str2[i] ? `<span class="text-green-500 font-bold">${str2[i]}</span>` : "";
        } else {
          res1 += str1[i] || "";
          res2 += str2[i] || "";
        }
      }

     return { str1: res1, str2: res2 };
}


</script>


<template>
    <div class="w-full block m-3 p-3 cols-8 offset-8">
        <Head :title="` | ${$page.component}` "/>
        
        <div class="flex flex-col  md:flex-row justify-center">
            <form>
                <h3 class="font-bold text-xl m-3">Bandingkan Smartphone</h3>
                <label for="phone1">Smartphone 1</label>
                <input type="text" name="phone1" id="phone1" class="block w-2xs lg:w-lg m-5" v-model="form.phone1" v-on:keyup="autoComplete">
                    <ul v-if="data_results.length" class="border-2 border-slate-50 overflow-auto  shadow-lg rounded list-none">
                        <li class="hover:bg-blue-100 hover:text-blue-800 w-full list-none text-left py-2 px-3 cursor-pointer" v-for="result in data_results" @click="setResult(result.nama)">{{ result.nama }}</li>
                    </ul>
                <label for="phone2">Smartphone 2</label>
                <input type="text" name="phone2" id="phone2" class="block w-2xs lg:w-lg m-5" v-model="form.phone2" v-on:keyup="autoComplete2">
                <ul v-if="data_results2.length" class="border-2 border-slate-50 overflow-auto  shadow-lg rounded list-none">
                        <li class="hover:bg-blue-100 hover:text-blue-800 w-full list-none text-left py-2 px-3 cursor-pointer" v-for="result2 in data_results2" @click="setResult2(result2.nama)">{{ result2.nama }}</li>
                    </ul>
                
            </form>
        </div>

     <Head :title="` | ${$page.component}`"/>
        <div class="flex justify-center">
         
            <p class="text-md font-semibold m-3" v-if="props.dataphone1.length == 0">Tidak ada data...</p> -->
           <PhoneData v-for="phone1 in props.dataphone1" :key="phone1.id" :phone1="phone1"/>
           
           
        <p class="text-md font-semibold m-3" v-if="props.dataphone2.length == 0">Tidak ada data...</p>
           <PhoneData v-for="phone2 in props.dataphone2" :key="phone2.id" :phone1="phone2"/>
           
   

           
          
        </div>

        
     
        
        <div v-if="props.dataphone1[0] && props.dataphone2[0]" class="mt-5">
            <DiffRow :label="'Dimensi'" :data1="props.dataphone1[0].dimensi" :data2="props.dataphone2[0].dimensi" 
            :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"/>

            <DiffRow :label="'Berat'" :data1="props.dataphone1[0].berat" :data2="props.dataphone2[0].berat" 
            :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"/>

            <DiffRow :label="'Material'" :data1="props.dataphone1[0].material" :data2="props.dataphone2[0].material" 
            :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"/>

            <DiffRow :label="'Layar'" :data1="props.dataphone1[0].layar" :data2="props.dataphone2[0].layar" 
            :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"/>

           <DiffRow :label="'OS'" :data1="props.dataphone1[0].os" :data2="props.dataphone2[0].os" 
            :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"/>

           <DiffRow :label="'SoC'" :data1="props.dataphone1[0].soc" :data2="props.dataphone2[0].soc" 
            :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"/>

            <DiffRow :label="'RAM/Storage'" :data1="props.dataphone1[0].ramstorage" :data2="props.dataphone2[0].ramstorage" 
            :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"/>

           <DiffRow :label="'Kamera Utama'" :data1="props.dataphone1[0].kamerautama" :data2="props.dataphone2[0].kamerautama" 
            :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"/>

            <DiffRow :label="'Kamera Depan'" :data1="props.dataphone1[0].kameradepan" :data2="props.dataphone2[0].kameradepan" 
            :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"/>

            <div>
                <DiffCamera :kondisi1="props.dataphone1[0].kameraultrawide && props.dataphone2[0].kameraultrawide" 
                :kondisi2="props.dataphone1[0].kameraultrawide && !props.dataphone2[0].kameraultrawide"
                :kondisi3="!props.dataphone1[0].kameraultrawide && props.dataphone2[0].kameraultrawide" 
                :kondisi4="!props.dataphone1[0].kameraultrawide && !props.dataphone2[0].kameraultrawide"
                :label="'Kamera Ultrawide'" :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"
                :data1="props.dataphone1[0].kameraultrawide" :data2="props.dataphone2[0].kameraultrawide"
                :description="'lensa ultrawide'"/>
                
            </div>
            <div>
                <DiffCamera :kondisi1="props.dataphone1[0].kameratelephoto && props.dataphone2[0].kameratelephoto" 
                :kondisi2="props.dataphone1[0].kameratelephoto && !props.dataphone2[0].kameratelephoto"
                :kondisi3="!props.dataphone1[0].kameratelephoto && props.dataphone2[0].kameratelephoto" 
                :kondisi4="!props.dataphone1[0].kameratelephoto && !props.dataphone2[0].kameratelephoto"
                :label="'Kamera Telephoto'" :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"
                :data1="props.dataphone1[0].kameratelephoto" :data2="props.dataphone2[0].kameratelephoto"
                :description="'lensa telephoto standar'"/>
            </div>

            <div>
                <DiffCamera :kondisi1="props.dataphone1[0].kameraperiscope && props.dataphone2[0].kameraperiscope" 
                :kondisi2="props.dataphone1[0].kameraperiscope && !props.dataphone2[0].kameraperiscope"
                :kondisi3="!props.dataphone1[0].kameraperiscope && props.dataphone2[0].kameraperiscope" 
                :kondisi4="!props.dataphone1[0].kameraperiscope && !props.dataphone2[0].kameraperiscope"
                :label="'Kamera Periscope'" :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"
                :data1="props.dataphone1[0].kameraperiscope" :data2="props.dataphone2[0].kameraperiscope"
                :description="'lensa periscope telephoto'"/>
            </div>
            <div>
                <DiffCamera :kondisi1="props.dataphone1[0].makro && props.dataphone2[0].makro" 
                :kondisi2="props.dataphone1[0].makro && !props.dataphone2[0].makro"
                :kondisi3="!props.dataphone1[0].makro && props.dataphone2[0].makro" 
                :kondisi4="!props.dataphone1[0].makro && !props.dataphone2[0].makro"
                :label="'Makro'" :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"
                :data1="props.dataphone1[0].makro" :data2="props.dataphone2[0].makro"
                :description="'makro'"/>
            </div>
            <div>
                 <DiffCamera :kondisi1="props.dataphone1[0].depth && props.dataphone2[0].depth" 
                :kondisi2="props.dataphone1[0].depth && !props.dataphone2[0].depth"
                :kondisi3="!props.dataphone1[0].depth && props.dataphone2[0].depth" 
                :kondisi4="!props.dataphone1[0].depth && !props.dataphone2[0].depth"
                :label="'Depth'" :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"
                :data1="props.dataphone1[0].depth" :data2="props.dataphone2[0].depth"
                :description="'depth'"/>
            </div>
            <DiffRow :label="'Video Belakang'" :data1="props.dataphone1[0].videobelakang" :data2="props.dataphone2[0].videobelakang" 
            :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"/>

            <DiffRow :label="'Video Depan'" :data1="props.dataphone1[0].videodepan" :data2="props.dataphone2[0].videodepan" 
            :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"/>

            <DiffRow :label="'Speaker'" :data1="props.dataphone1[0].speaker" :data2="props.dataphone2[0].speaker" 
            :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"/>

           <DiffRow :label="'3.5mm jack'" :data1="props.dataphone1[0].audiojack" :data2="props.dataphone2[0].audiojack" 
            :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"/>

            <DiffRow :label="'Konektivitas'" :data1="props.dataphone1[0].konektivitas" :data2="props.dataphone2[0].konektivitas" 
            :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"/>

            <DiffRow :label="'Sensor'" :data1="props.dataphone1[0].sensor" :data2="props.dataphone2[0].sensor" 
            :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"/>

            <DiffRow :label="'Baterai'" :data1="props.dataphone1[0].baterai" :data2="props.dataphone2[0].baterai" 
            :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"/>

            <DiffRow :label="'Charging'" :data1="props.dataphone1[0].charging" :data2="props.dataphone2[0].charging" 
            :nama1="props.dataphone1[0].nama" :nama2="props.dataphone2[0].nama"/>

        </div>
        <div v-if="props.dataphone1[0] && !props.dataphone2[0]">
            
        </div>
        <div v-if="props.dataphone2[0] && !props.dataphone1[0]">
            
        </div>
        <div v-else></div>
    </div>
    
</template>