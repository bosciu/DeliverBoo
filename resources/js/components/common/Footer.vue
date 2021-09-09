<template>
    <footer>
        <div class="container">
            <div class="row">
                <a href="#">
                    <img class="logo" src="/images/logos/logo-footer.png" alt="deliverboo logo">
                </a>
                <div class="col">
                    <ul>
                        <li>
                            <h6>Scopri DeliverBoo</h6>
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
            align-items: center;
            justify-content: space-around;
            .col {
                display: flex;
                justify-content: center;
                height: 200px;
                margin: 5px;
                background-color: #2E3333;
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
        line-height: 24px;
        h6 {
            font-size: 15px;
            margin-bottom: 20px;
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
        span {
            color: lightgray;
        }
        i {
            font-size: 26px;
            padding: 8px;
            color: white;
                &.fa-facebook:hover {
                    cursor: pointer;
                    color: #1977F2;
                }
                &.fa-twitter-square:hover {
                    cursor: pointer;
                    color: #55ACEE;
                }
                &.fa-instagram:hover {
                    cursor: pointer;
                    color: #E94574;
                }
        }
}
</style>
