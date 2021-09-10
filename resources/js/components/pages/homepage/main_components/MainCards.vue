<template>
    <div class="content">
        <div class="container">
            <router-link
                v-for="restaurant in randomMainRestaurants"
                :key="restaurant.id"
                class="post-it d-flex"
                :to="{ name: 'show', params: { slug: restaurant.slug } }"
            >
                <div>
                    <div class="img-container">
                        <img :src="restaurant.img_path" :alt="restaurant.name" />
                    </div>
                    <p>{{ restaurant.name }}</p>
                </div>
            </router-link>
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
    }
    // methods: {
    //     getRestaurants: function() {
    //         axios
    //             .get('http://127.0.0.1:8000/api/restaurants')
    //             .then(
    //                 res=> {
    //                     this.restaurants = res.data
    //                 }
    //             )
    //             .catch(
    //                 err=>{
    //                     console.log(err);
    //                 }
    //             );
    //     }
    // }
};
</script>

<style lang="scss" scoped>
@import "./resources/sass/_variables";

.content {
    background-color: $bgSecondary;

    .container {
        display: flex;
        flex-wrap: wrap;
        // align-items: center;
        justify-content: center;
        padding: 30px 0;

        .post-it {
            width: calc(100% / 4 - 40px);
            // margin: 30px 20px 40px 20px;
            margin: 20px;

            .img-container {
            width: 100%;
            height: 300px;
            border-radius: 5px;
            overflow: hidden;

                img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
            
            }

            p {
            margin-top: 10px;
            font-weight: bolder;
            font-size: 16px;
            text-transform: capitalize;
            word-break: break-all;
            color: #2D3232;
            }

            p:hover {
                transition: 0.2s;
                cursor: pointer;
            }

        }
        a:hover {
        text-decoration: none;
        }
    }
    
}
</style>
