<template>
    <div id="navbar-container" class="w-100 pt-4">
        <section
            id="navbar"
            class="w-100 d-flex justify-content-between align-center container pb-3"
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
                            <a class="dropdown-item dropdown-link" href="/login">ACCEDI</a>
                            <a class="dropdown-item dropdown-link" href="/register"
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
                        <span >&euro; {{ sum }}</span>
                    </li>
                </ul>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    name: "Navbar",
    data() {
        return {
            orderDishes: []
        };
    },
    created() {
        this.orderDishes = JSON.parse(localStorage.getItem("orders"));
        if (!this.orderDishes) {
            this.orderDishes = [];
        }
    },
    computed: {
        sum() {
            let sum = 0;
            if (this.orderDishes) {
                this.orderDishes.forEach(orderDish => {
                    sum += parseFloat(orderDish.price);
                });
            }
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
    #navbar {
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

                li, #cart {
                    color: $darkGreenFont;
                    padding: 0 10px;
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

                    a {
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
                    &:hover span {
                        color: $bgSecondary;
                    }

                    i {
                        font-size: 12px;
                    }

                    span {
                        font-size: 13px
                    };
                }
            }
        }
    }
}
</style>
