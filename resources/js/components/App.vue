<template>
    <div id="app">
        <!-- <Homepage /> -->
        <router-view :key="$route.fullPath"></router-view>
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
    methods: {},
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                document.title = "DeliverBoo | " + to.meta.title;
            }
        }
    }
};
</script>

<style scoped lang="scss"></style>
