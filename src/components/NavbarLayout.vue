<template>
    <nav class="flex justify-evenly items-center bg-black text-white py-5 fixed w-[100%]">
        <h1 class="text-2xl">Lks Projects</h1>
        <ul class="flex gap-[10px] items-center">
            <li v-if="!token"><router-link to="/login">Login</router-link></li>
            <li v-if="!token"><router-link to="/register">Register</router-link></li>
            <li v-if="token"><router-link to="/dashboard">Dashboard</router-link></li>
            <li v-if="token"><router-link to="/logout">Logout</router-link></li>
        </ul>
    </nav>
</template>

<script>
export default {
   data(){
    return{
        token : localStorage.getItem('token')
    }
   }
}
</script>
