import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "@/pages/Dashboard.vue";
import PostIndex from "@/pages/posts/Index.vue";
import PostCreate from "@/pages/posts/Create.vue";
import PostEdit from "@/pages/posts/Edit.vue";
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
        name: "post-index",
        component: PostIndex,
    },
    {
        path: "/posts/create",
        name: "post-create",
        component: PostCreate,
    },
    {
        path: "/posts/:id/edit",
        name: "post-edit",
        component: PostEdit,
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
