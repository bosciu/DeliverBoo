<template>
    <div id="show">
        <header>
          <Navbar />  
        </header>

        <main>
            <Loading v-if="!isLoaded" />
            <div v-else class="container pt-5">
                <div class="row">
                    <div class="col-8">
                        <div id="hero" class="py-4">
                            <div class="details container">
                                <div class="img-container rounded mb-3 bt-3">
                                    <img
                                        :src="'/storage/' + restaurant.img_path"
                                        alt=""
                                        class="w-100 h-100"
                                    />
                                </div>
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

                                <h6>
                                    {{ restaurant.address.address }}
                                    {{ restaurant.address.city }}
                                </h6>

                                <div
                                    id="contact"
                                    data-toggle="modal"
                                    data-target="#contactModal"
                                    class="my-3 p-3"
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
                            </div>
                        </div>
                        <!-- /Hero restaurant -->

                        <!-- menu -->
                        <div class="menu container py-5">
                            <div
                                v-for="(category,
                                index) in restaurant.dish_categories"
                                :key="index"
                                class="row flex-column"
                            >
                                <h3>{{ category.name }}</h3>
                                <div
                                    class="dish-container d-flex justify-content-start flex-wrap mb-4"
                                >
                                    <div
                                        class="dish mb-3 mr-3"
                                        :class="
                                            category.id == dish.dish_category_id
                                                ? ''
                                                : 'd-none'
                                        "
                                        v-for="(dish, index) in dishes"
                                        :key="index"
                                        @click="setDish(dish)"
                                    >
                                        <div
                                            class="card"
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /menu -->
                    </div>

                    <!-- CARRELLO -->
                    <div class="col-4" id="cart">
                        <div class="layover" v-if="anotherRest"></div>
                        <div id="checkout-another" v-if="anotherRest">
                            <span>Carrello in un altro ristorante</span>
                            <router-link
                                :to="{
                                    name: 'show',
                                    params: { slug: orderDishes[0].slug }
                                }"
                            >
                                Per visualizzare il tuo carrello, clicca
                                qui!</router-link
                            >
                        </div>
                        <div
                            id="checkout"
                            v-else-if="this.orderDishes.length > 0"
                        >
                            <a
                                @click="sendOrder"
                                :href="this.$route.params.slug + '/checkout'"
                                >Vai alla cassa</a
                            >
                        </div>
                        <div id="checkout" v-else>
                            Aggiungi articoli al carrello
                        </div>
                        <div
                            class="products container mt-3"
                            v-if="!anotherRest"
                        >
                            <!-- CICLO SUI PRODOTTI -->
                            <div
                                class="row align-items-center"
                                v-for="orderDish in orderDishes"
                                :key="orderDish.id"
                            >
                                <div class="col-3 quantity">
                                    <span class="button-container">
                                        <i
                                            class="fas fa-minus"
                                            @click="removeItem(orderDish)"
                                        ></i>
                                    </span>
                                    <span>{{ orderDish.quantity }}</span>
                                    <span class="button-container">
                                        <i
                                            class="fas fa-plus"
                                            @click="addItem(orderDish)"
                                        ></i>
                                    </span>
                                </div>
                                <div class="col-6 single-product">
                                    {{ orderDish.name }}
                                </div>
                                <div class="col-3 tot">
                                    {{
                                        (
                                            orderDish.price * orderDish.quantity
                                        ).toFixed(2)
                                    }}€
                                </div>
                            </div>
                            <hr />
                        </div>
                        <div
                            class="subtotal"
                            v-if="this.orderDishes.length > 0 && !anotherRest"
                        >
                            <div class="row mt-3">
                                <div class="col-8">Subtotale</div>
                                <div class="col text-right">
                                    {{ subTotal }} €
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-8">Spese di consegna</div>
                                <div class="col text-right">
                                    {{ restaurant.delivery_price.toFixed(2) }} €
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">Totale</div>
                                <div class="col text-right">{{ sum }} €</div>
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
import Loading from "../../common/Loading";

export default {
    name: "Show",
    components: {
        Navbar,
        Footer,
        Loading
    },
    data: function() {
        return {
            restaurant: null,
            isLoaded: false,
            dishes: [],
            orderDishes: [],
            finded: false,
            sum: 0,
            subTotal: 0
        };
    },
    created: function() {
        this.getRestaurant(this.$route.params.slug);
        this.orderDishes = JSON.parse(localStorage.getItem("orders"));
        if (!this.orderDishes) {
            this.orderDishes = [];
        }
    },
    computed: {
        anotherRest() {
            if (this.orderDishes.length > 0) {
                if (this.orderDishes[0].restaurant_id == this.restaurant.id) {
                    return false;
                } else {
                    return true;
                }
            }
        }
    },
    methods: {
        getRestaurant: function(slug) {
            axios
                .get(`http://127.0.0.1:8000/api/${slug}/get-restaurant`)
                .then(res => {
                    this.restaurant = res.data;
                    this.dishes = this.restaurant.dishes;
                    let subTotal = 0;
                    if (this.orderDishes.length > 0) {
                    }
                    this.orderDishes.forEach(orderDish => {
                        subTotal += orderDish.price * orderDish.quantity;
                    });
                    this.subTotal = subTotal.toFixed(2);
                    this.sum = (
                        parseFloat(this.subTotal) +
                        this.restaurant.delivery_price
                    ).toFixed(2);
                })
                .catch(err => {
                    console.log(err);
                });
        },
        addItem(dish) {
            if (this.orderDishes.length == 0) {
                this.setDish(dish);
            } else {
                this.orderDishes.forEach(orderDish => {
                    if (orderDish.id === dish.id) {
                        orderDish.quantity++;
                        this.$forceUpdate();
                    }
                });
                localStorage.setItem(
                    "orders",
                    JSON.stringify(this.orderDishes)
                );
            }
            let subTotal = 0;
            this.orderDishes.forEach(orderDish => {
                subTotal += orderDish.price * orderDish.quantity;
            });
            this.subTotal = subTotal.toFixed(2);
            this.sum = (
                parseFloat(this.subTotal) + this.restaurant.delivery_price
            ).toFixed(2);
        },
        removeItem(dish) {
            this.orderDishes.forEach((orderDish, index) => {
                if (orderDish.id === dish.id) {
                    if (orderDish.quantity == 1) {
                        this.orderDishes.splice(index, 1);
                    } else {
                        orderDish.quantity--;
                        this.$forceUpdate();
                    }
                }
            });
            localStorage.setItem("orders", JSON.stringify(this.orderDishes));
            let subTotal = 0;
            this.orderDishes.forEach(orderDish => {
                subTotal += orderDish.price * orderDish.quantity;
            });
            this.subTotal = subTotal.toFixed(2);
            this.sum = (
                parseFloat(this.subTotal) + this.restaurant.delivery_price
            ).toFixed(2);
        },
        setDish(dish) {
            if (!this.anotherRest) {
                let finded = false;
                let findedIndex = undefined;
                if (this.orderDishes.length <= 0) {
                    this.orderDishes.push(dish);
                    this.orderDishes[0].quantity = 1;
                    this.orderDishes[0].slug = this.$route.params.slug;
                    this.orderDishes[0].restaurant = this.restaurant.name;
                    this.orderDishes[0].delivery_price = this.restaurant.delivery_price;
                } else {
                    for (
                        let index = 0;
                        index < this.orderDishes.length;
                        index++
                    ) {
                        const orderDish = this.orderDishes[index];
                        if (orderDish.id === dish.id) {
                            finded = true;
                            findedIndex = index;
                        }
                    }
                    if (!finded) {
                        this.orderDishes.push(dish);
                        this.orderDishes[
                            this.orderDishes.length - 1
                        ].quantity = 1;
                    } else {
                        this.orderDishes[findedIndex].quantity++;
                    }
                }
                localStorage.setItem(
                    "orders",
                    JSON.stringify(this.orderDishes)
                );
                let subTotal = 0;
                this.orderDishes.forEach(orderDish => {
                    subTotal += orderDish.price * orderDish.quantity;
                });
                this.subTotal = subTotal.toFixed(2);
                this.sum = (
                    parseFloat(this.subTotal) + this.restaurant.delivery_price
                ).toFixed(2);
            }
        },
        sendOrder() {
            axios
                .post("http://127.0.0.1:8000/api/da-gianni/checkout", {
                    ...this.orderDishes
                })
                .then(response => {})
                .catch(err => console.log(err));
        }
    },
    watch: {
        restaurant() {
            this.isLoaded = true;
        },
        orderDishes() {
            localStorage.setItem("orders", JSON.stringify(this.orderDishes));
        }
    }
};
</script>

<style lang="scss" scoped>
@import "./resources/sass/_variables";

    header {
        background-color: $bgPrimary;
        background-image: url(/images/sfondo-show-store.png);
        background-size: contain;
        background-position: right;
        background-repeat: no-repeat;
        padding-bottom: 10px;
    }

    main {
        background: linear-gradient($bgPrimary, whitesmoke 3%);
        
        .img-container {
            width: 450px;
            height: 300px;
            box-shadow: 0 0 4px black;
            overflow: hidden;

            img {
                object-fit: cover;
                object-position: center;
            }
        }

        #contact {
            display: flex;
            align-items: center;
            cursor: pointer;
            width: 60%;
            border: 2px solid $darkGreenFont;
            border-radius: 3px;
            background-color: $bgPrimary;
        }

        .dish-container {
            .card {
                height: 280px;
                box-shadow: 0 0 5px grey;
                cursor: pointer;
            }

            .dish {
                width: 30%;

                #dishModal {
                    .img-container {
                        width: 100%;
                        img {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                            object-position: center;
                        }
                    }
                    p {
                        padding: 20px 20px 0;
                        text-align: center;
                        word-break: break-all;
                    }
                }
            }
        }

        #cart {
            position: fixed;
            right: 20%;
            width: calc((100% / 5));
            padding: 30px;
            border-radius: 7px;
            box-shadow: 0 0 2px black;
            background-color: rgba($buttonPrimary, 0.6);
            overflow: hidden;

            #checkout {
                padding: 15px 20px;
                border-radius: 7px;
                font-weight: 700;
                background-color: $bgSecondary;
                box-shadow: 0 4px 8px black;
                text-align: center;
                span {
                    color: black;
                    cursor: pointer;
                    &:hover {
                        text-decoration: underline;
                    }
                }
            }

            #checkout-another {
                padding: 15px 20px;
                border-radius: 7px;
                font-weight: 700;
                background-color: $bgSecondary;
                box-shadow: 0 4px 8px black;
                text-align: center;
                position: relative;
                z-index: 100;
                overflow: hidden;
            }

            .layover {
                width: 100%;
                height: 100%;
                top: 0;
                right: 0;
                position: absolute;
                background-color: rgba(0, 0, 0, 0.5);
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

    }
</style>
