<template>
    <header class="w-100">
        <div class="container">
            <Navbar />
            <section id="jumbotron" class="d-flex align-items-center">

                <!-- carousel -->

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
                
                <!-- searchbar -->

                <div id="searchbar" class="w-50 d-flex">
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
    import Navbar from "./Navbar";
    export default {
        name: "Header",
        components: {
            Navbar
        }
    };
</script>

<style lang="scss" scoped>
@import "./resources/sass/_variables";
    header {
        background-color: #7CC0AD;

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
            #searchbar {
                justify-content: flex-end;
            }
        }
    }
</style>
