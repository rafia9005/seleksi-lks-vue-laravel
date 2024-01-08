<script setup>
import NavbarLayout from "@/components/NavbarLayout.vue";
import axios from "axios";
</script>

<template>
    <main>
        <NavbarLayout />
        <div class="flex justify-center items-center h-screen">
            <div>
                <p class="text-2xl">
                    <span class="text-green-500">Vue</span> +
                    <span class="text-red-500">Laravel</span> +
                    <span class="text-blue-500">Tailwind!</span>
                </p>
                <h1 v-if="!token" class="text-7xl">Hello, World!</h1>
                <h1 v-if="token" class="text-7xl">Selamat datang <span v-if="name">{{ name }}</span></h1>
            </div>
        </div>
    </main>
</template>

<script>
import axios from "axios";
export default {
    data(){
        return{
            name: null,
            token: localStorage.getItem('token')
        }
    },
    async created() {
        const name = await axios.get(
            "http://localhost:8000/api/users/profile",
            {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            }
        );
        this.name = name.data.username;
    },
};
</script>
