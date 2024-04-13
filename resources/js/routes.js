import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "@/pages/Dashboard.vue";
import PostIndex from "@/pages/posts/Index.vue";
import PostCreate from "@/pages/posts/Create.vue";
import PostEdit from "@/pages/posts/Edit.vue";
import TagIndex from "@/pages/tags/Index.vue";
import TagForm from "@/pages/tags/Form.vue";
import NotFound from "./components/NotFound.vue";
import { resolveRouterBasePath } from "./utils";

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
        name: "posts-index",
        component: PostIndex,
    },
    {
        path: "/posts/create",
        name: "posts-create",
        component: PostCreate,
    },
    {
        path: "/posts/:id/edit",
        name: "posts-edit",
        component: PostEdit,
    },
    {
        path: "/tags",
        name: "tags-index",
        component: TagIndex,
    },
    {
        path: "/tags/create",
        name: "tags-create",
        component: TagForm,
    },
    {
        path: "/tags/:id/edit",
        name: "tags-edit",
        component: TagForm,
    },
];

const router = createRouter({
    history: createWebHistory(resolveRouterBasePath()),
    routes,
});

export default router;
