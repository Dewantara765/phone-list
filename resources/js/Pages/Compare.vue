<script setup>
import { useForm } from '@inertiajs/vue3';

import axios from 'axios';
import { onMounted, reactive, ref, provide } from 'vue';
import TableRow from './Components/TableRow.vue';
import TableCamera from './Components/TableCamera.vue';


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
    <div class="w-full block m-3 p-3">
        <Head :title="`${$page.component}` "/>
        
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

        <table class="w-full border border-gray-400 table-fixed" v-if="hp1Exists || hp2Exists">
            <thead>
                <tr>
                    <th class="right-border bold-phone-name w-1/2" v-if="hp1">{{ hp1.nama }}</th>
                    <th class="bold-phone-name w-1/2" v-if="hp2">{{ hp2.nama }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <tr class="border-b-2 border-gray-400">
                    <td class="right-border w-1/2">
                        <img v-if="hp1Exists" :src="/image/ + hp1.gambar" :alt="hp1.nama" class="w-[100px] md:w-1/4 my-2 mx-auto"/>
                    </td>
                    <td class="w-1/2">
                        <img v-if="hp2Exists" :src="/image/ + hp2.gambar" :alt="hp2.nama" class="w-[100px] md:w-1/4 my-2 mx-auto"/>
                    </td>
                </tr>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.dimensi" :value2="hp2.dimensi" entity="Dimensi"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.berat" :value2="hp2.berat" entity="Berat"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.material" :value2="hp2.material" entity="Material"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.layar" :value2="hp2.layar" entity="Layar"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.os" :value2="hp2.os" entity="OS"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.soc" :value2="hp2.soc" entity="SoC"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.ramstorage" :value2="hp2.ramstorage" entity="RAM/Storage"/>
                <tr class="border-b-2 border-gray-400 align-top text-xs md:text-base">
                    <td v-if="hp1" class="right-border w-1/2 break-words whitespace-normal p-2 ">
                        <span class="bold-phone-name">Kamera Belakang :</span><br>
                        <span class="bold-phone-name">Kamera Utama : </span>{{ hp1.kamerautama}}<br>
                        <TableCamera :value="hp1.kameraultrawide" name="Kamera Ultrawide"/>
                        <TableCamera :value="hp1.kameratelephoto" name="Kamera Telephoto"/>
                        <TableCamera :value="hp1.kameraperiscope" name="Kamera Periscope"/>
                        <TableCamera :value="hp1.makro" name="Makro"/>
                        <TableCamera :value="hp1.depth" name="Depth"/>
                    </td>
                    <td v-if="hp2" class="w-1/2 break-words whitespace-normal p-2">
                        <span class="bold-phone-name">Kamera Belakang :</span><br>
                        <span class="bold-phone-name">Kamera Utama : </span>{{ hp2.kamerautama}}<br>
                        <TableCamera :value="hp2.kameraultrawide" name="Kamera Ultrawide"/>
                        <TableCamera :value="hp2.kameratelephoto" name="Kamera Telephoto"/>
                        <TableCamera :value="hp2.kameraperiscope" name="Kamera Periscope"/>
                        <TableCamera :value="hp2.makro" name="Makro"/>
                        <TableCamera :value="hp2.depth" name="Depth"/>
                    </td>
                </tr>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.videobelakang" :value2="hp2.videobelakang" entity="Video Belakang"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.kameradepan" :value2="hp2.kameradepan" entity="Kamera Depan"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.videodepan" :value2="hp2.videodepan" entity="Video Depan"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.speaker" :value2="hp2.speaker" entity="Speaker"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.audiojack" :value2="hp2.audiojack" entity="3.5mm jack"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.konektivitas" :value2="hp2.konektivitas" entity="Konektivitas"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.sensor" :value2="hp2.sensor" entity="Sensor"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="baterai1" :value2="baterai2" entity="Baterai"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.charging" :value2="hp2.charging" entity="Charging"/>
                <TableRow :hp1="hp1" hp2="hp2" :value1="hp1.harga" :value2="hp2.harga" entity="Harga"/>


            </tbody>

        </table>
        <div v-if="Object.keys(hp1).length === 0 && Object.keys(hp2).length === 0">Tidak ada data...</div>

    </div>
    
</template>