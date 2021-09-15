<template>
    <nav class="navbar navbar-expand-lg ">
        <section>
            <div>
                <router-link
                    id="logo"
                    tag="img"
                    :to="{ name: 'home' }"
                    src="/images/logos/logo-dark.png"
                    alt="logo"
                    class=" rounded-circle">
                </router-link>
            </div>
            <section id="menu">
                <li id="cart" class="btn mr-2" v-if="haveOrders">
                    <router-link
                        :to="{
                            name: 'show',
                            params: { slug: orderDishes[0].slug }
                        }"
                    >
                        <i class="fas fa-shopping-cart mr-1 ml-1"></i>
                        <span class="pr-1">&euro; {{ sum }}</span>
                    </router-link>
                </li>

                <li id="cart" class="btn mr-2 " v-else>
                    <i class="fas fa-shopping-cart ml-1"></i>
                    <span>&euro; {{ sum }}</span>
                </li>
                <button id="button_menu" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <h2>MENU</h2>
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse" id="navbarScroll">
                    <ul id="navbar" class="navbar-nav mr-auto my-2 my-lg-0" style="max-height: 100px;">
                        <li class="dropdown btn mr-2">
                            <div
                                class="dropdown-menu p-0 mt-2"
                                aria-labelledby="navbarDropdown"
                            >
                                <a class="dropdown-item dropdown-link" href="/login"
                                    >ACCEDI</a
                                >
                                <a
                                    class="dropdown-item dropdown-link"
                                    id="register"
                                    href="/register"
                                    >REGISTRATI</a
                                >
                            </div>
                        </li>
                        <li class="btn mr-2">
                        <router-link class="white" :to="{ name: 'store' }">
                            <i class="fas fa-utensils wh"></i>
                            RISTORANTI</router-link
                        >
                        </li>
                    </ul>
                </div>

            </section>

        </section>
    </nav>
</template>

<script>
export default {
    nme: "NvbrResponsive"
};
</script>

<style scoped lang="scss">
@import "./resources/sass/_variables";
    
    nav {
        // height: 92px;
        wh {
            color: white;
        }
        section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            div {
                // height: 92px;
                display: inline-block;
            }
            #logo {
                height: 92px;
            }
            #menu {
                display: flex;
                flex-wrap: wrap;

                #button_menu {
                    display: flex;
                    flex-wrap: wrap;
                    text-align: right;
                    height: 40px;
                    color: white; 
                    border: 1px solid white;
                    background-color: $darkGreenFont;

                    h2 {
                        font-size: 13px;
                        margin: auto; 
                        text-align: center;
                    }
                }
                #navbarScroll{
                    color: white;
                    text-align: right;
                    border: 1px solid white;
                    padding-bottom: 30px;   
                    a {
                        text-align: center;
                        font-size: 12px;
                    }                 
                }
            }
            
        }
    }

</style>
