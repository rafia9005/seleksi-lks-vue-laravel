<template>

</template>

<script>
export default {
    created() {
        localStorage.removeItem("token");
        localStorage.removeItem("role");
        this.$router.push("/login");
    },
};
</script>
