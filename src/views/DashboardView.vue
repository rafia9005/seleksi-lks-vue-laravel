<template>
    <nav class="flex justify-evenly items-center py-2 bg-black text-white">
        <h1>Dashboard</h1>
        <ul class="flex justify-center items-center gap-[15px]">
            <li v-if="name">{{ name }}</li>
            <li><router-link to="/logout">Logout</router-link></li>
        </ul>
    </nav>
    <div class="justify-center items-center flex mt-5 w-[100%]">
        <div>
            <!-- ini data player -->
            <h1 class="text-2xl">Data Players</h1>
            <table
                class="table-auto p-5 text-center w-[100%] "
                v-if="player && player.length > 0"
            >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>posisi</th>
                        <th>nama</th>
                        <th>nomer punggung</th>
                        <th>created by</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody v-for="item in player" :key="item.id">
                    <tr>
                        <td class="px-5">{{ item.id }}</td>
                        <td class="px-5">{{ item.posisi }}</td>
                        <td class="px-5">{{ item.nama }}</td>
                        <td class="px-5">{{ item.nomer_punggung }}</td>
                        <td class="px-5">{{ item.created_by.username }}</td>
                        <td>
                            <button
                                class="bg-red-500 text-white px-1 rounded-md"
                                @click="deletePlayer(item.id)"
                            >
                                Delete
                            </button>
                            <button >Edit</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div v-else>
                <h1>Belum ada data player</h1>
            </div>
            <!-- ini data users -->
            <h1>Data User</h1>
            <table
                class="table-auto p-5 text-center mt-5 w-[100%]"
                v-if="users && users.length > 0"
            >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>username</th>
                        <th>created at</th>
                    </tr>
                </thead>
                <tbody v-for="user in users" :key="user.id">
                    <tr>
                        <td>{{ user.id }}</td>
                        <td>{{ user.username }}</td>
                        <td>{{ user.created_at }}</td>
                    </tr>
                </tbody>
            </table>
            <div v-else>
                <h1>Belum ada data player</h1>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            name: null,
            player: null,
            users: null,
            errorDeletePlayer: null,
        };
    },
    async created() {
        const token = localStorage.getItem("token");
        if (!token) {
            this.$router.push("/login");
        }
        // name check
        const nameCheck = await axios.get(
            "http://localhost:8000/api/users/profile",
            {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            }
        );
        this.name = nameCheck.data.username;
        // players check
        const player = await axios.get("http://localhost:8000/api/player", {
            headers: {
                Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
        });
        this.player = player.data.data;
        // users check
        const users = await axios.get("http://localhost:8000/api/users", {
            headers: {
                Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
        });
        this.users = users.data.data;
    },
    methods: {
        // delete player method
        async deletePlayer(playerId) {
            try {
                await axios.delete(`http://localhost:8000/api/player/${playerId}`, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "token"
                        )}`,
                    },
                });
                window.location.reload();
            } catch (error) {
                console.error(error);
            }
        },
    },
};
</script>
