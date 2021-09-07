<template>
    <div id="homepage">
        <Header />
        <Main />
        <Footer />
    </div>
</template>

<script>
import Header from "../../common/Header";
import Footer from "../../common/Footer";
import Main from "../../pages/homepage/Main"
export default {
    name: "Homepage",
    components: {
        Header,
        Footer,
        Main
    }
};
</script>

<style lang="scss" scoped></style>
