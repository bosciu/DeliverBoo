<template>
    <div id="store" v-if="!loading">
        <header>
            <Navbar />
        </header>
        <main class="pt-5 container">
            <div class="row">
                <aside class="pt-3 col-12 col-md-3">
                    <div class="list-container">
                        <div class="delivery pt-3 ml-3">
                            <ul>
                                <li>
                                    <input
                                        type="checkbox"
                                        class="mr-2"
                                        id="free-delivery"
                                        v-model="freeDeliveryFilter"
                                        @change="freeDelivery"
                                    />
                                    <label for="free-delivery">
                                        Consegna gratuita
                                        <i class="fas fa-bicycle"></i>
                                    </label>
                                </li>

                                <li>
                                    <input
                                        type="checkbox"
                                        class="mr-2"
                                        id="take-away"
                                        v-model="takeAwayFilter"
                                        @change="takeAway"
                                    />
                                    <label for="take-away">
                                        Ritiro
                                        <i class="fas fa-people-carry"></i>
                                    </label>
                                </li>
                            </ul>
                        </div>

                        <div class="categories pt-3">
                            <h3>
                                CATEGORIE
                            </h3>
                            <ul class="overflow-auto mt-3">
                                <li
                                    v-for="category in categories"
                                    :key="category.name"
                                >
                                    <!-- :checked="filter.includes(category.id)" -->
                                    <input
                                        type="checkbox"
                                        :id="category.name"
                                        :checked="checkFunction(category)"
                                        @change="setFilter(category)"
                                    />
                                    <label :for="category.name">
                                        {{ category.name }}
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </aside>
                <section class="col-12 col-md-9">
                    <h2 class="my-4 font-weight-bolder">I nostri ristoranti</h2>

                    <h4 v-if="filteredRestaurants.length == 0">
                        Non ci sono ristoranti in questa categoria.
                    </h4>

                    <div class="row" v-else>
                        <router-link
                            v-for="(restaurant, index) in filteredRestaurants"
                            :key="index"
                            @click.native="scrollTop"
                            class=" col-10 col-md-4 mb-4"
                            :to="{
                                name: 'show',
                                params: { slug: restaurant.slug }
                            }"
                        >
                            <div class="card restaurant h-100">
                                <div class="img-container">
                                    <img
                                        :src="'/storage/' + restaurant.img_path"
                                        alt=""
                                        class="rounded"
                                    />
                                </div>

                                <div class="card-body mt-3">
                                    <h6 class="card-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                        Milano
                                    </h6>
                                    <h4 class="card-title font-weight-bolder">
                                        {{ restaurant.name }}
                                    </h4>
                                    <span v-if="restaurant.free_delivery == 1"
                                        ><i class="fas fa-tag"></i> Consegna
                                        gratuita</span
                                    >
                                    <span
                                        v-else
                                        id="delivery-price"
                                        class="font-weight-bolder"
                                        ><i class="fas fa-tag"></i> Prezzo
                                        Consegna:
                                        {{ restaurant.delivery_price }}
                                        &euro;</span
                                    >
                                </div>
                            </div>
                        </router-link>
                    </div>
                </section>
            </div>
        </main>
        <Footer />
    </div>
    <Loading v-else />
</template>

<script>
import Navbar from "../../common/Navbar";
import Loading from "../../common/Loading";
import Footer from "../../common/Footer";

export default {
    name: "Store",
    components: {
        Navbar,
        Loading,
        Footer
    },
    data: function() {
        return {
            categories: null,
            loading: true,
            restaurants: null,
            filteredRestaurants: [],
            filter: [],
            takeAwayFilter: false,
            freeDeliveryFilter: false,
            counterTest: 0,
            isChecked: false,
            firstFilterSelected: false
        };
    },
    props: ["filterFromHome"],
    created: function() {
        this.getCategories();

        setTimeout(() => {
            this.loading = false;
        }, 1000);

        this.getRestaurants();
        if (this.filterFromHome) {
            this.filteredRestaurant = [];
        }
    },
    computed: {},
    watch: {
        filter() {
            this.filteredRestaurants = [];
            this.restaurants.forEach(restaurant => {
                this.filter.forEach(singleFilter => {
                    if (restaurant.restaurant_types.includes(singleFilter)) {
                        let finded = false;
                        this.filteredRestaurants.forEach(filteredRestaurant => {
                            if (filteredRestaurant.id == restaurant.id) {
                                finded = true;
                            }
                        });
                        if (!finded) {
                            this.filteredRestaurants.push(restaurant);
                        }
                    }
                });
            });
            if (this.filter.length == 0) {
                this.filteredRestaurants = this.restaurants;
            }
        }
    },

    methods: {
        getCategories: function() {
            axios
                .get("http://127.0.0.1:8000/api/restaurant-types")
                .then(res => {
                    this.categories = res.data;
                })
                .catch();
        },
        getRestaurants: function() {
            axios
                .get("http://127.0.0.1:8000/api/restaurants")
                .then(res => {
                    this.restaurants = res.data;
                    if (this.filterFromHome) {
                        this.restaurants.forEach(restaurant => {
                            if (
                                restaurant.restaurant_types.includes(
                                    this.filterFromHome
                                )
                            ) {
                                this.filteredRestaurants.push(restaurant);
                            }
                        });
                    } else {
                        this.filteredRestaurants = res.data;
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        },
        setFilter: function(category) {
            this.freeDeliveryFilter = false;
            this.takeAwayFilter = false;
            if (
                this.filterFromHome &&
                this.counterTest == 0 &&
                this.filterFromHome == category.id
            ) {
                this.filteredRestaurants = this.restaurants;
                this.counterTest++;
            } else if (
                this.filterFromHome &&
                this.counterTest == 0 &&
                this.filterFromHome != category.id
            ) {
                this.filter.push(this.filterFromHome, category.id);
                this.counterTest++;
            } else {
                if (!this.filter.includes(category.id)) {
                    this.filter.push(category.id);
                } else {
                    let index = this.filter.indexOf(category.id);
                    this.filter.splice(index, 1);
                }
            }
        },
        takeAway() {
            if (this.filter.length > 0) {
                while (this.filter.length > 0) {
                    this.filter.pop();
                }
            }
            this.freeDeliveryFilter = false;
            this.filteredRestaurants = [];
            if (this.takeAwayFilter) {
                this.restaurants.forEach(restaurant => {
                    if (restaurant.take_away) {
                        this.filteredRestaurants.push(restaurant);
                    }
                });
            } else {
                this.filteredRestaurants = this.restaurants;
            }
            this.firstFilterSelected = true;
        },
        freeDelivery() {
            if (this.filter.length > 0) {
                while (this.filter.length > 0) {
                    this.filter.pop();
                }
            }
            this.takeAwayFilter = false;
            this.filteredRestaurants = [];
            if (this.freeDeliveryFilter) {
                this.restaurants.forEach(restaurant => {
                    if (restaurant.free_delivery) {
                        this.filteredRestaurants.push(restaurant);
                    }
                });
            } else {
                this.filteredRestaurants = this.restaurants;
            }
            this.firstFilterSelected = true;
        },
        checkFunction(category, bool) {
            if (bool == false) {
            }
            if (
                this.filter.includes(category.id) ||
                this.filterFromHome == category.id
            ) {
                return true;
            }
            /* if (category.id == this.filterFromHome) {
                return true;
            }
            if (
                this.takeAwayFilter == true ||
                this.freeDeliveryFilter == true
            ) {
                return false;
            } */
        },
        scrollTop() {
            document.getElementById("show").scrollIntoView();
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
    min-height: calc(100vh - 425px);
    padding-bottom: 20px;

    a {
        color: unset;
        text-decoration: unset;
    }

    aside {
        width: 20%;
        .list-container {
            .categories,
            .delivery {
                margin: 0 10px;
                border-top: 2px solid rgb(240, 235, 235);
            }

            h3 {
                font-size: 16px;
                font-weight: bold;
            }

            i {
                color: $darkGreenFont;
                margin-left: 5px;
            }

            ul {
                list-style: none;
                padding-left: 0;

                li {
                    label {
                        border-radius: 100px;
                        padding: 1px 5px;
                        transition: 0.1s;
                    }

                    input:hover,
                    label:hover {
                        cursor: pointer;
                        background-color: $bgPrimary;
                        color: white;
                        i {
                            color: white;
                        }
                    }
                }
            }

            .delivery i {
                color: $buttonSecondary;
            }

            .categories ul {
                height: 500px;
            }
        }
    }
    section {
        .restaurant {
            padding: 2px;
            box-shadow: 0 0 5px grey;

            &:hover {
                h4 {
                    color: $darkGreenFont;
                }
            }

            span {
                color: $buttonPrimary;
                i {
                    transform: rotate(90deg);
                }
            }
        }

        #delivery-price {
            font-size: 14px;
        }

        .img-container {
            width: 100%;
            height: 150px;
            padding: 5px;

            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center;
            }
        }
    }
}

@media screen and (max-width: 576px) {
    main {
        aside {
            .list-container {
                .categories ul {
                    height: 150px;
                }
            }
            .list-container {
                ul {
                    li {
                        input:hover,
                        label:hover {
                            cursor: pointer;
                            background-color: unset;
                            color: unset;
                            i {
                                color: #c48d9d;
                            }
                        }
                    }
                }
            }
        }

        section {
            h2 {
                text-align: center;
            }
            .row {
                justify-content: center;
            }
        }
    }
}
</style>
