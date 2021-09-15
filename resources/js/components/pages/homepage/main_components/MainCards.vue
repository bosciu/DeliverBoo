<template>
    <div class="content pt-5 text-center">
        <h2>I nostri ristoranti!</h2>
        <div class="container text-left">
            <div class="row">
                <div
                    id="restaurant-desktop"
                    class="col-lg-3 col-md-6 col-xs-12 restaurant-card mb-2"
                    v-for="(restaurant, index) in randomMainRestaurants"
                    :key="index"
                >
                    <router-link
                        class="post-it"
                        @click.native="scrollTop"
                        :to="{
                            name: 'show',
                            params: { slug: restaurant.slug }
                        }"
                    >
                        <div class="img-container">
                            <img
                                :src="'/storage/' + restaurant.img_path"
                                :alt="restaurant.name"
                            />
                        </div>
                        <p class="mt-3">{{ restaurant.name }}</p>
                    </router-link>
                </div>

                <div
                    id="restaurant-phone"
                    class="col-lg-3 col-md-6 col-xs-12 restaurant-card mb-2"
                    v-for="restaurant in randomRestaurantsPhone"
                    :key="'r-' + restaurant.id"
                >
                    <router-link
                        class="post-it"
                        @click.native="scrollTop"
                        :to="{
                            name: 'show',
                            params: { slug: restaurant.slug }
                        }"
                    >
                        <div class="img-container">
                            <img
                                :src="'/storage/' + restaurant.img_path"
                                :alt="restaurant.name"
                            />
                        </div>
                        <p class="mt-3">{{ restaurant.name }}</p>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "MainCards",
    data: function() {
        return {
            restaurants: [],
            randomMainRestaurants: [],
            randomRestaurantsPhone: []
        };
    },
    created: function() {
        axios
            .get("http://127.0.0.1:8000/api/restaurants")
            .then(res => {
                const restaurants = res.data;
                const randomOrder = restaurants.sort(() => 0.5 - Math.random());
                const fourRandom = randomOrder.slice(0, 4);
                const eightRandom = randomOrder.slice(0, 8);

                this.randomMainRestaurants = eightRandom;
                this.randomRestaurantsPhone = fourRandom;
            })
            .catch(err => {
                console.log(err);
            });
    },
    methods:{
        scrollTop(){
            document.getElementById("show").scrollIntoView();
        }
    }
};
</script>

<style lang="scss" scoped>
@import "./resources/sass/_variables";

.content {
    background-color: $bgSecondary;

    h2 {
        font-size: 40px;
        font-weight: bolder;
    }

    .container {
        padding: 30px 0;
        #restaurant-desktop {
            transition: 0.2s;
        }
        .restaurant-card {
            .post-it {
                margin-bottom: 20px;

                .img-container {
                    width: 100%;
                    height: 300px;
                    border-radius: 5px;
                    overflow: hidden;
                    box-shadow: 0 0 2px black;

                    img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }
                }

                p {
                    font-weight: bolder;
                    font-size: 18px;
                    text-transform: capitalize;
                    word-break: break-all;
                    color: #2d3232;
                }
            }
        }
        #restaurant-desktop:hover,
        a:hover {
            transform: scale(1.1);
            text-decoration: none;
        }
        .post-it:hover p {
            color: $buttonPrimary;
            transition: 0.2s;
        }

        #restaurant-phone {
            display: none;
        }
    }
}

//query fede
@media screen and (max-width: 575px) {
    .content {
        padding: 0 15px;
        margin: auto;
        padding-top: 2rem !important;
            h2 {
                font-size: 22px;
            }
            .container {
                padding: 15px 0;
                .post-it p {
                    font-size: 16px;
                }
                .restaurant-card:hover {
                    transform: none;
                }
                .restaurant-card:hover a {
                    color: $buttonPrimary;
                }
                #restaurant-desktop {
                    display: none;
                }
                #restaurant-phone {
                    display: block;
                }
            }        
    }
}
</style>
