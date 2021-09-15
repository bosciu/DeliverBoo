<template>
    <div class="text-center pt-5 pb-5">
        <h2>Scegli la tua categoria preferita!</h2>
        <section id="main-categories" class="container py-4">
            <div class="row">
                <div
                    class="col-12 col-md-6"
                    v-for="(category, index) in randomMainCategories"
                    :key="index"
                >
                    <router-link
                        :to="{
                            name: 'store',
                            params: { filterFromHome: category.id }
                        }"
                        class="text-center my-4"
                    >
                        <div class="category-image">
                            <img :src="category.img_path" alt="" />
                        </div>

                        <div class="layover"></div>

                        <div
                            class="content text-uppercase d-flex align-items-center justify-content-center"
                        >
                            <h3>
                                {{ category.name }}
                            </h3>
                        </div>
                    </router-link>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    name: "MainCategories",
    data() {
        return {
            randomMainCategories: []
        };
    },
    created() {
        axios
            .get("http://127.0.0.1:8000/api/restaurant-types")
            .then(res => {
                const restaurantTypes = res.data;
                const randomOrder = restaurantTypes.sort(
                    () => 0.5 - Math.random()
                );
                const fourRandom = randomOrder.slice(0, 4);

                this.randomMainCategories = fourRandom;
            })
            .catch(err => {
                console.log(err);
            });
    }
};
</script>

<style lang="scss" scoped>
@import "././resources/sass/_variables";

h2 {
    font-size: 40px;
    font-weight: bolder;
}

#main-categories {
    a {
        // width: calc(100% / 2 - 30px);
        display: block;
        height: 200px;
        color: white;
        position: relative;
        box-shadow: 0 0 5px black;
        overflow: hidden;
        border-radius: 5px;

        &:hover .content {
            transform: scale(1.2);
        }

        .category-image {
            width: 100%;
            height: 100%;

            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center;
                filter: blur(1px);
            }
        }

        .layover {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background-color: black;
            opacity: 0.7;
        }

        .content {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            display: inline-block;
            transition: transform 0.2s;
            h3 {
                font-size: 30px;
                font-weight: 700;
                letter-spacing: 4px;
            }
        }
    }
}

//query fede
@media screen and (max-width: 575px) {
    div 
    div.text-center {
        padding-top: 2rem !important;
        padding-bottom: 0rem !important;
            h2 {
                font-size: 22px;
            }
            #main-categories {
                padding-top: 0 !important;
                a .content h3 {
                    font-size: 20px;
                }
            }
    }
    
}
</style>
