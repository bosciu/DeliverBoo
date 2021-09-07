<template>
    <div id="store">
        <header >
            <Navbar />
        </header>
        <main>
            <aside></aside>
            <section></section>
        </main>
    </div>
</template>

<script>
import Navbar from "../../common/Navbar";
export default {
    name: "Store",
    components: {
        Navbar
    }
};
</script>

<style lang="scss" scoped>
</style>
