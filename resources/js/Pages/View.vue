<script setup>
import { useForm, usePage} from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    phone : Object,
    
});

const url = props.phone.nama
const awal = "/compare?phone1="
const urlBaru = awal.concat(url)

const form = useForm();
const deletePhone = (id) => {
    if (confirm("Are you sure you want to move this to trash")) {
	   form.delete(route('phones.destroy',{id: id}), {
		  preserveScroll: true,
	   });
    }
};

const user = computed(() => usePage().props.user);

</script>
<template>
    <div class="w-2xl rounded overflow-hidden border-gray-600 border m-6 p-1">
        <Head :title="`| ${props.phone.nama}  Detail`"/>
                        <h4 class="font-bold text-2xl text-red-500 text-center">{{ props.phone.nama }}</h4>
                        <div class="flex justify-center">
                            <img :src="/image/ + props.phone.gambar" style="width:20%; margin:5px;"> 
                             
                        </div>
                        <ul class="border-t-1 border-l-1 border-r-1 border-gray-300">
                          <li class="border-gray-300 border-1" style="height: 50px;"><span class="font-bold text-red-500 ml-5">Dimensi :</span> {{phone.dimensi }}</li>
                          <li class="border-gray-300 border-1"><span class="font-bold text-red-500 ml-5">Berat :</span> {{props.phone.berat }}</li>
                          <li class="border-gray-300 border-1" style="height:60px;"><span class="font-bold text-red-500 ml-5">Material :</span>
                         
                              {{ props.phone.material }}
                       </li>
                          <li class="border-gray-300 border-1" style="height:100px;"><span class="font-bold text-red-500 ml-5">Layar :</span> {{props.phone.layar }}</li>
                          <li class="border-gray-300 border-1"><span class="font-bold text-red-500 ml-5" >OS :</span> {{props.phone.os }}</li>
                          <li class="border-gray-300 border-1"><span class="font-bold text-red-500 ml-5" >SoC :</span> {{props.phone.soc }}</li>
                          <li class="border-gray-300 border-1"><span class="font-bold text-red-500 ml-5" >RAM/Storage :</span> {{props.phone.ramstorage }}</li>
                          <li class="border-gray-300 border-1"><span class="font-bold text-red-500 ml-5" >Kamera Belakang :</span><br><span class="font-bold text-red-500 ml-5" style="color:red;">Kamera Utama :</span> {{props.phone.kamerautama }}
                
                              <br v-show="props.phone.kameraultrawide"><span class="font-bold text-red-500 ml-5" v-show="props.phone.kameraultrawide">Kamera Ultrawide :</span> {{props.phone.kameraultrawide}}
                            
                            
                              <br v-show="props.phone.kameratelephoto"><span class="font-bold text-red-500 ml-5" v-show="props.phone.kameratelephoto">Kamera Telephoto :</span> {{props.phone.kameratelephoto}}

          
                    
                              <br v-show="props.phone.kameraperiscope"><span class="font-bold text-red-500 ml-5" v-show="props.phone.kameraperiscope">Kamera Periscope :</span> {{props.phone.kameraperiscope}}
                       

                             
                              <br v-show="props.phone.makro"><span class="font-bold text-red-500 ml-5" v-show="props.phone.makro">Makro :</span> {{props.phone.makro}}
                           

                           
                              <br v-show="props.phone.depth"><span class="font-bold text-red-500 ml-5" v-show="props.phone.depth">Depth :</span> {{props.phone.depth}}
                           
              
                          </li>
                          <li class="border-gray-300 border-1" style="height:75px;"><span class="font-bold text-red-500 ml-5">Video Belakang :</span> {{props.phone.videobelakang}}</li>
                          <li class="border-gray-300 border-1" style="height:75px;"><span class="font-bold text-red-500 ml-5">Kamera Depan :</span> {{props.phone.kameradepan }}</li>
                          <li class="border-gray-300 border-1"><span class="font-bold text-red-500 ml-5">Video Depan :</span> {{props.phone.videodepan }}</li>
                          <li class="border-gray-300 border-1"><span class="font-bold text-red-500 ml-5">Speaker :</span> {{ props.phone.speaker  }} </li>
                          <li class="border-gray-300 border-1"><span class="font-bold text-red-500 ml-5">3.5mm jack :</span> {{ props.phone.audiojack  }}</li>
                          <li class="border-gray-300 border-1"><span class="font-bold text-red-500 ml-5">Konektivitas :</span> {{ props.phone.konektivitas  }}</li>
                          <li class="border-gray-300 border-1"style="height:70px;"><span class="font-bold text-red-500 ml-5">Sensor :</span> {{ props.phone.sensor  }}</li>
                          <li class="border-gray-300 border-1"><span class="font-bold text-red-500 ml-5">Baterai :</span> {{ props.phone.baterai  }} mAh </li>
                          <li class="border-gray-300 border-1" style="height:70px;"><span class="font-bold text-red-500 ml-5">Charging :</span> {{ props.phone.charging  }}</li>
                          <li class="border-gray-300 border-1" style="height:150px; white-space: pre-line;"><span class="font-bold text-red-500 ml-5">Harga :</span><br>
                      {{ props.phone.harga }}
                          
                        </li>
                        </ul>
                        
      </div>
      <div class="w-md rounded overflow-hidden border m-6 p-1">
        <div class="flex flex-row justify-start">
                    
            <Link v-if="user" :href="route('phones.edit', {'id': phone.id})" class="m-3 bg-yellow-500 p-3 rounded">Ubah</Link>
            <Link :href="route('phones.compare', {'phone1': props.phone.nama, 'phone2': ''})" class="m-3 bg-green-500 p-3 rounded text-white">Bandingkan</Link>
            <button v-if="user" class="m-3 bg-red-500 p-3 rounded text-white" @click="deletePhone(phone.id)">Hapus</button>        
                   
        </div>
    </div>
</template>