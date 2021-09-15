<template>
    <section>
        <div class="container">
            <h4>Cerchi qualcos'altro?</h4>
            <div class="restaurant-types-container">
                <div class="desktop-categories">
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
                <div class="phone-categories">
                    <span
                        v-for="phoneCategory in phoneTypes"
                        :key="'r-' + phoneCategory.id"
                        class="
                    badge 
                    badge-pill 
                    badge-light
                    btn-secondary"
                    >
                        <router-link
                            :to="{
                                name: 'store',
                                params: { filterFromHome: phoneCategory.id }
                            }"
                        >
                            {{ phoneCategory.name }}
                        </router-link>
                    </span>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "MainSearch",
    data() {
        return {
            restaurantTypes: [],
            phoneTypes: []
        };
    },
    created() {
        axios
            .get("http://127.0.0.1:8000/api/restaurant-types")
            .then(res => {
                const shuffledArray = res.data.sort(() => 0.5 - Math.random());
                const half = Math.ceil(shuffledArray.length / 2);
                const firstHalf = shuffledArray.slice(0, half);

                const randomCategories = res.data.sort(
                    () => 0.5 - Math.random()
                );
                const sixCategories = randomCategories.slice(0, 6);

                this.restaurantTypes = firstHalf;
                this.phoneTypes = sixCategories;
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
        .phone-categories {
            display: none;
        }
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

@media screen and (max-width: 575px) {
    section {
        font-size: 22px;
        text-align: center;
        .restaurant-types-container {
            text-align: center;
            .desktop-categories {
                display: none;
            }
            .phone-categories {
                display: block;
            }
        }
    }
}
</style>
