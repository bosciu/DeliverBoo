<template>
    <header class="w-100">
        <div class="container">
            <section id="navbar" class="w-100">
            <div id="logo" class="w-50 h-100">
                <img src="/images/logos/logo-dark.png" alt="">
            </div>
            <div id="list" class="w-50 h-100">
                <ul>
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
            <section id="jumbotron" class="d-flex align-items-center">
                <div id="carouselExampleControls" class="carousel slide w-50 mb-5" data-ride="carousel">
                    <div class="carousel-inner rounded">
                        <div class="carousel-item active rounded">
                            <img class="d-block w-100" src="/images/logos/logo-dark.png" alt="">
                        </div>
                        <div class="carousel-item rounded">
                            <img class="d-block w-100" src="/images/logos/logo.png" alt="">
                        </div>
                        <div class="carousel-item rounded">
                            <img class="d-block w-100" src="/images/logos/logo-footer.png" alt="">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div id="searchbar" class="w-50 d-flex justify-content-around">
                    <div class="w-75 p-4 d-flex justify-content-around rounded">
                        <form class="form-inline justify-center">
                            <label for="" class="mb-2">Cerca il Ristorante o la categoria! <i class="fas fa-arrow-circle-down ml-2"></i></label>
                            <input class="form-control mr-sm-3 w-75" type="search" placeholder="Cerca" aria-label="Search">
                            <button class="btn my-2 my-sm-0" type="submit">Cerca</button>
                        </form> 
                    </div>   
                </div>
            </section>
        </div>  
    </header>
</template>

<script>
export default {
    name: "Header"
};
</script>

<style lang="scss" scoped>
@import "./resources/sass/_variables";
    header {
        background: linear-gradient(103deg, $bgPrimary 33%, $bgSecondary 55%, $buttonSecondary);

        #navbar {
            height: 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;

            #logo {
                display: flex;
                align-items: center;

                img {
                    width: 15%;
                }
            }

            #list {
                display: flex;
                align-items: center;
                justify-content: flex-end;

                ul {
                    display: flex;
                    list-style: none;

                    li {
                        padding: 0 10px;

                        a {
                            text-decoration: none;
                            font-size: 10px;
                            font-weight: bolder;
                            border: 1px solid $darkGreenFont;
                            color: #41b3a3;
                            background-color: $bgSecondary;

                            i {
                                padding-right: 3px;
                                color: #41b3a3;
                            }
                        }
                    }
                }
            }
        }

        #jumbotron {
            margin-top: 100px;

            #carouselExampleControls{

               img {
                    height: 300px;
                } 
            }

            #searchbar {

                div {
                    background-color: white;

                    button {
                        background-color: #fdd0af;
                        border: 2px solid #41b3a3;
                        font-weight: bold;
                        color: #41b3a3;
                    }

                    i {
                        color: #41b3a3;
                    }
                }
            } 
        }
    }
</style>
