<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import axios from 'axios';
import { useForm, usePage} from '@inertiajs/vue3';
import { computed } from 'vue';
import Like from './Components/Like.vue';
import PhoneRow2 from './Components/PhoneRow2.vue';
import CameraRow2 from './Components/CameraRow2.vue';
import CommentForm from './Components/Comment/CommentForm.vue';
import CommentList from './Components/Comment/CommentList.vue';
import Brand from './Brand.vue';
import { onMounted, onUnmounted } from 'vue';
import { provide } from 'vue';

const props = defineProps({
    phone : Object,
    comments : Object,
    phoneId: Number,
    likedByUser: Boolean,
    likeCountInitial: Number,
    authUser: Object || null,
    nama: String,
});

const title = computed(() => usePage().props.nama);

const isAuth  = computed(() => usePage().props.auth);

const liked = ref(props.likedByUser)
const likeCount = ref(props.likeCountInitial)

const url = props.phone.nama
const awal = "/compare?phone1="
const urlBaru = awal.concat(url)

const form = useForm({});
const form2 = useForm({ body: '' })

provide('sharedUseAuth', props.authUser);

const deletePhone = (id) => {
    if (confirm("Are you sure you want to move this to trash")) {
	   form.delete(route('phones.destroy',{id: id}), {
		  preserveScroll: true,
	   });
    }
};

const user = computed(() => usePage().props.user);

const toggleLike = async () => {
   if (!props.authUser) {
    alert('Please log in to like this post.')
    return
  }

  try {
    const res = await axios.post(`/phones/${props.phoneId}/like`,
      {}, {withCredentials: true}
    )
    liked.value = res.data.liked
    likeCount.value = res.data.like_count
  } catch (err) {
    if (err.response?.status === 401) {
      alert('Please log in first!')
    }
    else if (err.response?.status === 403) {
      alert('verifikasi email anda terlebih dahulu!')
    }
     else {
      console.error(err)
    }
  }
}

function submitComment() {
  form2.post(route('phones.comments.store', props.phoneId), {
    onSuccess: () => form2.reset('body'),
    preserveScroll: true,
  })
}



function goTo(url) {
  if (url) {
    router.get(url, {}, { preserveScroll: true, preserveState: true })
  }
}

</script>
<template>
   
<div class="flex flex-col lg:flex-row gap-x-4">
  <Head :title="` | ${$props.phone.nama}`"/>
      <div class="md:w-xl lg:w-2xl rounded overflow-hidden border-gray-600 border mb-6 p-2">
         
                          <h4 class="font-bold text-2xl text-red-500 text-center">{{ props.phone.nama }}</h4>
                          <div class="flex justify-center">
                              <img :src="/image/ + props.phone.gambar" class="w-1/3 md:w-1/5 lg:w-1/2 xl:w-1/5"> 
                              
                          </div>
                          <Like  @toggle-like="toggleLike" :liked="liked" :like-count="likeCount" />
                           
                            <div class="flex flex-row justify-start">
                                        
                                <Link v-if="user?.role == 'admin'" :href="route('phones.edit', {'id': phone.id})" class="text-sm md:text-base m-3 bg-yellow-500 p-3 rounded">Ubah</Link>
                                <Link :href="route('phones.compare', {'phone1': props.phone.nama, 'phone2': ''})" class="text-sm md:text-base m-3 bg-green-500 p-3 rounded text-white">Bandingkan</Link>
                                <button v-if="user?.role == 'admin'" class="text-sm md:text-base m-3 bg-red-500 p-3 rounded text-white" @click="deletePhone(phone.id)">Hapus</button>        
                                      
                            </div>
                       
                          
                          <ul class="border-t-1 border-l-1 border-r-1 border-gray-300">
                            <PhoneRow2 :entity="'Dimensi'" :data="props.phone.dimensi" :height='"50px"'/>
                            <PhoneRow2 :entity="'Berat'" :data="props.phone.berat"/>
                            <PhoneRow2 :entity="'Material'"  :data="props.phone.material" :height='"100px"'/>
                            <PhoneRow2  :entity="'Layar'"  :data="props.phone.layar" :height='"120px"'/>
                            <PhoneRow2  :entity="'OS'"  :data="props.phone.os"/>
                            <PhoneRow2 :entity="'SoC'"  :data="props.phone.soc"/>
                            <PhoneRow2 :entity="'RAM/Storage'"  :data="props.phone.ramstorage"/>
                            
                          
                          
                          
                            <li class="border-gray-300 border-1 text-sm md:text-base"><span class="font-bold text-red-500 ml-5" >
                              Kamera Belakang :</span><br><span class="font-bold text-red-500 ml-5 text-sm md:text-base" style="color:red;">Kamera Utama :</span> {{props.phone.kamerautama }}

                              <CameraRow2 :entity="'Kamera Ultrawide'"  :data="props.phone.kameraultrawide"/>
                              <CameraRow2 :entity="'Kamera Telephoto'"  :data="props.phone.kameratelephoto"/>
                              <CameraRow2 :entity="'Kamera Periscope'"  :data="props.phone.kameraperiscope"/>
                              <CameraRow2 :entity="'Makro'"  :data="props.phone.makro"/>
                              <CameraRow2 :entity="'Depth'"  :data="props.phone.depth"/>
                
                            </li>
                            <PhoneRow2 :entity="'Video Belakang'"  :data="props.phone.videobelakang" :height='"100px"'/>
                            <PhoneRow2 :entity="'Kamera Depan'"  :data="props.phone.kameradepan" :height='"75px"'/>
                            <PhoneRow2 :entity="'Video Depan'"  :data="props.phone.videodepan"/>
                            <PhoneRow2 :entity="'Speaker'"  :data="props.phone.speaker"/>
                            <PhoneRow2 :entity="'3.5mm jack'"  :data="props.phone.audiojack"/>
                            <PhoneRow2 :entity="'Konektivitas'"  :data="props.phone.konektivitas"/>
                            <PhoneRow2 :entity="'Sensor'"  :data="props.phone.sensor" :height='"70px"'/>
                            <PhoneRow2 :entity="'Baterai'"  :data="`${props.phone.baterai} mAh`"/>
                            <PhoneRow2 :entity="'Charging'"  :data="props.phone.charging" :height='"70px"'/>
                            <PhoneRow2 :entity="'Harga'"  :data="props.phone.harga" :height='"150px"'/>
                        
                          </ul>

                          
                        
                         
                      
                    
              
        </div>
        <div class="flex flex-col space-y-">
        
          <div class="md:w-xl lg:w-2xl rounded overflow-hidden border-gray-600 border p-2">
     
       
            <p class="font-bold text-xl md:text-2xl text-red-500">Komentar</p>
            <div v-if="authUser">
              <CommentForm :phone-id="phoneId"/>                     
            </div>
            
              <div v-else>Login untuk menulis komentar</div> 
            <CommentList :comments="props.comments"/>
 
          </div>
          <Brand></Brand>
        </div>  
      
    </div>
   
      

  
    
    
   
</template>