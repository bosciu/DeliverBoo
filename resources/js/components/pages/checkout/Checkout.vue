<template>
    <div id="checkout">
        <header>
            <Navbar />
        </header>
        <main class="container pt-4 pb-3">
            <h2>{{ order[0].restaurant }}</h2>
            <h4>Riepilogo ordine</h4>
            <ul>
                <li v-for="singleOrder in order" :key="singleOrder.id">
                    {{ singleOrder.name }} x{{ singleOrder.quantity }}
                    <b class="ml-3"
                        >€
                        {{
                            (singleOrder.price * singleOrder.quantity).toFixed(
                                2
                            )
                        }}</b
                    >
                </li>
                <li>
                    Spese di spedizione:
                    <b>€ {{ order[0].delivery_price.toFixed(2) }}</b>
                </li>
                <li>
                    Totale: <b>€ {{ sum }}</b>
                </li>
            </ul>
            <router-link
                :to="{
                    name: 'show',
                    params: { slug: this.$route.params.slug }
                }"
                >Desideri modificare l'ordine? Clicca qui!</router-link
            >
            <h4 class="text-center mt-4">Inserisci i dati per la spedizione</h4>
            <form method="POST" ref="form">
                <div class="row justify-content-between">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input
                                required
                                maxlength="150"
                                type="text"
                                class="form-control"
                                id="name"
                                placeholder="Inserisci il tuo nome"
                                name="name"
                                v-model="name"
                            />
                        </div>
                        <div class="form-group">
                            <label for="address">Indirizzo</label>
                            <input
                                required
                                maxlength="100"
                                type="text"
                                class="form-control"
                                id="address"
                                placeholder="Inserisci il tuo indirizzo"
                                name="address"
                                v-model="address"
                            />
                        </div>
                        <div class="form-group">
                            <label for="zip_code">Codice postale</label>
                            <input
                                required
                                maxlength="5"
                                type="text"
                                class="form-control"
                                id="zip_code"
                                placeholder="Inserisci il tuo codice postale"
                                name="zip_code"
                                v-model="zip_code"
                            />
                        </div>
                        <div class="form-group">
                            <label for="phone">Numero di telefono</label>
                            <input
                                required
                                maxlength="15"
                                type="text"
                                class="form-control"
                                id="phone"
                                placeholder="Inserisci il tuo numero di telefono"
                                name="phone"
                                v-model="phone"
                            />
                        </div>
                        <span class="btn btn-primary mt-3" @click="submit">
                            Invia
                        </span>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="surname">Cognome</label>
                            <input
                                required
                                maxlength="60"
                                type="text"
                                class="form-control"
                                id="surname"
                                placeholder="Inserisci il tuo cognome"
                                name="surname"
                                v-model="surname"
                            />
                        </div>
                        <div class="form-group">
                            <label for="city">Città</label>
                            <input
                                required
                                maxlength="60"
                                type="text"
                                class="form-control"
                                id="city"
                                placeholder="Inserisci la tua città"
                                name="city"
                                v-model="city"
                            />
                        </div>
                        <div class="form-group">
                            <label for="province">Provincia</label>
                            <input
                                required
                                maxlength="2"
                                type="text"
                                class="form-control"
                                id="province"
                                placeholder="Inserisci la tua provincia"
                                name="province"
                                v-model="province"
                            />
                        </div>
                    </div>
                </div>
            </form>
        </main>
        <Footer />
    </div>
</template>

<script>
import Navbar from "../../common/Navbar";
import Footer from "../../common/Footer";
export default {
    name: "checkout",
    data() {
        return {
            order: [],
            name: "",
            address: "",
            zip_code: "",
            surname: "",
            city: "",
            province: "",
            phone: ""
        };
    },
    components: {
        Navbar,
        Footer
    },
    created() {
        this.order = JSON.parse(localStorage.getItem("orders"));
    },
    computed: {
        sum() {
            let sum = 0;
            this.order.forEach(singleOrder => {
                sum += singleOrder.price * singleOrder.quantity;
            });
            return parseFloat((sum += this.order[0].delivery_price)).toFixed(2);
        }
    },
    methods: {
        submit() {
            axios
                .post(
                    `http://127.0.0.1:8000/api/${this.order[0].slug}/checkout`,
                    {
                        name: this.name,
                        address: this.address,
                        zip_code: this.zip_code,
                        surname: this.surname,
                        city: this.city,
                        province: this.province,
                        order: this.order,
                        phone: this.phone
                    }
                )
                .then(res => {
                    console.log(res);
                    localStorage.clear();
                    document.location.href = "/order-confirm";
                })
                .catch(err => console.log(err));
        }
    }
};
</script>

<style scoped lang="scss">
@import "./resources/sass/_variables.scss";
#checkout {
    header {
        background-color: $bgPrimary;
        background-image: url(/images/sfondo-show-store.png);
        background-size: contain;
        background-position: right;
        background-repeat: no-repeat;
        padding-bottom: 10px;
        box-shadow: 0 0 25px 25px $bgPrimary;
    }
    main {
        min-height: calc(100vh - 420px);
    }
}
</style>
