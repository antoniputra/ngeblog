<template>
    <div class="flex flex-col">
        <header class="bg-blue-500">
            <nav class="max-w-7xl mx-auto flex items-center">
                <router-link
                    v-for="item in navigation"
                    :to="item.to"
                    class="flex items-center p-2 gap-1"
                >
                    <component v-if="item.icon" :is="item.icon" />
                    <span>{{ item.label }}</span>
                </router-link>
            </nav>
        </header>

        <div class="flex-grow">
            <RouterView />
        </div>
    </div>
</template>

<script setup>
const navigation = [
    {
        icon: null,
        label: "Dashboard",
        to: { name: "dashboard" },
    },
    {
        icon: null,
        label: "Blogs",
        to: { name: "blog-index" },
    },
];
</script>
