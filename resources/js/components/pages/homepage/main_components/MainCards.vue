<template>
    <div class="content pt-5 text-center">
        <h2>I nostri ristoranti!</h2>
        <div class="container text-left">
            <div class="row">
                <div
                    class="col-lg-3 col-md-6 col-xs-12"
                    v-for="restaurant in randomMainRestaurants"
                    :key="restaurant.id"
                >
                    <router-link
                        class="post-it"
                        @click.native="scrollTop"
                        :to="{
                            name: 'show',
                            params: { slug: restaurant.slug }
                        }"
                    >
                        <div>
                            <div class="img-container">
                                <img
                                    :src="'/storage/' + restaurant.img_path"
                                    :alt="restaurant.name"
                                />
                            </div>
                            <p class="mt-3">{{ restaurant.name }}</p>
                        </div>
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
            randomMainRestaurants: []
        };
    },
    created: function() {
        // this.getRestaurants();

        axios
            .get("http://127.0.0.1:8000/api/restaurants")
            .then(res => {
                const restaurants = res.data;
                const randomOrder = restaurants.sort(() => 0.5 - Math.random());
                const eightRandom = randomOrder.slice(0, 8);

                this.randomMainRestaurants = eightRandom;
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

        .post-it {
            // width: calc(100% / 4 - 40px);
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

        .post-it:hover,
        a:hover {
            transition: 0.2s;
            transform: scale(1.1);
            text-decoration: none;
        }
        .post-it:hover p {
            color: $buttonPrimary;
            transition: 0.2s;
        }
    }
}

//query fede
@media screen and (max-width: 576px) {
    .content h2 {
        font-size: 24px;
    }
    .content .container .post-it p {
        font-size: 20px;
        margin: 5px 0 !important;
    }
    .post-it:hover,
    a:hover {
        transition: 0.2s;
        transform: scale(0.5);
        text-decoration: none;
    }
}
</style>
