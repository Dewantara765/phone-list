<script setup>
import { computed, ref, watch } from 'vue';
import { useForm} from '@inertiajs/vue3';
import InputError from './Components/InputError.vue';

const props = defineProps({
  count : Number,
})


let url = ref(null);


const form = useForm({
    gambar: null,
    nama: '',
    slug: '',
    brand: null,
    dimensi: null,
    berat: null,
    material : null,
    layar: null,
    os : null,
    soc : null,
    ramstorage: null,
    kamerautama: null,
    kameraultrawide: null,
    kameratelephoto: null,
    kameraperiscope: null,
    makro: null,
    depth: null,
    videobelakang: null,
    kameradepan: null,
    videodepan: null,
    speaker: null,
    audiojack: null,
    konektivitas: null,
    sensor: null,
    baterai: null,
    charging: null,
    harga: null,
})



const generateSlug = () => {
    
    const phoneName = form.nama.replaceAll(' ', '-')
    const phoneName2 = phoneName.replaceAll('+', '-plus')
    form.slug = `${phoneName2.toLowerCase()}-${props.count + 1}`;
}






const submit = () => {
    form.post(route("phones.store"), {
        forceFormData: true,
    })
   
}

    function previewImage(e) {
                form.gambar = e.target.files[0];
                if (form.gambar) {
            url.value = URL.createObjectURL(form.gambar);
  }
            }

</script>
<template>
    <Head title="| Create Phone"/>
    <div class="w-2xl block">
        <h3 class="font-bold text-xl">Tambah Data Phone</h3>
        <form @submit.prevent="submit">
                <div class="mb-3">
                  <label for="gambar">Link Gambar</label>
                  <input type="file"  @change="previewImage" class="bg-gray-500 p-2"/>
                  <div class="flex flex-row">
                    <p class="w-40"></p>
                    <img v-if="url":src="url" class="mt-4 h-50"/>
                  </div>
                  <div v-if="form.errors.gambar" class="text-sm text-red-600"> {{ form.errors.gambar }}</div>
                                
                </div>
                <div class="mb-3">
                  <label for="nama" class="inline-block w-40">Nama</label>
                  <input type="text" id="nama" name="nama" v-model="form.nama" v-on:keyup="generateSlug">
                  <InputError :message="form.errors.nama"/>
                </div>
                <div class="mb-3">
                  <label for="slug" class="inline-block w-40">Slug</label>
                  <input type="text" id="slug" name="slug"  v-model="form.slug">
                  <InputError :message="form.errors.slug"/>
                </div>
                <div class="mb-3">
                  <label for="brand" class="inline-block w-40">Brand</label>
                  <input type="text" id="brand" name="brand" v-model="form.brand">
                  <InputError :message="form.errors.brand"/>
                </div>
                <div class="mb-3">
                  <label for="dimensi" class="inline-block w-40">Dimensi</label>
                  <input type="text" id="dimensi" name="dimensi" v-model="form.dimensi"> 
                </div>
                <div class="mb-3">
                  <label for="berat" class="inline-block w-40">Berat</label>
                  <input type="text" id="berat" name="berat"v-model="form.berat">
                </div>
                <div class="mb-3">
                  <div class="input-textarea">
                      <label for="material" class="label-textarea">Material</label>
                      <textarea id="material" name="material" cols="40" rows="5" wrap="hard" v-model="form.material"></textarea>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="input-textarea">
                    <label for="layar" class="inline-block w-40">Layar</label>
                    <textarea id="layar" name="layar" cols="40" rows="5" wrap="hard" v-model="form.layar"></textarea>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="os" class="inline-block w-40">OS</label>
                  <input type="text" id="os" name="os" v-model="form.os">
                  <InputError :message="form.errors.os"/>
                </div>
                <div class="mb-3">
                  <div class="input-textarea">
                    <label for="soc" class="label-textarea">SoC</label>
                    <textarea id="soc" name="soc" cols="40" rows="5" wrap="hard" v-model="form.soc"></textarea>
                  </div>
                  <InputError :message="form.errors.soc"/>
                </div>
                <div class="mb-3">
                  <div class="input-textarea">
                    <label for="ramstorage" class="label-textarea">RAM/Storage</label>
                    <textarea id="ramstorage" name="ramstorage" cols="20" rows="5" wrap="hard" v-model="form.ramstorage"></textarea>  
                </div>
                  <InputError :message="form.errors.ramstorage"/>
                  </div>
                <div class="mb-3">
                  <div class="input-textarea">
                    <label for="kamerautama" class="label-textarea">Kamera Utama</label>
                    <textarea id="kamerautama" name="kamerautama" cols="40" rows="5" wrap="hard"v-model="form.kamerautama"></textarea>
                  </div>
                  <InputError :message="form.errors.kamerautama"/>
                </div>
                <div class="mb-3">
                  <div class="input-textarea">
                    <label for="kameraultrawide" class="label-textarea">Kamera Ultrawide</label>
                    <textarea id="kameraultrawide" name="kameraultrawide" cols="40" rows="5" wrap="hard" v-model="form.kameraultrawide"></textarea>
                  </div>
                </div>
                <div class="mb-3">
                <div class="input-textarea">
                    <label for="kameratelephoto" class="label-textarea">Kamera Telephoto</label>
                    <textarea id="kameratelephoto" name="kameratelephoto" cols="40" rows="5" wrap="hard" v-model="form.kameratelephoto"></textarea>
                  </div>
                </div>
                <div class="mb-3">
                <div class="input-textarea">
                    <label for="kameraperiscope" class="label-textarea">Kamera Periscope</label>
                    <textarea id="kameraperiscope" name="kameraperiscope" cols="40" rows="5" wrap="hard" v-model="form.kameraperiscope"></textarea>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="makro" class="inline-block w-40">Makro</label>
                  <input type="text" id="makro" name="makro" v-model="form.makro">
                </div>
                <div class="mb-3">
                  <label for="depth" class="inline-block w-40">Depth</label>
                  <input type="text" id="depth" name="depth" v-model="form.depth">
                </div>
                <div class="mb-3">
                <div class="input-textarea">
                    <label for="videobelakang" class="label-textarea">Video Belakang</label>
                    <textarea id="videobelakang" name="videobelakang" cols="40" rows="5" wrap="hard" v-model="form.videobelakang"></textarea>
                  </div>
                  <InputError :message="form.errors.videobelakang"/>
                </div>
                <div class="mb-3">
                <div class="input-textarea">
                    <label for="kameradepan" class="label-textarea">Kamera Depan</label>
                    <textarea id="kameradepan" name="kameradepan" cols="40" rows="5" wrap="hard" v-model="form.kameradepan"></textarea>
                  </div>
                  <InputError :message="form.errors.kameradepan"/>
                </div>
                <div class="mb-3">
                  <div class="input-textarea">
                    <label for="videodepan" class="label-textarea">Video Depan</label>
                    <textarea id="videodepan" name="videodepan" cols="40" rows="5" wrap="hard" v-model="form.videodepan"></textarea>
                  </div>
                  
                </div>
                <div class="mb-3">
                  <label for="speaker" class="inline-block w-40">Speaker</label>
                  <input type="text" id="speaker" name="speaker" v-model="form.speaker">
                  <InputError :message="form.errors.speaker"/>
                </div>
                <div class="mb-3">
                  <label for="audiojack" class="inline-block w-40">3.5mm jack</label>
                  <input type="text" id="audiojack" name="audiojack" v-model="form.audiojack">
                  <InputError :message="form.errors.audiojack"/>
                </div>
                <div class="mb-3">
                  <div class="input-textarea">
                    <label for="konektivitas" class="label-textarea">Konektivitas</label>
                    <textarea id="konektivitas" name="konektivitas" cols="40" rows="5" wrap="hard" v-model="form.konektivitas"></textarea>
                  </div>
                  <InputError :message="form.errors.konektivitas"/>
                </div>
                <div class="mb-3">
                  <div class="input-textarea">
                    <label for="sensor" class="label-textarea">Sensor</label>
                    <textarea id="sensor" name="sensor" cols="40" rows="5" wrap="hard" v-model="form.sensor"></textarea>
                  </div>
                  <InputError :message="form.errors.sensor"/>
                </div>
                <div class="mb-3">
                  <label for="baterai" class="inline-block w-40">Baterai</label>
                  <input type="text" id="baterai" name="baterai" v-model="form.baterai">
                  <InputError :message="form.errors.baterai"/>
                </div>
                <div class="mb-3">
                  <div class="input-textarea">
                    <label for="charging" class="label-textarea">Charging</label>
                    <textarea id="charging" name="charging" cols="40" rows="5" wrap="hard" v-model="form.charging"></textarea>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="input-textarea">
                    <label for="harga" class="label-textarea">Harga</label>
                    <textarea id="harga" name="harga" cols="40" rows="5" wrap="hard" v-model="form.harga"></textarea>
                  </div>
                </div>
                <button type="submit" class="bg-sky-500 hover:bg-gray-300 p-3 m-4 rounded text-white">Tambah</button>
        </form>
    </div>

</template>