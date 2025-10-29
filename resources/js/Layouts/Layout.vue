<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import LayoutButton from '../Pages/Components/LayoutButton.vue';
import { router } from '@inertiajs/vue3';
import debounce from 'lodash/debounce';

 const props = defineProps({
    active : String,
  
 })


 const activeNavHome = computed(() => ({
    'font-bold text-yellow-500 md:bg-white p-3' : props.active === "home",
    'font-semibold md:text-white' : props.active != "home"
 }))

 const activeNavBrand = computed(() => ({
    'font-bold text-yellow-500 md:bg-white p-3' : props.active === "brand",
    'font-semibold md:text-white' : props.active != "brand"
 }))

 const activeNavCompare = computed(() => ({
    'font-bold text-yellow-500 md:bg-white p-3' : props.active === "compare",
    'font-semibold md:text-white' : props.active != "compare"
 }))



 const data_results3 = ref([]);



 const logout = () => {
     form.post(route('logout'))
 }

const user = computed(() => usePage().props.user);
const isMenuOpen = ref(false);
const form = useForm();

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};



</script>
<template>
<div class="bg-indigo-600">
        <nav class="container px-5 py-3 md:flex md:justify-center space-x-4 md:items-center">
            <div class="flex items-center justify-between">
                <router-link to="/" class="text-xl font-bold text-gray-100 md:text-2xl hover:text-indigo-400">Phone List
                </router-link>
                <!-- Mobile menu button -->
                <div @click="toggleMenu()" class="flex md:hidden">
                    <button type="button"
                        class="text-gray-100 hover:text-gray-400 focus:outline-none focus:text-gray-400">
                        <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                            <path fill-rule="evenodd"
                                d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
            <div :class="isMenuOpen ? 'flex' : 'hidden'"
                class="flex-col space-y-0 md:flex  md:flex-row md:items-center md:space-x-6 md:mt-0 me-auto">
                <Link :href="route('phones.index')" class=" text-indigo-500 block py-2 px-3 rounded bg-white md:bg-indigo-600" :class="activeNavHome">Home</Link>
                <Link :href="route('phones.compare')" class="text-indigo-500 block py-2 px-3 rounded bg-white md:bg-indigo-600" :class="activeNavCompare">Compare</Link>
              
            </div>
           
            
            <div class="flex flex-col  md:flex md:flex-row md:space-x-4">
                
                    <div v-if="user">
                        <form @submit.prevent="logout" class="flex gap-2 items-center my-2 mx-4">
                            <p class="text-white">{{ user.username }}</p>
                            <button type="submit" class="text-black py-2 px-4 rounded bg-yellow-300">Keluar</button>
                        </form>
                    
                    </div>
                    <div v-else class="flex gap-2 items-center mx-4 my-4">
                        <Link :href="route('login')" class="text-black py-2 px-4 rounded bg-yellow-300">Masuk</Link>
                        <Link :href="route('signup')" class="text-black py-2 px-4 rounded bg-yellow-300">Daftar</Link>
                    </div>

                   
                </div>
                <!-- <div v-else> -->
           
        </nav>
    </div>
        <main class="p-4 m-5">
            <slot/>
        </main>
   
</template>
