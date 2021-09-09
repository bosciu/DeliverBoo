<template>
    <div id="store" v-if="!loading">
        <header>
            <Navbar />
        </header>
        <main class="pt-5 d-flex">
            <aside>
                <div id="searchbar" class="w-100 d-flex justify-content-around">
                    <div class="p-4 d-flex justify-content-around rounded">
                        <form class="form-inline justify-content-center">
                            <input
                                class="form-control mr-sm-3 w-75"
                                type="search"
                                placeholder="Cerca"
                                aria-label="Search"
                            />
                        </form>
                    </div>
                </div>
                <div class="list-container pl-4">
                    <div class="delivery pt-3 ml-3">
                        <ul>
                            <li>
                                <input
                                    type="checkbox"
                                    aria-label="Checkbox for following text input"
                                    class="mr-2"
                                />
                                Consegna <i class="fas fa-bicycle"></i>
                            </li>
                            <li>
                                <input
                                    type="checkbox"
                                    aria-label="Checkbox for following text input"
                                    class="mr-2"
                                />
                                Ritiro <i class="fas fa-people-carry"></i>
                            </li>
                        </ul>
                    </div>
                    <div class="veg pt-3 ml-3">
                        <ul>
                            <li>
                                <input
                                    type="checkbox"
                                    aria-label="Checkbox for following text input"
                                    class="mr-2"
                                />
                                Vegetariano <i class="fas fa-seedling"></i>
                            </li>
                            <li>
                                <input
                                    type="checkbox"
                                    aria-label="Checkbox for following text input"
                                    class="mr-2"
                                />
                                Vegano <i class="fas fa-seedling"></i>
                            </li>
                        </ul>
                    </div>
                    <div class="categories pt-3">
                        <h3>
                            CATEGORIE <i class="fas fa-chevron-down ml-3"></i>
                        </h3>
                        <ul class="overflow-auto mt-3">
                            <li
                                v-for="category in categories"
                                :key="category.name"
                            >
                                <a href="#">{{ category.name }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
            <section class="pl-5 pr-5">
                <h2 class="ml-4 mb-5 mt-4">Ristoranti</h2>
                <div
                    id="card-container"
                    class="w-100 d-flex flex-wrap justify-content-center"
                >
                    <div
                        v-for="(restaurant, index) in restaurants"
                        :key="index"
                        class="card mt-3 ml-2"
                    >
                        <div class="img-container p-1">
                            <img
                                :src="'/storage/' + restaurant.img_path"
                                alt=""
                                class="img-fluid rounded"
                            />
                        </div>
                        <div class="info mt-3">
                            <span>Roma</span>
                            <h4>{{ restaurant.name }}</h4>
                            <span v-if="restaurant.free_delivery == 1"
                                >Consegna gratuita</span
                            >
                            <span v-else
                                >Prezzo Consegna: &euro;
                                {{ restaurant.delivery_price }}</span
                            >
                        </div>
                    </div>
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
            restaurants: null
        };
    },
    created: function() {
        this.getCategories();

        setTimeout(() => {
            this.loading = false;
        }, 1000);

        this.getRestaurants();
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
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

<style lang="scss" scoped>
@import "./resources/sass/_variables";

main {
    min-height: calc(100vh - 415px);
    padding-bottom: 20px;
    aside {
        width: 20%;
        .list-container {
            .categories,
            .veg,
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
                    input {
                        cursor: pointer;
                    }

                    a {
                        color: rgb(61, 59, 59);
                    }

                    a:hover {
                        text-decoration: none;
                        transition: 0.1s;
                        text-transform: uppercase;
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

        .card {
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            width: 250px;
            height: 300px;
            margin: 20px;
            padding: 10px;
            background-color: rgb(123, 199, 176);

            .img-container {
                width: 100%;
                height: 60%;

                img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
            }
        }
    }
}
</style>
