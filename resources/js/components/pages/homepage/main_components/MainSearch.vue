<template>
    <section>
        <div class="container">
            <h4>Cerchi qualcos'altro?</h4>
            <div class="restaurant-types-container">
                <span
                    v-for="(category, index) in restaurantTypes"
                    :key="index"
                    class="
                    badge 
                    badge-pill 
                    badge-light
                    btn-secondary"
                >
                    <router-link
                        :to="{
                            name: 'store',
                            params: { filterFromHome: category.id }
                        }"
                    >
                        {{ category.name }}
                    </router-link>
                </span>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "MainSearch",
    data() {
        return {
            restaurantTypes: []
        };
    },
    created() {
        axios
            .get("http://127.0.0.1:8000/api/restaurant-types")
            .then(res => {
                const shuffledArray = res.data.sort(() => 0.5 - Math.random());
                const half = Math.ceil(shuffledArray.length / 2);
                const firstHalf = shuffledArray.slice(0, half);

                this.restaurantTypes = firstHalf;
            })
            .catch(err => (this.data = []));
    }
};
</script>

<style lang="scss" scoped>
section {
    padding: 20px 0 35px;
    background-color: #7cc0ad;
    h4 {
        padding: 15px 0;
        font-size: 40px;
        font-weight: 800;
    }
    .restaurant-types-container {
        span {
            margin: 7px 10px;
            padding: 8px 19px;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 4px 8px black;
            transition: transform 0.2s linear;
            a {
                color: unset;
                text-decoration: unset;
            }

            &:hover {
                transform: scale(1.1, 1.1);
            }
        }
    }
}

//query fede
@media screen and (max-width: 575px) {
    section h4 {
        font-size: 22px;
    }
    #main-categories a .content h3 {
        font-size: 20px;
    }
}
</style>
