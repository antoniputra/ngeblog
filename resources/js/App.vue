<template>
    <div class="flex flex-col min-h-screen">
        <Header />

        <div class="flex-grow pb-10">
            <RouterView />
        </div>

        <Footer />
    </div>
</template>

<script setup>
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
</script>
