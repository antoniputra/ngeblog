import { createRouter, createWebHistory } from "vue-router";

import Dashboard from "./pages/Dashboard.vue";
import Index from "./pages/blogs/Index.vue";
import Create from "./pages/blogs/Create.vue";

const routes = [
    {
        path: "/",
        name: "dashboard",
        component: Dashboard,
        // component: () => import("./pages/Dashboard.vue"),
    },
    {
        path: "/blogs",
        name: "blog-index",
        component: Index,
        // component: () => import("./pages/blogs/Index.vue"),
    },
    {
        path: "/blogs/create",
        name: "blog-create",
        component: Create,
        // component: () => import("./pages/blogs/Create.vue"),
    },
];

const resolveBasePathUrl = () => {
    let result = window.NgeblogBasePath + "/";
    if (window.NgeblogBasePath === "" || window.NgeblogBasePath === "/") {
        result = "/";
    }

    return result;
};

const router = createRouter({
    // history: createMemoryHistory("/ngeblog"),
    history: createWebHistory(resolveBasePathUrl()),
    routes,
});

export default router;
