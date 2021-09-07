import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Homepage from "./components/pages/homepage/Homepage.vue";

const router = new VueRouter({
    mode: "history",
    linkExactActiveClass: "active",
    routes: [{
        path: "/",
        name: "home",
        component: Homepage
    }]
});

export default router;