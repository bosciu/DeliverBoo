<template>
    <div>
      <div id="homepage" v-show="!loading">
            <Header />
            <Main />
            <Footer />
        </div>
        <Loading v-show="loading" />  
    </div>
    
</template>

<script>
import Header from "../../common/Header";
import Footer from "../../common/Footer";
import Loading from "../../common/Loading";
import Main from "../../pages/homepage/Main";

export default {
    name: "Homepage",
    components: {
        Header,
        Footer,
        Main,
        Loading
    },
    data: function() {
        return {
            loading:true
        }
    },
    created:function() {

        setTimeout(()=>{
            this.loading = false;
        }, 2000);
    }
};
</script>

<style lang="scss" scoped></style>
