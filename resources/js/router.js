import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Homepage from "./components/pages/homepage/Homepage.vue";
import Store from "./components/pages/store/Store.vue";
import Show from "./components/pages/show/Show.vue";

const router = new VueRouter({
    mode: "history",
    linkExactActiveClass: "active",
    routes: [{
            path: "/",
            name: "home",
            component: Homepage
        },
        {
            path: "/store",
            name: "store",
            component: Store
        },
        {
            path: "/:slug/show",
            name: "store",
            component: Show
        }
    ]
});

export default router;