<template>
    <div id="show">
        <Navbar />

        <main>
            <div class="container">
                <div class="row">
                    <div class="col-8">
                        <!-- Hero restaurant -->
                        <div id="hero" class="py-4">
                            <div class="details container">
                                <h1>{{ restaurant.name }}</h1>
                                <span>
                                    <i class="fas fa-shipping-fast"></i>
                                    {{ restaurant.delivery_price }} &euro;
                                </span>
                                <span class="badge badge-pill badge-info"
                                    >v-for</span
                                >
                                <a class="d-block" href="#">iframe mappa?</a>
                                <h5>
                                    Indirizzo per esteso con tanto di cap,
                                    provincia e stato
                                </h5>

                                <div id="contact" @click="closeContact()">
                                    <div>
                                        <i class="fas fa-info-circle mr-3"></i>
                                    </div>

                                    <div>
                                        <h5>Informazioni sul ristorante</h5>
                                        <h6>
                                            Intolleranze, allergeni o richieste
                                            di varia natura
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Hero restaurant -->

                        <!-- menu -->
                        <div class="menu container py-5">
                            <div
                                class="d-flex align-items-center justify-content-start"
                            >
                                <div class="card" style="width: 18rem;">
                                    v-for per ogni singolo piatto
                                    <img
                                        class="card-img-top"
                                        src=""
                                        alt="dish name"
                                    />
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Nome del piatto
                                        </h5>
                                        <p class="card-text">
                                            Prezzo del piatto
                                        </p>
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /menu -->
                    </div>

                    <div class="col-4" id="cart">
                        <div id="checkout">
                            Vai alla cassa
                        </div>
                        <div class="products container mt-3">
                            <div class="row align-items-center">
                                <div class="col-3 quantity">
                                    <span class="button-container">
                                        <i class="fas fa-minus"></i>
                                    </span>
                                    <span>1</span>
                                    <span class="button-container">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                </div>
                                <div class="col-6 single-product">
                                    Nome Articolo
                                </div>
                                <div class="col-3 tot">12,00€</div>
                            </div>
                            <hr />
                        </div>
                        <div class="subtotal">
                            <div class="row mt-3">
                                <div class="col-8">Subtotale</div>
                                <div class="col text-right">20.00 €</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-8">Spese di consegna</div>
                                <div class="col text-right">
                                    {{ restaurant.delivery_price.toFixed(2) }} €
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">Totale</div>
                                <div class="col text-right">
                                    Somma €
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
        };
    },
    created: function() {
        this.getRestaurant(this.$route.params.slug);
    },
    methods: {
        getRestaurant: function(slug) {
            axios
                .get(`http://127.0.0.1:8000/api/${slug}/get-restaurant`)
                .then(res => {
                    this.restaurant = res.data;
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

<style lang="scss" scoped>
#contact {
    display: flex;
    align-items: center;
}

#cart {
    height: 500px;
    padding: 30px;
    border-radius: 7px;
    background-color: cornflowerblue;
    #checkout {
        padding: 15px 20px;
        border-radius: 7px;
        font-weight: 700;
        background-color: #fdd0af;
        box-shadow: 0 4px 8px black;
        text-align: center;
        cursor: pointer;
    }
    .products {
        .quantity {
            display: flex;
            justify-content: space-between;
            padding: 5px;
            font-size: 14px;
            & > .button-container {
                display: inline-block;
                position: relative;
                width: 20px;
                height: 20px;
                border-radius: 50%;
                border: 2px solid coral;
                margin: 0 2px;
                font-size: 11px;
                cursor: pointer;
                i {
                    position: absolute;
                    top: 45%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                }
            }
        }
        .tot {
            font-size: 14px;
        }
    }
}
</style>
