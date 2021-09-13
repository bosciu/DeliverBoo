<template>
    <main>
        <MainCategories />
        <MainCards />
        <MainSearch />
    </main>
</template>

<script>
import MainCategories from "../homepage/main_components/MainCategories";
import MainCards from "../homepage/main_components/MainCards";
import MainSearch from "../homepage/main_components/MainSearch";

export default {
    name: "main",
    components: {
        MainCategories,
        MainCards,
        MainSearch,
    }
};
</script>

<style lang="scss" scoped></style>