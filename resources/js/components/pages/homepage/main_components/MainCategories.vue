<template>
    <section id="main-categories" class="container d-flex flex-wrap justify-content-between py-4">

        <div class="category text-center my-4"
        v-for="(category, index) in randomMainCategories"
        :key="index">
            <!-- <div class="category-image">
                <img src="" alt="">
            </div> -->
            <div class="content text-center text-uppercase">
                
                <a href="#" class="p-3">
                    <h3>
                        {{ category.name }}
                    </h3>
                </a>
            </div>
        </div>
    </section>
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
                const randomOrder = restaurantTypes.sort(() => 0.5 - Math.random());
                const fourRandom = randomOrder.slice(0, 4);

                this.randomMainCategories = fourRandom;
            })
            .catch(err => {
                console.log(err);
            });
    }
}
</script>

<style lang="scss" scoped>

@import "././resources/sass/_variables";

    #main-categories {
        
        h1 {
            width: 100%;
            color: $bgPrimary;
        }

        .category {
            width: calc(100% / 2 - 30px);
            border: 1px solid black;
            height: 200px;
            position: relative;
            display: inline-block;
            background-color: grey;

            .content {
                display: inline-block;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);

                a {
                    display:block;
                    min-width: 30%;
                    color: white;
                    transition: transform 0.2s;
                    &:hover {
                        transform: scale(1.2);
                    }
                }
            }
        }
    }

</style>