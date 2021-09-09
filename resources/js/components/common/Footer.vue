<template>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col">
                    <a class="logo-footer" href="#">
                        <img src="/images/logos/logo-footer.png" alt="deliverboo-logo">
                    </a>
                </div>
                <div class="col">
                    <ul>
                        <li>
                            <h5>Scopri DeliverBoo</h5>
                        </li>
                        <li>
                            <a href="#">Chi siamo</a>
                        </li>
                        <li>
                            <a href="#">Ristoranti</a>
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
                            <h5>Note legali</h5>
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
                            <h5>Aiuto</h5>
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
                        <h5>Porta DeliverBoo con te</h5>
                    </li>
                    <li>
                        <a href="#">
                            <img src="https://www.palestrauniverso.it/wp-content/uploads/2018/05/google-play-11.png" alt="download-from-googleplay">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Download_on_the_App_Store_Badge_IT_RGB_blk.svg/1280px-Download_on_the_App_Store_Badge_IT_RGB_blk.svg.png" alt="download-from-appstore">
                        </a>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="logo-container container">
            <div>
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
    background-color: #434848;
    padding: 30px 0;
}
.container {
        .row {
            display: flex;
            justify-content: space-around;
            .col {
                display: flex;
                justify-content: center;
                background-color: #2E3333;
                margin: 10px;
                .logo-footer {
                    margin-top: 50px;
                }
                img {
                    display: block;
                    width: 100px;
                    margin: auto;
                }
            }
        }
}
ul {
    margin: 0;
    padding: 20px;
    li {
        list-style-type: none;
        font-size: 14px;
        h5 {
            font-size: 18px;
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
        span {
            color: lightgray;
        }
        i {
            font-size: 26px;
            padding: 2px;
            color: white;
                &.fa-facebook:hover {
                    cursor: pointer;
                    color: #1D6FE5;
                }
                &.fa-twitter-square:hover {
                    cursor: pointer;
                    color: #2E9BF0;
                }
                &.fa-instagram:hover {
                    cursor: pointer;
                    color: #ec0f26;
                }
        }
}
</style>
