<template>
    <div id="store" v-if="!loading">
        <header>
            <Navbar />
        </header>
        <main class="pt-5 d-flex">
            <aside>
                <div class="list-container pl-4">
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
                                    Ritiro <i class="fas fa-people-carry"></i>
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
            <section class="px-5 mr-5">
                <h2 class="my-4">Ristoranti</h2>

                <h4 v-if="filteredRestaurants.length == 0">
                    Non ci sono ristoranti in questa categoria
                </h4>

                <div class="w-100 d-flex flex-wrap" v-else>
                    <router-link
                        v-for="(restaurant, index) in filteredRestaurants"
                        :key="index"
                        class="card restaurant mb-4 mr-4"
                        :to="{
                            name: 'show',
                            params: { slug: restaurant.slug }
                        }"
                    >
                        <div class="img-container">
                            <img
                                :src="restaurant.img_path"
                                alt=""
                                class="rounded"
                            />
                        </div>

                        <div class="card-body mt-3">
                            <span class="card-text">Milano</span>
                            <h4 class="card-title">{{ restaurant.name }}</h4>
                            <span v-if="restaurant.free_delivery == 1"
                                >Consegna gratuita</span
                            >
                            <span v-else
                                >Prezzo Consegna:
                                {{ restaurant.delivery_price }} &euro;</span
                            >
                        </div>
                    </router-link>
                </div>
            </section>
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
        checkFunction(category) {
            if (category.id == this.filterFromHome) {
                return true;
            }
            if (
                this.takeAwayFilter == true ||
                this.freeDeliveryFilter == true
            ) {
                return false;
            }
        }
    }
};
</script>

<style lang="scss" scoped>
@import "./resources/sass/_variables";

main {
    a {
        color: unset;
        text-decoration: unset;
    }

    min-height: calc(100vh - 415px);
    padding-bottom: 20px;

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
                    input:hover,
                    label:hover {
                        cursor: pointer;
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
        width: 80%;

        .restaurant {
            width: calc((100% / 4) - 30px);
            padding: 2px;
            box-shadow: 0 0 5px grey;

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
}
</style>
