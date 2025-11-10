<script setup>
import { useForm } from '@inertiajs/vue3';

import axios from 'axios';
import { onMounted, reactive, ref, provide } from 'vue';
import TableRow from './Components/TableRow.vue';
import TableCamera1 from './Components/TableCamera1.vue';
import TableCamera2 from './Components/TableCamera2.vue';


const phone1 = ref();
const data_results = ref([]);
const data_results2 = ref([]);
const props = defineProps({
    phone1: String,
    phone2: String,
    dataphone1: Object,
    dataphone2: Object,
    
})

const hp1 = props.dataphone1[0] || {};
const hp2 = props.dataphone2[0] || {};
const hp1Exists = Object.keys(hp1).length !== 0
const hp2Exists = Object.keys(hp2).length !== 0

const baterai1 = hp1?.baterai ? `${hp1.baterai} mAh` : '';
const baterai2 = hp2?.baterai ? `${hp2.baterai} mAh` : '';



const title = ref('')

const diff = ref(false);

onMounted(() => {
    if(hp1Exists && hp2Exists){
        title.value = `Compare ${hp1.nama} and ${hp2.nama}`
    } else if(hp1Exists){
        title.value = `Compare ${hp1.nama} and`
    } else if(hp2Exists){
        title.value = `Compare ${hp2.nama} and`
    }else {
        title.value = 'Compare'
    }
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
   let word1 = str1.split(" ");
   let word2 = str2.split(" ");

    return {
      str1: word1.map((word) => {
        return word2.includes(word) ? word : `<span class="text-blue-500">${word}</span>`;
      }).join(" "),
      str2: word2.map((word) => {
        return word1.includes(word) ? word : `<span class="text-green-500">${word}</span>`;
      }).join(" ")
    }
   }




</script>


<template>
    <div class="w-full block m-3 p-3">
        <Head :title="title"/>
        
        <div class="flex flex-col md:flex-row md:justify-center">
            <form>
                <h3 class="font-bold text-lg m-3">Bandingkan Smartphone</h3>
                <div class="flex flex-col">
                    <div class="flex flex-col">
                        <label for="phone1">Smartphone 1</label>
                        <input type="text" name="phone1" id="phone1" class="w-55 md:w-md lg:w-lg m-5" v-model="form.phone1" v-on:keyup="autoComplete">
                            <ul v-if="data_results.length" class="border-2 border-slate-50 overflow-auto  shadow-lg rounded list-none">
                                <li class="hover:bg-blue-100 hover:text-blue-800 w-full list-none text-left py-2 px-3 cursor-pointer" v-for="result in data_results" @click="setResult(result.nama)">{{ result.nama }}</li>
                            </ul>
                    </div>
                    <div class="flex flex-col">
                        <label for="phone2">Smartphone 2</label>
                        <input type="text" name="phone2" id="phone2" class="w-55 md:w-md lg:w-lg m-5" v-model="form.phone2" v-on:keyup="autoComplete2">
                        <ul v-if="data_results2.length" class="border-2 border-slate-50 overflow-auto  shadow-lg rounded list-none">
                            <li class="hover:bg-blue-100 hover:text-blue-800 w-full list-none text-left py-2 px-3 cursor-pointer" v-for="result2 in data_results2" @click="setResult2(result2.nama)">{{ result2.nama }}</li>
                        </ul>
                    </div>
                        
                </div>
                
            </form>
               
        </div>
         <div class="flex flex-col m-4">
            <p>Mode perbandingan</p>
            <div class="flex">
                <button class="p-2 rounded  text-white" 
                :class="!diff ? 'bg-rose-500' : 'bg-gray-500'" @click="diff = false">Full</button>
                <button class="p-2 rounded text-white" 
                :class="diff ? 'bg-rose-500' : 'bg-gray-500'" @click="diff = true">Difference</button>
            </div>
        </div>
     
        <table class="w-full md:w-5/6 lg:w-2/3 border border-gray-400 table-fixed mx-auto" v-if="hp1Exists || hp2Exists">
            <thead>
                <tr>
                    <th class="right-border bold-phone-name w-1/2" v-if="hp1">{{ hp1.nama }}</th>
                    <th class="bold-phone-name w-1/2" v-if="hp2">{{ hp2.nama }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <tr class="border-b-2 border-gray-400">
                    <td class="right-border w-1/2">
                        <img v-if="hp1Exists" :src="/image/ + hp1.gambar" :alt="hp1.nama" class="w-2/3 md:w-1/4 my-2 mx-auto"/>
                    </td>
                    <td class="w-1/2">
                        <img v-if="hp2Exists" :src="/image/ + hp2.gambar" :alt="hp2.nama" class="w-2/3 md:w-1/4 my-2 mx-auto"/>
                    </td>
                </tr>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.dimensi" :value2="hp2.dimensi" entity="Dimensi" :diff="diff"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.berat" :value2="hp2.berat" entity="Berat" :diff="diff"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.material" :value2="hp2.material" entity="Material" :diff="diff"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.layar" :value2="hp2.layar" entity="Layar" :diff="diff"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.os" :value2="hp2.os" entity="OS" :diff="diff"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.soc" :value2="hp2.soc" entity="SoC" :diff="diff"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.ramstorage" :value2="hp2.ramstorage" entity="RAM/Storage" :diff="diff"/>
                <tr class="border-b-2 border-gray-400 align-top text-xs md:text-base">
                    <td v-if="hp1" class="right-border w-1/2 break-words whitespace-normal p-2 ">
                        <div class="bold-entity-name">Kamera Belakang :</div>
                        <div class="bold-entity-name">Kamera Utama : </div>
                        <span v-if="!diff" class="entity-value">{{ hp1.kamerautama}}</span>
                        <span v-if="diff" v-html="highlightDiff(hp1.kamerautama, hp2.kamerautama).str1" class="entity-value"></span><br>
                        <!-- ultrawide-->
                        <TableCamera1 :value="hp1.kameraultrawide" name="Kamera Ultrawide" :diff="diff" :value2="hp2.kameraultrawide"
                        />
                        <!-- telephoto-->
                        <TableCamera1 :value="hp1.kameratelephoto" name="Kamera Telephoto" :diff="diff" :value2="hp2.kameratelephoto"
                        />
                        <!-- periscope-->
                        <TableCamera1 :value="hp1.kameraperiscope" name="Kamera Periscope" :diff="diff" :value2="hp2.kameraperiscope"
                        />
                        <!-- makro-->
                        <TableCamera1 :value="hp1.makro" name="Makro" :diff="diff" :value2="hp2.makro"
                        />
                         <!-- depth-->
                        <TableCamera1 :value="hp1.depth" name="Depth" :diff="diff" :value2="hp2.depth"
                        />
                    </td>
                    <td v-if="hp2" class="w-1/2 break-words whitespace-normal p-2">
                        <div class="bold-entity-name">Kamera Belakang :</div>
                        <div class="bold-entity-name">Kamera Utama : </div>
                        <span v-if="!diff" class="entity-value">{{ hp2.kamerautama}}</span>
                        <span v-if="diff" v-html="highlightDiff(hp1.kamerautama, hp2.kamerautama).str2" class="entity-value"></span><br>

                        <!-- ultrawide-->
                        <TableCamera2 :value="hp2.kameraultrawide" :value2="hp1.kameraultrawide" :diff="diff" name="Kamera Ultrawide"/>
                        <!-- telephoto-->
                        <TableCamera2 :value="hp2.kameratelephoto" :value2="hp1.kameratelephoto" :diff="diff" name="Kamera Telephoto"/>
                        <!-- periscope-->
                        <TableCamera2 :value="hp2.kameraperiscope" :value2="hp1.kameraperiscope" :diff="diff" name="Kamera Periscope"/>
                        <!-- makro-->
                        <TableCamera2 :value="hp2.makro" :value2="hp1.makro" :diff="diff" name="Makro"/>
                         <!-- depth-->
                        <TableCamera2 :value="hp2.depth" :value2="hp1.depth" :diff="diff" name="Depth"/>
                    </td>
                </tr>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.videobelakang" :value2="hp2.videobelakang" entity="Video Belakang" :diff="diff"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.kameradepan" :value2="hp2.kameradepan" entity="Kamera Depan" :diff="diff"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.videodepan" :value2="hp2.videodepan" entity="Video Depan" :diff="diff"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.speaker" :value2="hp2.speaker" entity="Speaker" :diff="diff"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.audiojack" :value2="hp2.audiojack" entity="3.5mm jack" :diff="diff"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.konektivitas" :value2="hp2.konektivitas" entity="Konektivitas" :diff="diff"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.sensor" :value2="hp2.sensor" entity="Sensor" :diff="diff"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="baterai1" :value2="baterai2" entity="Baterai" :diff="diff"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.charging" :value2="hp2.charging" entity="Charging" :diff="diff"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.harga" :value2="hp2.harga" entity="Harga" :diff="diff"/>


            </tbody>

        </table>
        <div v-if="Object.keys(hp1).length === 0 && Object.keys(hp2).length === 0"
        class="flex justify-center items-center">Tidak ada data...</div>

    </div>
    
</template>