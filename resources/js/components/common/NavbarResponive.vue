<template>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div id="logo">
            <router-link
                tag="img"
                :to="{ name: 'home' }"
                src="/images/logos/logo-dark.png"
                alt="logo"
                class=" rounded-circle"
            >
            </router-link>
        </div>

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

        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link btn mt-3" href="/restaurants"
                        >Ristoranti
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle btn"
                        href="#"
                        id="navbarDropdown"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        Registrati o accedi
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item btn" href="/register"
                            >Registrati</a
                        >
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item btn" href="/login">Accedi</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    name: "NavbarResponsive",
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
        clearInterval(this.timer);
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
nav {
    font-weight: bolder !important;
    a {
        text-decoration: unset;
        color: unset;
    }
    padding: 0;
    min-height: 75px;
    display: flex !important;
    background-color: $bgPrimary;
    #logo {
        width: 20%;
        height: 80px;
        img {
            width: 120%;
            height: 120%;
            cursor: pointer;
            object-fit: contain;
            object-position: center;
            transform: translateY(-7px);
        }
    }
    .btn {
        width: 80%;
        margin: 7px auto;
        border: 1px solid $darkGreenFont;
        background-color: $bgSecondary;
        color: $darkGreenFont;
    }
    #cart {
        width: 30%;
        margin-left: auto;
        padding: 8px 10px;
    }

    .dropdown-menu {
        background-color: transparent;
    }
}
</style>
