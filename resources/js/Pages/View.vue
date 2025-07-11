<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useForm, usePage} from '@inertiajs/vue3';
import { computed } from 'vue';
import Like from './Components/Like.vue';
import PhoneRow from './Components/PhoneRow.vue';
import CameraRow from './Components/CameraRow.vue';
import Brand from './Brand.vue';

const props = defineProps({
    phone : Object,
    comments : Object,
    phoneId: Number,
    likedByUser: Boolean,
    likeCountInitial: Number,
    authUser: Object || null,
});

const liked = ref(props.likedByUser)
const likeCount = ref(props.likeCountInitial)

const url = props.phone.nama
const awal = "/compare?phone1="
const urlBaru = awal.concat(url)

const form = useForm();
const form2 = useForm({body: ''});
const deletePhone = (id) => {
    if (confirm("Are you sure you want to move this to trash")) {
	   form.delete(route('phones.destroy',{id: id}), {
		  preserveScroll: true,
	   });
    }
};

const user = computed(() => usePage().props.user);

const toggleLike = () => {
  if (!props.authUser) {
    alert('Please log in to like this post.')
    return
  }
  form.post(`/phones/${props.phoneId}/like`, {}, {
    preserveScroll: true,
    onSuccess: (page) => {
      liked.value = page.props.liked
      likeCount.value = page.props.like_count
    },
    onError: (errors) => {
      console.error('Like error:', errors)
    },
  })
}

function submitComment() {
  form2.post(route('phones.comments.store', props.phone.id), {
    onSuccess: () => form2.reset('body'),
  })
}

</script>
<template>
<div class="flex flex-row">
    <Brand></Brand>
      <div class="w-2xl rounded overflow-hidden border-gray-600 border me-auto mb-6 p-1">
          <Head :title="`| ${props.phone.nama}  Detail`"/>
                          <h4 class="font-bold text-2xl text-red-500 text-center">{{ props.phone.nama }}</h4>
                          <div class="flex justify-center">
                              <img :src="/image/ + props.phone.gambar" style="width:20%; margin:5px;"> 
                              
                          </div>
                          <Like  @toggle-like="toggleLike" :liked="liked" :like-count="likeCount" />
                           
                            <div class="flex flex-row justify-start">
                                        
                                <Link v-if="user" :href="route('phones.edit', {'id': phone.id})" class="m-3 bg-yellow-500 p-3 rounded">Ubah</Link>
                                <Link :href="route('phones.compare', {'phone1': props.phone.nama, 'phone2': ''})" class="m-3 bg-green-500 p-3 rounded text-white">Bandingkan</Link>
                                <button v-if="user" class="m-3 bg-red-500 p-3 rounded text-white" @click="deletePhone(phone.id)">Hapus</button>        
                                      
                            </div>
                       
                          
                          <ul class="border-t-1 border-l-1 border-r-1 border-gray-300">
                            <PhoneRow :entity="'Dimensi'" :data="props.phone.dimensi" :height='"50px"'/>
                            <PhoneRow :entity="'Berat'" :data="props.phone.berat"/>
                            <PhoneRow :entity="'Material'"  :data="props.phone.material" :height='"60px"'/>
                            <PhoneRow  :entity="'Layar'"  :data="props.phone.layar" :height='"100px"'/>
                            <PhoneRow  :entity="'OS'"  :data="props.phone.os"/>
                            <PhoneRow :entity="'SoC'"  :data="props.phone.soc"/>
                            <PhoneRow :entity="'RAM/Storage'"  :data="props.phone.ramstorage"/>
                            
                          
                          
                          
                            <li class="border-gray-300 border-1"><span class="font-bold text-red-500 ml-5" >Kamera Belakang :</span><br><span class="font-bold text-red-500 ml-5" style="color:red;">Kamera Utama :</span> {{props.phone.kamerautama }}

                              <CameraRow :entity="'Kamera Ultrawide'"  :data="props.phone.kameraultrawide"/>
                              <CameraRow :entity="'Kamera Telephoto'"  :data="props.phone.kameratelephoto"/>
                              <CameraRow :entity="'Kamera Periscope'"  :data="props.phone.kameraperiscope"/>
                              <CameraRow :entity="'Makro'"  :data="props.phone.makro"/>
                              <CameraRow :entity="'Depth'"  :data="props.phone.depth"/>
                
                            </li>
                            <PhoneRow :entity="'Video Belakang'"  :data="props.phone.videobelakang" :height='"75px"'/>
                            <PhoneRow :entity="'Kamera Depan'"  :data="props.phone.kameradepan" :height='"75px"'/>
                            <PhoneRow :entity="'Video Depan'"  :data="props.phone.videodepan"/>
                            <PhoneRow :entity="'Speaker'"  :data="props.phone.speaker"/>
                            <PhoneRow :entity="'3.5mm jack'"  :data="props.phone.audiojack"/>
                            <PhoneRow :entity="'Konektivitas'"  :data="props.phone.konektivitas"/>
                            <PhoneRow :entity="'Sensor'"  :data="props.phone.sensor" :height='"70px"'/>
                            <PhoneRow :entity="'Baterai'"  :data="`${props.phone.baterai} mAh`"/>
                            <PhoneRow :entity="'Charging'"  :data="props.phone.charging" :height='"70px"'/>
                            <PhoneRow :entity="'Harga'"  :data="props.phone.harga" :height='"150px"'/>
                        
                          </ul>

                          
                        
                         
                      
                    
              
        </div>
       

     
      
    </div>
    <div class="w-2xl m-auto rounded overflow-hidden border-gray-600 border p-2">
      <p class="font-bold text-2xl text-red-500">Komentar</p>
      <div v-if="authUser">

                    <form @submit.prevent="submitComment" class="mb-6">
                      <textarea v-model="form2.body" class="w-3/4 border p-2 rounded" placeholder="Tulis komentar..."></textarea>
                      <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded" :disabled="form2.processing">Kirim</button>
                    </form>

                                
                    </div>
        <div v-else>Login untuk menulis komentar</div> 
     <div v-if="props.comments">
      <p class="text-lg text-red-500">{{ props.comments.length }} komentar</p>
      <div v-for="comment in props.comments" :key="comment.id" class="border-t pt-4 mt-4">
        <p class="font-semibold">{{ comment.user.username }}</p>
        <p>{{ comment.body }}</p>
        <p class="text-xs text-gray-500">{{ new Date(comment.created_at).toLocaleString() }}</p>
      </div>
    </div>
      <div v-else>Tidak ada komentar</div>
    </div>
</template>