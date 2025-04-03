<script setup>
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
         <div class="w-80 md:w-90 lg:w-110 xl:140 2xl:180 3xl:230 rounded overflow-hidden border-gray-600 border m-6 p-1">
                <h4 class="font-bold text-xl lg:text-2xl text-red-500 text-center">{{ phone1.nama }}</h4>
                <div class="flex justify-center">
                    <img :src="/image/ + phone1.gambar" style="width:25%; margin:5px;"> 
                             
                 </div>
                 <ul class="border-t-1 border-l-1 border-r-1 border-gray-300">
                    <li class="border-gray-300 border-1 h-[75px] md:h-[70px]"><span class="font-bold text-red-500 ml-5">Dimensi :</span> {{phone1.dimensi }}</li>
                    <li class="border-gray-300 border-1"><span class="font-bold text-red-500 ml-5">Berat :</span> {{phone1.berat }}</li>
                          <li class="border-gray-300 border-1 h-[100px] md:h-[95px]"><span class="font-bold text-red-500 ml-5">Material :</span>
                         
                              {{ phone1.material }}
                       </li>
                       <li class="border-gray-300 border-1 h-[150px] md:h-[125px]"><span class="font-bold text-red-500 ml-5">Layar :</span> {{phone1.layar }}</li>
                          <li class="border-gray-300 border-1 h-[50px]"><span class="font-bold text-red-500 ml-5" >OS :</span> {{phone1.os }}</li>
                          <li class="border-gray-300 border-1 h-[50px]"><span class="font-bold text-red-500 ml-5" >SoC :</span> {{phone1.soc }}</li>
                          <li class="border-gray-300 border-1 h-[75px]"><span class="font-bold text-red-500 ml-5" >RAM/Storage :</span> {{phone1.ramstorage }}</li>
                          <li class="border-gray-300 border-1 h-[320px] md:h-[300px] lg:h-[260px]"><span class="font-bold text-red-500 ml-5" >Kamera Belakang :</span><br><span class="font-bold text-red-500 ml-5" style="color:red;">Kamera Utama :</span> {{phone1.kamerautama }}
                            <br v-show="phone1.kameraultrawide"><span class="font-bold text-red-500 ml-5" v-show="phone1.kameraultrawide">Kamera Ultrawide :</span> {{phone1.kameraultrawide}}
                            
                            
                            <br v-show="phone1.kameratelephoto"><span class="font-bold text-red-500 ml-5" v-show="phone1.kameratelephoto">Kamera Telephoto :</span> {{phone1.kameratelephoto}}

        
                  
                            <br v-show="phone1.kameraperiscope"><span class="font-bold text-red-500 ml-5" v-show="phone1.kameraperiscope">Kamera Periscope :</span> {{phone1.kameraperiscope}}
                     

                           
                            <br v-show="phone1.makro"><span class="font-bold text-red-500 ml-5" v-show="phone1.makro">Makro :</span> {{phone1.makro}}
                         

                         
                            <br v-show="phone1.depth"><span class="font-bold text-red-500 ml-5" v-show="phone1.depth">Depth :</span> {{phone1.depth}}
                        </li>
                        <li class="border-gray-300 border-1 h-[125px]"><span class="font-bold text-red-500 ml-5">Video Belakang :</span> {{phone1.videobelakang}}</li>
                          <li class="border-gray-300 border-1" style="height:75px;"><span class="font-bold text-red-500 ml-5">Kamera Depan :</span> {{phone1.kameradepan }}</li>
                          <li class="border-gray-300 border-1 h-[75px]"><span class="font-bold text-red-500 ml-5">Video Depan :</span> {{phone1.videodepan }}</li>
                          <li class="border-gray-300 border-1 h-[50px]"><span class="font-bold text-red-500 ml-5">Speaker :</span> {{ phone1.speaker  }} </li>
                          <li class="border-gray-300 border-1"><span class="font-bold text-red-500 ml-5">3.5mm jack :</span> {{ phone1.audiojack  }}</li>
                          <li class="border-gray-300 border-1"><span class="font-bold text-red-500 ml-5">Konektivitas :</span> {{ phone1.konektivitas  }}</li>
                          <li class="border-gray-300 border-1 h-[150px] md:h-[125px]"><span class="font-bold text-red-500 ml-5">Sensor :</span> {{ phone1.sensor  }}</li>
                          <li class="border-gray-300 border-1"><span class="font-bold text-red-500 ml-5">Baterai :</span> {{ phone1.baterai  }} mAh</li>
                          <li class="border-gray-300 border-1" style="height:70px;"><span class="font-bold text-red-500 ml-5">Charging :</span> {{ phone1.charging  }}</li>
                          <li class="border-gray-300 border-1" style="height:150px;"><span class="font-bold text-red-500 ml-5">Harga :</span><br>
                      {{ phone1.harga }}
                          
                        </li>
                        
                </ul>
                
            </div> 
        </div>
</template>