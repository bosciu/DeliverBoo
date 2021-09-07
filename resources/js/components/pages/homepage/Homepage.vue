<template>
    <div id="homepage" class="container">
        <Header />
        <main>
            <h1>Main</h1>
        </main>
        <Footer />
    </div>
</template>

<script>
import Header from "../../common/Header";
import Footer from "../../common/Footer";
export default {
    name: "Homepage",
    components: {
        Header,
        Footer
    }
};
</script>

<style lang="scss" scoped></style>
