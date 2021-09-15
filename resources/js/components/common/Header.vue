<template>
    <header class="w-100">
        <div class="container">
            <Navbar />
            <section
                id="jumbotron"
                class="d-flex align-items-center"
                :class="searchedRestaurants.length > 1 ? 'dropVisible' : ''"
            >
                <!-- carousel -->

                <div
                    id="carouselExampleControls"
                    class="carousel slide w-50 mb-5 rounded"
                    data-ride="carousel"
                >
                    <div class="carousel-inner rounded">
                        <div class="carousel-item active rounded">
                            <router-link
                                :to="{
                                    name: 'show',
                                    params: {
                                        slug: randomHeaderRestaurants[0].slug
                                    }
                                }"
                            >
                                <div class="layover"></div>

                                <h2>{{ randomHeaderRestaurants[0].name }}</h2>
                                <img
                                    class="d-block w-100 rounded"
                                    :src="
                                        '/storage/' +
                                            randomHeaderRestaurants[0].img_path
                                    "
                                    alt=""
                                />
                            </router-link>
                        </div>
                        <div class="carousel-item rounded">
                            <router-link
                                :to="{
                                    name: 'show',
                                    params: {
                                        slug: randomHeaderRestaurants[1].slug
                                    }
                                }"
                            >
                                <div class="layover"></div>
                                <h2>{{ randomHeaderRestaurants[1].name }}</h2>
                                <img
                                    class="d-block w-100"
                                    :src="
                                        '/storage/' +
                                            randomHeaderRestaurants[1].img_path
                                    "
                                    alt=""
                                />
                            </router-link>
                        </div>
                        <div class="carousel-item rounded">
                            <router-link
                                :to="{
                                    name: 'show',
                                    params: {
                                        slug: randomHeaderRestaurants[2].slug
                                    }
                                }"
                            >
                                <div class="layover"></div>
                                <h2>{{ randomHeaderRestaurants[2].name }}</h2>
                                <img
                                    class="d-block w-100"
                                    :src="
                                        '/storage/' +
                                            randomHeaderRestaurants[2].img_path
                                    "
                                    alt=""
                                />
                            </router-link>
                        </div>
                    </div>
                    <a
                        class="carousel-control-prev"
                        href="#carouselExampleControls"
                        role="button"
                        data-slide="prev"
                    >
                        <span
                            class="carousel-control-prev-icon"
                            aria-hidden="true"
                        ></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a
                        class="carousel-control-next"
                        href="#carouselExampleControls"
                        role="button"
                        data-slide="next"
                    >
                        <span
                            class="carousel-control-next-icon"
                            aria-hidden="true"
                        ></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <!-- searchbar -->

                <div id="searchbar" class="w-50 d-flex">
                    <div class="w-75 p-4 d-flex justify-content-around rounded">
                        <form
                            class="form-inline justify-center"
                            v-if="searchedRestaurants.length == 1"
                            :action="searchedRestaurants[0].slug"
                        >
                            <label for="" class="mb-2"
                                >Cerca il ristorante!
                                <i class="fas fa-arrow-circle-down ml-2"></i
                            ></label>
                            <input
                                class="form-control mr-sm-3 w-100"
                                type="search"
                                placeholder="Cerca"
                                aria-label="Search"
                                v-model="queryString"
                            />
                        </form>
                        <form
                            @submit.prevent
                            class="form-inline justify-center"
                            v-else-if="searchedRestaurants.length > 1"
                        >
                            <label for="" class="mb-2"
                                >Cerca il ristorante!
                                <i class="fas fa-arrow-circle-down ml-2"></i
                            ></label>
                            <input
                                class="form-control mr-sm-3 w-100"
                                type="search"
                                placeholder="Cerca"
                                aria-label="Search"
                                v-model="queryString"
                            />
                        </form>
                        <form
                            class="form-inline justify-center"
                            v-else-if="searchedRestaurants.length < 1"
                            @submit.prevent
                        >
                            <label for="" class="mb-2"
                                >Cerca il ristorante!
                                <i class="fas fa-arrow-circle-down ml-2"></i
                            ></label>
                            <input
                                class="form-control mr-sm-3 w-100"
                                type="search"
                                placeholder="Cerca"
                                aria-label="Search"
                                v-model="queryString"
                            />
                        </form>
                    </div>
                    <transition name="fade">
                        <div
                            class="my-drop overflow-auto"
                            v-if="queryString != ''"
                        >
                            <table
                                class="table-dark table"
                                v-if="searchedRestaurants.length > 0"
                            >
                                <tbody>
                                    <tr
                                        v-for="searchRestaurant in searchedRestaurants"
                                        :key="searchRestaurant.id"
                                        class="py-1"
                                    >
                                        <td scope="row">
                                            <div class="img-container">
                                                <img
                                                    :src="
                                                        '/storage/' +
                                                            searchRestaurant.img_path
                                                    "
                                                    :alt="searchRestaurant.name"
                                                />
                                            </div>
                                        </td>
                                        <td>{{ searchRestaurant.name }}</td>
                                        <td>
                                            <router-link
                                                class="btn btn-primary"
                                                :to="{
                                                    name: 'show',
                                                    params: {
                                                        slug:
                                                            searchRestaurant.slug
                                                    }
                                                }"
                                            >
                                                Apri
                                            </router-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table v-else class="table-dark table">
                                <tbody>
                                    <tr>
                                        <td>
                                            La ricerca non ha prodotto
                                            risultati.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </transition>
                </div>
            </section>
        </div>
    </header>
</template>

<script>
import Navbar from "./Navbar";
export default {
    name: "Header",
    components: {
        Navbar
    },
    data: function() {
        return {
            restaurants: [],
            randomHeaderRestaurants: [],
            searchedRestaurants: [],
            queryString: ""
        };
    },
    created: function() {
        axios
            .get("http://127.0.0.1:8000/api/restaurants")
            .then(res => {
                const restaurants = res.data;
                const randomOrder = restaurants.sort(() => 0.5 - Math.random());
                const threeRandom = randomOrder.slice(0, 3);

                this.randomHeaderRestaurants = threeRandom;
            })
            .catch(err => {
                console.log(err);
            });
    },
    watch: {
        queryString() {
            console.log("Quesry fatta");
            axios
                .post("http://127.0.0.1:8000/api/search-restaurants", {
                    query: this.queryString
                })
                .then(res => {
                    console.log(res.data);
                    this.searchedRestaurants = res.data;
                })
                .catch(err => console.log(err));
        }
    }
};
</script>

<style lang="scss" scoped>
@import "./resources/sass/_variables";
header {
    background-color: #7cc0ad;
    background-image: url("/images/sfondo.png");
    background-size: contain;
    background-position: right;
    background-repeat: no-repeat;

    #jumbotron {
        margin-top: 100px;
        transition: all 0.3s;
        &.dropVisible {
            padding-bottom: 100px;
        }

        #carouselExampleControls {
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.9);
            overflow: hidden;

            a {
                text-transform: uppercase;
                color: white;
                text-align: center;
                &:hover h2 {
                    color: rgba(255, 255, 255, 0.8);
                }

                h2 {
                    font-weight: bolder;
                    letter-spacing: 4px;
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    transition: color 0.2s;
                }
                img {
                    height: 300px;
                    object-fit: cover;
                    object-position: center;
                }
            }
        }

        .layover {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background-color: black;
            opacity: 0.4;
        }

        #searchbar {
            .fade-enter-active,
            .fade-leave-active {
                transition: opacity 0.5s;
            }
            .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
                opacity: 0;
            }
            position: relative;
            justify-content: flex-end;
            div {
                background-color: white;
                border: 1px solid rgb(158, 156, 156);

                label {
                    font-weight: bolder;
                }

                button {
                    background-color: $bgSecondary;
                    border: 2px solid $darkGreenFont;
                    font-weight: bold;
                    color: #41b3a3;
                }

                i {
                    color: #41b3a3;
                }
            }
            .my-drop {
                position: absolute;
                z-index: 100;
                top: 110%;
                width: 75%;
                max-height: 200px;
                background-color: rgba(0, 0, 0, 0.8);
                color: white;

                table {
                    margin-bottom: 0;
                    tr {
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        td {
                            border: unset;
                            .img-container {
                                width: 60px;
                                height: 60px;
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
            }
        }
    }
}

//query fede

@media screen and (max-width: 575px) {
    header {
        padding-bottom: 50px;
        #jumbotron {
            margin-top: 20px;
            flex-flow: column;
            #carouselExampleControls,
            .layover {
                width: 300px !important;
                height: 200px;
                a h2 {
                    font-size: 18px;
                    position: absolute;
                    // top: 50%;
                    // left: 50%;
                    // transform: translate(-50%,-50%);
                    top: 35%;
                }
            }
            #searchbar {
                justify-content: center;
                .my-drop {
                    max-height: 120px;
                }
                .my-drop table tr td {
                    font-size: 14px;
                    padding: 8px;
                    .btn {
                        padding: 5px;
                    }
                }
                .img-container {
                    width: 60px !important;
                }
                div {
                    width: 300px !important;
                    .form-inline {
                        width: 300px !important;
                    }
                    label {
                        font-size: 16px;
                    }
                }
            }
        }
    }
}
</style>
