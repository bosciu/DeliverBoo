<template>
    <div id="show">
        <header>
            <Navbar />
        </header>

        <main>
            <Loading v-if="!isLoaded" />
            <div v-else class="container pt-5">
                <div class="row">
                    <div class="col-md-8 col-12">
                        <div id="hero" class="pt-4">
                            <div class="details">
                                <h1 class="font-weight-bold mb-4">
                                    {{ restaurant.name }}
                                </h1>
                                <div class="img-container rounded mb-3 bt-3">
                                    <img
                                        :src="'/storage/' + restaurant.img_path"
                                        alt=""
                                        class="w-100 h-100"
                                    />
                                </div>

                                <h6
                                    v-for="(category,
                                    index) in restaurant.restaurant_types"
                                    :key="index"
                                    class="badge badge-pill badge-info mr-2"
                                >
                                    {{ category.name }}
                                </h6>

                                <p class="font-weight-bold">
                                    <i class="fas fa-shipping-fast"></i>
                                    {{ restaurant.delivery_price }} &euro;
                                </p>

                                <h6 class="mb-4">
                                    {{ restaurant.address.address }}
                                    {{ restaurant.address.city }}
                                </h6>

                                <div v-if="calendar" class="d-inline-block">
                                    <!-- Button modale calendario -->
                                    <button
                                        type="button"
                                        class="calendar-btn btn d-inline-block"
                                        data-toggle="modal"
                                        data-target="#calendarModal"
                                    >
                                        <i class="far fa-calendar-alt"></i>
                                        Visualizza il calendario
                                    </button>

                                    <!-- Modale calendario -->
                                    <div
                                        class="modal fade"
                                        id="calendarModal"
                                        tabindex="-1"
                                        role="dialog"
                                        aria-labelledby="exampleModalCenterTitle"
                                        aria-hidden="true"
                                    >
                                        <div
                                            class="modal-dialog modal-dialog-centered"
                                            role="document"
                                        >
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5
                                                        class="modal-title"
                                                        id="exampleModalLongTitle"
                                                    >
                                                        Orari apertura e
                                                        chiusura
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
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">
                                                                    Lunedì
                                                                </th>
                                                                <td>
                                                                    {{
                                                                        calendar.mon
                                                                    }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">
                                                                    Martedì
                                                                </th>
                                                                <td>
                                                                    {{
                                                                        calendar.tue
                                                                    }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">
                                                                    Mercoledì
                                                                </th>
                                                                <td>
                                                                    {{
                                                                        calendar.wed
                                                                    }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">
                                                                    Giovedì
                                                                </th>
                                                                <td>
                                                                    {{
                                                                        calendar.thu
                                                                    }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">
                                                                    Venerdì
                                                                </th>
                                                                <td>
                                                                    {{
                                                                        calendar.fri
                                                                    }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">
                                                                    Sabato
                                                                </th>
                                                                <td>
                                                                    {{
                                                                        calendar.sat
                                                                    }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">
                                                                    Domenica
                                                                </th>
                                                                <td>
                                                                    {{
                                                                        calendar.sun
                                                                    }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button
                                                        type="button"
                                                        class="btn"
                                                        data-dismiss="modal"
                                                    >
                                                        Chiudi
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button
                                    v-else
                                    class="calendar-btn btn"
                                    id="no-calendar"
                                    disabled
                                >
                                    Calendario non presente
                                </button>

                                <!-- modale contatto -->

                                <button
                                    data-toggle="modal"
                                    data-target="#contactModal"
                                    type="button"
                                    id="contact"
                                    class="btn"
                                >
                                    <i class="fas fa-info-circle"></i> Contatta
                                    il ristorante
                                </button>

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
                                                    class="modal-title font-weight-bolder"
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
                                                    altre richieste?<br />Contattaci!
                                                </h6>
                                                <p class="font-weight-bolder">
                                                    {{ restaurant.phone }}
                                                </p>
                                            </div>

                                            <div class="modal-footer">
                                                <button
                                                    type="button"
                                                    class="btn"
                                                    data-dismiss="modal"
                                                >
                                                    Chiudi
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- /modale contatto -->
                            </div>
                        </div>
                        <!-- /Hero restaurant -->

                        <!-- menu -->
                        <div class="menu mt-3 pt-2 pb-5">
                            <div
                                v-for="(category,
                                index) in restaurant.dish_categories"
                                :key="index"
                                class="flex-column container"
                            >
                                <h3
                                    class="text-uppercase font-weight-bolder py-2"
                                >
                                    {{ category.name }}
                                </h3>
                                <div class="dish-container row mb-4">
                                    <div
                                        class="dish mb-3 mr-3 col-12 col-md-4"
                                        :class="
                                            category.id == dish.dish_category_id
                                                ? ''
                                                : 'd-none'
                                        "
                                        v-for="(dish, index) in dishes"
                                        :key="index"
                                        @click="setDish(dish)"
                                    >
                                        <div class="card">
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

                                            <div class="layover-plus rounded">
                                                <i class="fas fa-cart-plus"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /menu -->
                    </div>

                    <!-- CARRELLO -->
                    <div class="col-md-4 col-12" id="cart">
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
                                            class="fas fa-minus-circle "
                                            @click="removeItem(orderDish)"
                                        ></i>
                                    </span>
                                    <span>{{ orderDish.quantity }}</span>
                                    <span class="button-container">
                                        <i
                                            class="fas fa-plus-circle"
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
                            <hr v-if="orderDishes.length > 0" />
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
            subTotal: 0,
            calendar: null
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
                    this.calendar = this.restaurant.calendar;
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
                        this.orderDishes[
                            this.orderDishes.length - 1
                        ].delivery_price = this.restaurant.delivery_price;
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
            setTimeout(() => {
                this.isLoaded = true;
            }, 1000);
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
    box-shadow: 0 0 25px 25px $bgPrimary;
}

main {
    .img-container {
        width: 550px;
        height: 300px;
        box-shadow: 0 0 4px black;
        overflow: hidden;

        img {
            object-fit: cover;
            object-position: center;
        }
    }

    #calendarModal {
        td,
        th {
            border-top: 0;
        }

        .modal-content {
            background-color: $bgSecondary;
        }

        .modal-footer {
            button {
                color: $bgSecondary;
                background-color: $darkGreenFont;
            }
        }
    }

    .calendar-btn {
        margin-right: 10px;
        background-color: $buttonSecondary;
        color: white;

        &:hover {
            background-color: #a75c71;
        }
    }

    #no-calendar {
        cursor: not-allowed;

        &:hover {
            background-color: $buttonSecondary;
        }
    }

    #contact {
        background-color: $bgPrimary;
        color: white;

        &:hover {
            background-color: #2aa180;
        }
    }

    #contactModal {
        .modal-content {
            background-color: $bgSecondary;
        }

        p {
            letter-spacing: 2px;
            color: $darkGreenFont;
            text-decoration: underline;
        }

        .modal-footer {
            button {
                color: $bgSecondary;
                background-color: $darkGreenFont;
            }
        }
    }

    .dish-container {
        .card {
            box-shadow: 0 0 5px grey;
            cursor: pointer;

            &:hover .layover-plus {
                opacity: 1;
            }
        }

        .layover-plus {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            background-color: rgba(124, 192, 173, 0.7);
            transition: 0.3s;
            i {
                color: white;
                font-size: 65px;
                position: absolute;
                opacity: 1;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                transition: 0.3s;
            }
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
        position: absolute;
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
                font-size: 15px;
                & > .button-container {
                    display: inline-block;
                    position: relative;

                    i {
                        position: absolute;
                        font-size: 13px;
                        top: 45%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        cursor: pointer;
                        margin: 0 2px;
                    }
                }
            }
            .tot {
                font-size: 14px;
            }
        }
    }
}

@media screen and (max-width: 575px) {
    main {
        tbody {
            text-align: left;

            td {
                font-size: 13px;
            }
        }

        h3 {
            text-align: center;
        }

        .img-container {
            width: 100%;
            height: 200px;
        }

        #cart {
            position: fixed;
            bottom: 0;
            right: 0;
            z-index: 10000;
            width: 100%;
            padding: 15px;
            font-weight: bold;
            background-color: rgba($buttonPrimary, 0.8);
        }

        .details {
            text-align: center;

            .calendar-btn {
                margin-bottom: 10px;
                margin-right: 0;
            }
        }

        .card {
            padding-top: 10px;
            img {
                width: 90%;
                margin: 0 auto;
                height: 100px;
                object-fit: cover;
            }
        }
    }
}
</style>
