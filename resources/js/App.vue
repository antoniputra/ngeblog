<template>
    <div class="flex flex-col">
        <Header />

        <div class="flex-grow">
            <RouterView />
        </div>
    </div>
</template>

<script setup>
import Header from "@/components/Header.vue";
</script>
