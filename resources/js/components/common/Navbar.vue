<template>
    <div id="navbar-container" class="w-100">
        <section
            id="navbar"
            class="w-100 justify-content-between align-center container pb-3"
        >
            <div id="logo" class="w-50 h-100">
                <router-link
                    tag="img"
                    :to="{ name: 'home' }"
                    src="/images/logos/logo-dark.png"
                    alt="logo"
                    class=" rounded-circle"
                >
                </router-link>
            </div>
            <div id="list" class="w-50 h-100">
                <ul class="d-flex align-items-center">
                    <li class="dropdown btn mr-2">
                        <a
                            class="dropdown-toggle"
                            href="#"
                            id="navbarDropdown"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            ><i class="fas fa-home"></i>
                            REGISTRATI O ACCEDI
                        </a>
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
                        <router-link :to="{ name: 'store' }">
                            <i class="fas fa-utensils"></i>
                            RISTORANTI</router-link
                        >
                    </li>
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
                        <span>&euro; 0.00</span>
                    </li>
                </ul>
            </div>
        </section>
        <NavbarResponsive class="navbar-responsive" />
    </div>
</template>

<script>
import NavbarResponsive from "./NavbarResponive";
export default {
    name: "Navbar",
    components: {
        NavbarResponsive
    },
    data() {
        return {
            orderDishes: [],
            lastChange: null,
            timer: null,
            quantityChanged: false
        };
    },
    created() {
        this.orderDishes = JSON.parse(localStorage.getItem("orders"));
        if (!this.orderDishes) {
            this.orderDishes = [];
        }

        let curVal = localStorage.getItem("orders");
        this.lastChange = new Date();
        this.timer = setInterval(() => {
            const newVal = localStorage.getItem("orders");
            if (newVal !== curVal) {
                curVal = newVal;
                this.orderDishes = JSON.parse(localStorage.getItem("orders"));
                if (!this.orderDishes) {
                    this.orderDishes = [];
                }
                this.lastChange = new Date();
            }
        }, 500);
    },
    beforeDestroy() {
        cleaInterval(this.timer);
    },
    computed: {
        sum() {
            let sum = 0;
            if (this.orderDishes) {
                this.orderDishes.forEach(orderDish => {
                    sum += parseFloat(orderDish.price * orderDish.quantity);
                });
            }
            sum += this.orderDishes[0].delivery_price;
            return sum.toFixed(2);
        },
        haveOrders() {
            if (this.orderDishes.length > 0) {
                return true;
            }
            return false;
        }
    }
};
</script>

<style scoped lang="scss">
@import "./resources/sass/_variables";
#navbar-container {
    .navbar-responsive {
        display: none !important;
    }
    #navbar {
        display: flex;
        height: 92px;
        border-bottom: 2px solid white;

        #logo {
            display: flex;
            align-items: center;
            img {
                width: 19%;
                cursor: pointer;
            }
        }

        #list {
            display: flex;
            align-items: center;
            justify-content: flex-end;

            ul {
                list-style: none;

                li,
                #cart {
                    position: relative;
                    color: $darkGreenFont;
                    padding: 0 0;
                    border: 1px solid $darkGreenFont;
                    background-color: $bgSecondary;

                    &:hover .dropdown-link {
                        color: $darkGreenFont;
                    }

                    &:hover {
                        background-color: $darkGreenFont;
                    }
                    &:hover a,
                    &:hover i {
                        color: $bgSecondary;
                    }

                    #register {
                        border-top: 1px solid $darkGreenFont;
                    }

                    a {
                        padding: 5px 10px;
                        position: relative;
                        text-decoration: none;
                        font-size: 10px;
                        font-weight: bolder;
                        color: $darkGreenFont;

                        i {
                            padding-right: 3px;
                            color: $darkGreenFont;
                        }
                    }
                }

                #cart {
                    padding: 0 10px;
                    &:hover span {
                        color: $bgSecondary;
                    }

                    i {
                        font-size: 12px;
                    }

                    span {
                        font-size: 13px;
                    }
                }
            }
        }
    }

    @media screen and(max-width:575px) {
        .navbar-responsive {
            display: flex !important;
        }
        #navbar {
            display: none;
        }
    }
}
</style>
