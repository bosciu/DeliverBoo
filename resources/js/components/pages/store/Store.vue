<template>
    <div id="store">
        <header >
            <Navbar />
        </header>
        <main class="pt-5 d-flex">
            <aside>
                <div id="searchbar" class="w-100 d-flex justify-content-around">
                    <div class="p-4 d-flex justify-content-around rounded">
                        <form class="form-inline justify-content-center">
                            <input class="form-control mr-sm-3 w-75" type="search" placeholder="Cerca" aria-label="Search">
                        </form> 
                    </div>   
                </div>
                <div class="list-container pl-4">
                    <div class="categories pt-3">
                        <h3>CATEGORIE <i class="fas fa-chevron-up ml-3"></i></h3>
                        <ul>
                            <!-- <li v-for="(category,index) in categories" :key="index">
                                {{category.name}}
                            </li> -->
                            <li>pesce</li>
                            <li>carne</li>
                            <li>verdure</li>
                        </ul>
                    </div>
                    <div class="diet pt-3">
                        <h3>REGIMI ALIMENTARI <i class="fas fa-chevron-up ml-3"></i></h3>
                        <ul>
                            <!-- <li v-for="(category,index) in categories" :key="index">
                                {{category.name}}
                            </li> -->
                            <li>veg</li>
                            <li>vegetariano</li>
                        </ul>
                    </div>
                </div>
            </aside>
            <section class="pl-5 pr-5">  
                <h2 class="ml-3 mb-5 mt-4">Ristoranti</h2>
                <div id="card-container" class="w-100 h-100 d-flex flex-wrap justify-content-around">
                    <div v-for="card in 5" :key="card" class="card"></div>
                </div> 
            </section>
        </main>
    </div>
</template>

<script>
import Navbar from "../../common/Navbar";
export default {
    name: "Store",
    components: {
        Navbar
    },
    methods: {
        getCategories: function() {
            axios
                .get('')
                .then(
                    res => {
                        this.categories = res.data;
                    }
                )
                .catch();
        }
    }
}
</script>

<style lang="scss" scoped>
@import "./resources/sass/_variables";

    main {
        height: 600px;

        aside {
            width: 20%;
            .list-container{
                .categories,.diet{
                    margin: 0 10px;
                    border-top: 2px solid rgb(240, 235, 235);
                }
                h3 {
                    font-size: 16px;
                    font-weight: bold;

                }

                i {
                    color: $darkGreenFont;
                }

                ul {
                    list-style: none;
                    padding-left: 0;
                }
            }
        }

        section {
            width: 80%;

            .card {
                width: 200px;
                height: 150px;
                background-color: rgb(123, 199, 176);
            }
        }
    }
</style>
