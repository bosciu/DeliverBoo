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

                                <h6
                                    v-for="(category,
                                    index) in restaurant.restaurant_types"
                                    :key="index"
                                    class="badge badge-pill badge-info mr-2"
                                >
                                    {{ category.name }}
                                </h6>

                                <p>
                                    <i class="fas fa-shipping-fast"></i>
                                    {{ restaurant.delivery_price }} &euro;
                                </p>

                                <!-- <a class="d-block" href="#">iframe mappa?</a> -->
                                <h6>
                                    {{ restaurant.address.address }}
                                    {{ restaurant.address.city }}
                                </h6>

                                <!-- contact modal click-->
                                <div
                                    id="contact"
                                    data-toggle="modal"
                                    data-target="#contactModal"
                                >
                                    <div>
                                        <i class="fas fa-info-circle mr-3"></i>
                                    </div>

                                    <div>
                                        <h5>Informazioni sul ristorante</h5>
                                        <h6>
                                            Intolleranze, allergeni o altre
                                            richieste
                                        </h6>
                                    </div>
                                </div>
                                <!-- /contact modal click-->

                                <!-- modal opened -->
                                <div
                                    class="modal fade"
                                    id="contactModal"
                                    tabindex="-1"
                                    aria-labelledby="exampleModalLabel"
                                    aria-hidden="true"
                                >
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5
                                                    class="modal-title"
                                                    id="exampleModalLabel"
                                                >
                                                    Contatta il ristorante
                                                </h5>
                                                <button
                                                    type="button"
                                                    class="close"
                                                    data-dismiss="modal"
                                                    aria-label="Close"
                                                >
                                                    <span aria-hidden="true"
                                                        >&times;</span
                                                    >
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <h6>
                                                    Hai allergie, intolleranze o
                                                    altre richieste? Contattaci!
                                                </h6>
                                                <p>{{ restaurant.phone }}</p>
                                            </div>

                                            <div class="modal-footer">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    data-dismiss="modal"
                                                >
                                                    Chiudi
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /modal opened -->
                            </div>
                        </div>
                        <!-- /Hero restaurant -->

                        <!-- menu -->
                        <div class="menu container py-5">
                            <div
                                v-for="(category,
                                index) in restaurant.dish_categories"
                                :key="index"
                                class="align-items-center justify-content-start"
                            >
                                <h3>{{ category.name }}</h3>

                                <div class="d-flex">
                                    <div
                                        v-for="(dish, index) in dishes"
                                        :key="index"
                                    >
                                        <div
                                            class="card"
                                            style="width: 18rem;"
                                            data-toggle="modal"
                                            data-target="#dishModal"
                                        >
                                            <img
                                                class="card-img-top"
                                                :src="
                                                    '/storage/' + dish.img_path
                                                "
                                                alt=""
                                            />
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    {{ dish.name }}
                                                </h5>
                                                <p class="card-text">
                                                    {{ dish.price }} &euro;
                                                </p>
                                                <p class="card-text">
                                                    {{ dish.desc }}
                                                </p>
                                            </div>
                                        </div>

                                        <div
                                            class="modal fade"
                                            id="dishModal"
                                            tabindex="-1"
                                            aria-labelledby="exampleModalLabel"
                                            aria-hidden="true"
                                        >
                                            <div
                                                class="modal-dialog modal-dialog-centered"
                                            >
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            {{ dish.name }}
                                                        </h5>
                                                        <button
                                                            type="button"
                                                            class="close"
                                                            data-dismiss="modal"
                                                            aria-label="Close"
                                                        >
                                                            <span
                                                                aria-hidden="true"
                                                                >&times;</span
                                                            >
                                                        </button>
                                                    </div>

                                                    <div
                                                        class="modal-body"
                                                    ></div>

                                                    <div class="modal-footer">
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary"
                                                            data-dismiss="modal"
                                                        >
                                                            Chiudi
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
            restaurant: null,
            dishes: []
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
                    this.dishes = this.restaurant.dishes;

                    // this.restaurant.dishes.forEach(dish, index => {
                    //     console.log(dish, index);
                    //     this.dishes.push(dish);

                    // });
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
    cursor: pointer;
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
