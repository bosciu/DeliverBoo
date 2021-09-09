<template>
    <div id="navbar-container" class="w-100 pt-2">
        <section id="navbar" class="w-100 d-flex justify-content-between align-center container">
            <router-link tag="div" id="logo" class="w-50 h-100" :to="{name:'home'}">
                <img src="/images/logos/logo-dark.png" alt="logo" class=" rounded-circle">
            </router-link>
            <div id="list" class="w-50 h-100">
                <ul class="d-flex align-items-center">
                    <li class="dropdown">
                        <a class=" dropdown-toggle btn" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-home"></i>
                        REGISTRATI O ACCEDI
                        </a>
                        <div class="dropdown-menu p-0 mt-2" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/login">ACCEDI</a>
                            <a class="dropdown-item" href="/register">REGISTRATI</a>
                        </div>
                    </li>
                    <li>
                        <router-link class="btn" tag="a" :to="{ name: 'store'}"> <i class="fas fa-utensils"></i> RISTORANTI</router-link>  
                    </li>
                    <li id="cart" class="btn mr-2">
                        <i class="fas fa-shopping-cart mr-1 ml-1"></i>
                        <span class="pr-1">&euro; 0</span>
                    </li>
                </ul>
            </div> 
        </section>
    </div>
</template>

<script>
export default {
    name: "Navbar"
};
</script>

<style scoped lang="scss">
@import "./resources/sass/_variables";
    #navbar-container {
         #navbar {
            height: 92px;
            border-bottom: 2px solid white;

            #logo{
                display: flex;
                align-items: center;
                img {
                    width: 17%;
                }
            }

            #logo:hover {
                cursor: pointer;
            }

            #list {
                display: flex;
                align-items: center;
                justify-content: flex-end;

                ul {
                    list-style: none;

                    li {
                        padding: 0 10px;

                        a {
                            text-decoration: none;
                            font-size: 10px;
                            font-weight: bolder;
                            border: 1px solid $darkGreenFont;
                            color: $darkGreenFont;
                            background-color: $bgSecondary;

                            i {
                                padding-right: 3px;
                                color: $darkGreenFont;
                            }
                        }
                    }

                    #cart {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        padding: 1px;
                        color: $darkGreenFont;
                        border: 1px solid $darkGreenFont;
                        background-color: $bgSecondary;
                    }
                }
            }
        }
    }
     

</style>