<template>
    <footer>
        <div class="container">
            <div class="row">
                <router-link :to="{ name: 'home' }">
                    <img
                        class="logo"
                        src="/images/logos/logo-footer.png"
                        alt="deliverboo logo"
                    />
                </router-link>
                <div class="col">
                    <ul>
                        <li>
                            <h6>Scopri DeliverBoo</h6>
                        </li>
                        <li>
                            <a href="#">Chi siamo</a>
                        </li>
                        <li>
                            <router-link :to="{ name: 'store' }">
                                Ristoranti</router-link
                            >
                        </li>
                        <li>
                            <a href="#">Diventa nostro partner</a>
                        </li>
                        <li>
                            <a href="#">Lavora con noi</a>
                        </li>
                    </ul>
                </div>
                <div class="col">
                    <ul>
                        <li>
                            <h6>Note legali</h6>
                        </li>
                        <li>
                            <a href="#">Termini &amp; Condizioni</a>
                        </li>
                        <li>
                            <a href="#">Informativa sulla privacy</a>
                        </li>
                        <li>
                            <a href="#">Cookies</a>
                        </li>
                    </ul>
                </div>
                <div class="col">
                    <ul>
                        <li>
                            <h6>Aiuto</h6>
                        </li>
                        <li>
                            <a href="#">Contatti</a>
                        </li>
                        <li>
                            <a href="#">FAQ</a>
                        </li>
                        <li>
                            <a href="#">Tipi di cucina</a>
                        </li>
                        <li>
                            <a href="#">Mappa del sito</a>
                        </li>
                    </ul>
                </div>
                <div class="col">
                    <ul>
                        <li>
                            <h6>Porta DeliverBoo con te</h6>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-6 col-md-12">
                                    <a href="#">
                                        <img
                                            src="https://www.palestrauniverso.it/wp-content/uploads/2018/05/google-play-11.png"
                                            alt="download-from-googleplay"
                                        />
                                    </a>
                                </div>
                                <div class="col-6 col-md-12">
                                    <a href="#">
                                        <img
                                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Download_on_the_App_Store_Badge_IT_RGB_blk.svg/1280px-Download_on_the_App_Store_Badge_IT_RGB_blk.svg.png"
                                            alt="download-from-appstore"
                                        />
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="logo-container container">
            <div class="icons">
                <i class="fab fa-facebook"></i>
                <i class="fab fa-twitter-square"></i>
                <i class="fab fa-instagram"></i>
            </div>
            <div>
                <span>&copy; 2021 DeliverBoo</span>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: "Footer"
};
</script>

<style lang="scss" scoped>
@import "./resources/sass/_variables";

footer {
    min-height: 325px;
    padding: 30px 0;
    background-color: #434848;

    .container {
        .row {
            display: flex;
            align-items: center;
            justify-content: space-around;
            .col {
                display: flex;
                justify-content: center;
                height: 200px;
                margin: 5px;
                background-color: #2e3333;
                img {
                    display: block;
                    width: 100px;
                }
            }
        }
        .logo {
            height: 200px;
            border-radius: 50%;
            margin: 0 5px;
        }
    }

    ul {
        width: 180px;
        margin: 0;
        padding: 20px;
        li {
            list-style-type: none;
            font-size: 12px;
            line-height: 20px;
            h6 {
                font-size: 15px;
                margin-bottom: 10px;
                color: white;
            }
        }
        a {
            text-decoration: none;
            color: white;
            &:hover {
                cursor: pointer;
                color: $darkGreenFont;
            }
        }
    }

    .logo-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 5px;
        .icons {
            margin-left: 33px;
        }
        span {
            color: lightgray;
        }
        i {
            font-size: 26px;
            padding: 8px;
            color: white;
            &.fa-facebook:hover {
                cursor: pointer;
                color: #1977f2;
            }
            &.fa-twitter-square:hover {
                cursor: pointer;
                color: #55acee;
            }
            &.fa-instagram:hover {
                cursor: pointer;
                color: #e94574;
            }
        }
    }
}
// query fede
@media screen and (max-width: 575px) {
    footer {
        padding: 30px 15px;
        .container {
            .row {
                .col {
                    height: 150px;
                    max-width: 575px !important;
                }
                ul {
                    width: 250px;
                    li h6 {
                        font-size: 22px;
                    }
                    a {
                        font-size: 14px;
                    }
                }
                .logo-container .icons {
                    margin: 0;
                    i {
                        font-size: 20px;
                        padding: 4px;
                    }
                }
                span {
                    font-size: 16px;
                }
            }
        }
    }
}
</style>
