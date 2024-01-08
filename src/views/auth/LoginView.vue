<template>
    <router-link to="/">back to home</router-link>
    <main class="flex justify-center items-center h-screen">
        <div class="shadow-lg px-5 py-5">
            <h1 class="text-3xl text-center mb-3">Login</h1>
            <h1 v-if="validation.message">{{ validation.message }}</h1>
            <form @submit.prevent="loginHandler">
                <div class="mb-5">
                    <input
                        v-model="username"
                        type="text"
                        name="username"
                        placeholder="Input your username"
                        required
                        autofocus
                        class="p-2 border border-black rounded-sm shadow-lg"
                    />
                </div>
                <div>
                    <input
                        v-model="password"
                        type="password"
                        name="password"
                        placeholder="Input your password"
                        required
                        class="p-2 border border-black rounded-sm shadow-lg"
                    />
                </div>
                <div class="justify-center items-center flex">
                    <button
                        type="submit"
                        class="mt-5 bg-black text-white py-1 px-3 rounded-md"
                    >
                        Login
                    </button>
                </div>
            </form>
        </div>
    </main>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            username: null,
            password: null,
            validation: {},
        };
    },
    methods: {
        async loginHandler() {
            try {
                const formData = new FormData();
                formData.append("username", this.username);
                formData.append("password", this.password);

                const response = await axios.post(
                    "http://localhost:8000/api/users/auth",
                    formData
                );
                const token = response.data.access_token;
                localStorage.setItem("token", token);
                this.$router.push("/dashboard");
            } catch (error) {
                this.validation = error.response.data;
            }
        },
    },
    created() {
        if (localStorage.getItem("token")) {
            this.$router.push("/dashboard");
        }
    },
};
</script>
