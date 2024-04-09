import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "@/pages/Dashboard.vue";
import BlogIndex from "@/pages/blogs/Index.vue";
import BlogCreate from "@/pages/blogs/Create.vue";
import TagIndex from "@/pages/tags/Index.vue";
import TagCreate from "@/pages/tags/Create.vue";
import NotFound from "./components/NotFound.vue";
import { resolveBasePathUrl } from "./utils";

const routes = [
    {
        path: "/:pathMatch(.*)*",
        name: "NotFound",
        component: NotFound,
    },
    {
        path: "/",
        name: "dashboard",
        component: Dashboard,
    },
    {
        path: "/blogs",
        name: "blog-index",
        component: BlogIndex,
    },
    {
        path: "/blogs/create",
        name: "blog-create",
        component: BlogCreate,
    },
    {
        path: "/tags",
        name: "tag-index",
        component: TagIndex,
    },
    {
        path: "/tags/create",
        name: "tag-create",
        component: TagCreate,
    },
];

const router = createRouter({
    history: createWebHistory(resolveBasePathUrl()),
    routes,
});

export default router;
