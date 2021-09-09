<template>
    <section class="mainCategories container">
        <!-- Questa è la sezione delle categories del main -->
        <!-- <section class="container container-1">
            <div class="comfort"
            v-for="(category,index) in restaurantTypes"
            :key="index">
                <h3 class="content">{{category.name}}</h3>
            </div>
            <p>I grandi classici che scaldano il cuore.</p>
            <a href="#">
                <small>Scopri comfort food</small>
            </a>
        </section> -->
        <section class="container container-1">
            <div class="comfort">
                <h3 class="content">comfort food</h3>
            </div>
            <p>I grandi classici che scaldano il cuore.</p>
            <a href="#">
                <small>Scopri comfort food</small>
            </a>
        </section>
        <section class="container container-2">
            <div class="dessert">
                <h3 class="content">dolci e dessert</h3>
            </div>
            <p>Dolci piaceri per rendere la giornata ancora pi&ugrave; gustosa.</p>
            <a href="#">
                <small>Scopri i nostri dessert</small>
            </a>
        </section>
        <section class="container container-2">
            <div class="shareable">
                <h3 class="content">perfetti da condividere</h3>
            </div>
            <p>Serve una scusa per stare insieme &quest; Ordina dai ristoranti che trasformeranno la tua serata in una vera festa. </p>
            <a href="#">
                <small>Scopri i perfetti da condividere</small>
            </a>
        </section>
        <section class="container container-1">
            <div class="exclusive">
                <h3 class="content">esclusiva deliverboo</h3>
            </div>
            <p>I pi&ugrave; famosi, i pi&ugrave; buoni, i preferiti. Quelli che trovi solo du Deliverboo. </p>
            <a href="#">
                <small>Scopri la nostra esclusiva DeliverBoo</small>
            </a>
        </section>
    </section>
</template>

<script>
export default {
    name: "MainCategories",
    data() {
        return {
            restaurantTypes: []
        };
    },
    // created() {
    //     axios
    //         .get("http://127.0.0.1:8000/api/restaurant-types")
    //         .then(res => {
    //             const categories = res.data.sort(() => 0.5 - Math.random()*4);
    //             const half = Math.ceil(categories.length);

    //             this.restaurantTypes = categories;
                
    //         })
    //         .catch(err => (this.data = []));
    // }
}
</script>

<style lang="scss" scoped>

@import "././resources/sass/_variables";

    .mainCategories {
        display: flex;
        flex-wrap: wrap;
        padding: 30px;
        h1 {
            width: 100%;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            min-height: 100px;
            h3 {
                text-transform: capitalize;
            }
            p {
                margin: 0;
                padding-top: 5px;
            }
            div {
                display: flex;
                flex-wrap: wrap;
                width: 100%;
                // border: 2px solid black;
                    &.comfort {
                        height: 200px;
                        background-image: url('https://wips.plug.it/cips/buonissimo.org/cms/2019/02/ali-pollo-fritte.jpg');
                        background-size: cover;
                            &:hover {
                                cursor: pointer;
                            }
                    }
                    &.dessert {
                        height: 200px;
                        background-image: url('https://www.ladyketo.it/wp-content/uploads/2017/06/keto-waffle-810x535.jpg');
                        background-size: cover;
                        background-position: center;
                            &:hover {
                                cursor: pointer;
                            }
                    }
                    &.shareable {
                        height: 200px;
                        background-image: url('https://www.chewboom.com/wp-content/uploads/2019/12/New-Nachos-Party-Pack-Coming-To-Taco-Bell-On-December-26-2019.jpg');
                        background-size: cover;
                        background-position: center;
                            &:hover {
                                cursor: pointer;
                            }
                    }
                    &.exclusive {
                        height: 200px;
                        background-image: url('https://www.dissapore.com/wp-content/uploads/2019/07/IMG_20190723_135503-1.jpg');
                        background-size: cover;
                        background-position: center;
                            &:hover {
                                cursor: pointer;
                            }
                    }
            }
            a {
                color: $darkGreenFont;
                &:hover {
                    text-decoration: none;
                }
            }
            .content {
                margin: auto;
                color: white;
                font-size: 30px;
                font-weight: 900;
            }
        }
        .container-1 {
            width: 35%;
            padding-bottom: 10px;
        }
        .container-2 {
            width: 60%;
            padding-bottom: 10px;
        }
    }


</style>