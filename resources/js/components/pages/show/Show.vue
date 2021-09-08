<template>
    <div id="show">
        <Navbar />

        <main>

            <!-- Hero restaurant -->
            <div id="hero" class="py-4">
                <div class="details container">
                    <h1>{{ restaurant.name }}</h1>
                    <span>
                        <i class="fas fa-shipping-fast"></i>
                        {{ restaurant.delivery_price }} &euro;
                    </span>
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
            </div>
            <!-- /Hero restaurant -->

            <!-- menu -->
            <div class="menu container py-5">
                <div class="d-flex align-items-center justify-content-start">

                    <div class="card" style="width: 18rem;">v-for per ogni singolo piatto
                        <img class="card-img-top" src="" alt="dish name">
                        <div class="card-body">
                            <h5 class="card-title">Nome del piatto</h5>
                            <p class="card-text">Prezzo del piatto</p>
                            <i class="fas fa-plus"></i>
                        </div>
                    </div>

                </div>
                
            </div>
            <!-- /menu -->

        </main>

        <Footer />
    </div>
</template>

<script>
import Navbar from "../../common/Navbar";
import Footer from "../../common/Footer";

export default {
    name: "Show",
    components: {
        Navbar,
        Footer
    },
    data: function() {
        return {
            restaurant: null
        }
    },
    created: function() {
        this.getRestaurant(this.$route.params.slug)
    },
    methods: {
        getRestaurant: function(slug) {
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

    #contact {
        display: flex;
        align-items: center;
    }

</style>