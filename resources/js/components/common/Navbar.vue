<template>
    <div id="navbar-container" class="w-100 pt-2">
        <section id="navbar" class="w-100 d-flex justify-content-between align-center container">
            <div id="logo" class="w-50 h-100">
                <img src="/images/logos/logo-dark.png" alt="logo" class="h-100 rounded-circle">
            </div>
            <div id="list" class="w-50 h-100">
                <ul class="d-flex align-items-center">
                    <li id="cart" class="rounded-circle mr-2">
                        <i class="fas fa-shopping-cart"></i>
                    </li>
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
                        <a href="#" class="btn"> <i class="fas fa-bars"></i> MENU'</a>
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
            height: 80px;

            #logo{
                img {
                    width: 15%;
                }
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
                        width: 30px;
                        height: 30px;
                        color: $darkGreenFont;
                        border: 1px solid $darkGreenFont;
                        background-color: $bgSecondary;
                    }
                }
            }
        }
    }
     

</style>