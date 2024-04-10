<template>
    <ul>
        <li v-for="item in navigation">
            <router-link
                :to="item.to"
                class="flex items-center gap-1 hover:bg-teal-100 font-semibold tracking-wide text-base md:text-lg focus:bg-teal-100 py-1"
            >
                <component v-if="item.icon" :is="item.icon" />
                <span>{{ item.label }}</span>
            </router-link>
        </li>
    </ul>
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
        label: "Posts",
        to: { name: "post-index" },
    },
    {
        icon: null,
        label: "Tags",
        to: { name: "tag-index" },
    },
];
</script>
