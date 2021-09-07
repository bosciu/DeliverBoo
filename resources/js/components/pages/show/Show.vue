<template>
    <div id="show">
        <!-- <Header /> -->

        <main class="container py-4">

            <!-- Hero restaurant -->
            <div id="hero">
                <div class="details">
                    <h1>Nome del ristorante</h1>
                    <span class="badge badge-pill badge-info">v-for</span>
                    <a class="d-block" href="#">iframe mappa?</a>
                    <h5>Indirizzo per esteso con tanto di cap, provincia e stato</h5>

                    <div id="contact" @click="closeContact()">
                        <div>
                            <i class="fas fa-info-circle mr-3"></i>
                        </div>

                        <div>
                            <h5>Informazioni sul ristorante</h5>
                            <h6>Intolleranze, allergeni o richieste di varia natura</h6>
                        </div>
                    </div>
                </div>

                <div class="restaurant-image">
                    <img src="" alt="">
                </div>
            </div>
            <!-- /Hero restaurant -->

        </main>

        <Footer />
    </div>
</template>

<script>
import Header from "../../common/Header";
import Footer from "../../common/Footer";

export default {
    name: "Show",
    components: {
        Header,
        Footer
    },
    data: function() {
        return {
            restaurant: null
        }
    },
    methods: {
        getRestaurant: function(restaurant) {
            axios
                .get(`http://127.0.0.1:8000/api/${slug}/get-restaurant`)
                .then(
                    res => {
                        this.restaurant = res.data;
                    }
                )
                .catch(
                    err => {
                        console.log(err);
                    }
                );
        }
    }
}
</script>

<style lang="scss" scoped>

    // #hero {
    //     background-color: #fdd0af;
    // }

    #contact {
        display: flex;
        align-items: center;
    }

</style>