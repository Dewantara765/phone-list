<script setup>
import Empty from '../Layouts/Empty.vue';
import { Head, useForm } from '@inertiajs/vue3';



defineOptions({
    layout: Empty,
})

const form = useForm({
    username: null,
    email: null,
    password: null

})
const submit = () => {
    form.post(route("signup.store"), {
        forceFormData: true,
    })
   
}
</script>
<template>
    <div class="flex flex-row justify-center">
        <Head :title="` | Signup` "/>
        <div class="w-2xl block m-3 p-3 border rounded-md">
            <div class="flex flex-row justify-center">
                <form @submit.prevent="submit">
                    <div class="m-5" style="font-size:30px; font-weight:bold;">
                        Daftar Akun
                    </div>
                    <div class="mb-3">
                    <label for="username" class="inline-block w-40">Username</label>
                    <input type="text" class="bg-gray-300 inline-block p-2 appearance-none focus:border-blue-500 m-5" id="username" name="username"
                        v-model="form.username">
                </div>
                <div class="mb-3">
                    <label for="email" class="inline-block w-40">Email</label>
                    <input type="text" class="bg-gray-300 inline-block p-2 appearance-none focus:border-blue-500 m-5" id="email" name="email"
                    v-model="form.email">
                </div>
                <div class="mb-3">
                    <label for="password" class="inline-block w-40">Password</label>
                    <input type="password" class="bg-gray-300 inline-block p-2 appearance-none focus:border-blue-500 m-5" id="password" name="password"
                    v-model="form.password">
                </div>
                <p>Sudah punya akun ? <Link :href="route('login')" class="text-blue-600">Login di sini</Link></p>
                <button type="submit" class="bg-green-600 rounded-md p-3 m-3 text-white hover:bg-teal-100 hover:text-green-600">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>
