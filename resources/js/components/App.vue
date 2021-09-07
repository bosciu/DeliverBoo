<template>
    <div id="app">
        <!-- <Homepage /> -->
        <router-view></router-view>
    </div>
</template>

<script>
import Homepage from "./pages/homepage/Homepage";
export default {
    name: "App",
    components: {
        Homepage
    },
    data() {
        return {};
    },
    methods: {}
};
</script>

<style scoped lang="scss"></style>
