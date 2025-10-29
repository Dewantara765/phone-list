<script setup>
import PhoneRow from './PhoneRow.vue'; 
import CameraRow from './CameraRow.vue';
const props = defineProps({
    phone1: {
        type: Object
    },
   phone2: {
    type: Object
   }
})


</script>

<template>
    <div>
         <div class="w-40 md:w-90 lg:w-110 xl:140 2xl:180 3xl:230 rounded overflow-hidden border-gray-600 border m-3 p-1">
                <h4 class="font-bold text-lg lg:text-xl text-red-500 text-center">{{ phone1.nama }}</h4>
                <div class="flex justify-center">
                    <img :src="/image/ + phone1.gambar" style="width:40%; margin:5px;"> 
                             
                 </div>
                 <ul class="border-t-1 border-l-1 border-r-1 border-gray-300">
                     <PhoneRow :entity="'Dimensi'" :data="phone1.dimensi" :height='"50px"'/>
                            <PhoneRow :entity="'Berat'" :data="phone1.berat" :height="'50px'"/>
                            <PhoneRow :entity="'Material'"  :data="phone1.material" :height='"120px"'/>
                            <PhoneRow  :entity="'Layar'"  :data="phone1.layar" :height='"140px"'/>
                            <PhoneRow  :entity="'OS'"  :data="phone1.os" :height="'75px'"/>
                            <PhoneRow :entity="'SoC'"  :data="phone1.soc" :height="'75px'"/>
                            <PhoneRow :entity="'RAM/Storage'"  :data="phone1.ramstorage" :height="'100px'"/>
                          <li class="border-gray-300 border-1 text-xs md:text-base h-[350px] md:h-[325px]"><span class="font-bold text-red-500 ml-5" >
                              Kamera Belakang :</span><br><span class="font-bold text-red-500 ml-5 text-xs md:text-base" style="color:red;">Kamera Utama :</span> {{phone1.kamerautama }}

                              <CameraRow :entity="'Kamera Ultrawide'"  :data="phone1.kameraultrawide"/>
                              <CameraRow :entity="'Kamera Telephoto'"  :data="phone1.kameratelephoto"/>
                              <CameraRow :entity="'Kamera Periscope'"  :data="phone1.kameraperiscope"/>
                              <CameraRow :entity="'Makro'"  :data="phone1.makro"/>
                              <CameraRow :entity="'Depth'"  :data="phone1.depth"/>
                
                            </li>
                         <PhoneRow :entity="'Video Belakang'"  :data="phone1.videobelakang" :height='"140px"'/>
                            <PhoneRow :entity="'Kamera Depan'"  :data="phone1.kameradepan" :height='"85px"'/>
                            <PhoneRow :entity="'Video Depan'"  :data="phone1.videodepan":height="'60px'"/>
                            <PhoneRow :entity="'Speaker'"  :data="phone1.speaker" :height="'90px'"/>
                            <PhoneRow :entity="'3.5mm jack'"  :data="phone1.audiojack"/>
                            <PhoneRow :entity="'Konektivitas'"  :data="phone1.konektivitas" :height="'75px'"/>
                            <PhoneRow :entity="'Sensor'"  :data="phone1.sensor" :height='"120px"'/>
                            <PhoneRow :entity="'Baterai'"  :data="`${phone1.baterai} mAh`"/>
                            <PhoneRow :entity="'Charging'"  :data="phone1.charging" :height='"90px"'/>
                            <PhoneRow :entity="'Harga'"  :data="phone1.harga" :height='"150px"'/>
                </ul>
                
            </div> 
        </div>
</template>