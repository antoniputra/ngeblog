<template>
    <div class="flex min-h-screen flex-col">
        <Header />

        <div class="flex-grow pb-10">
            <router-view v-slot="{ Component }">
                <transition
                    enter-active-class="transition-opacity duration-200"
                    leave-active-class="transition-opacity duration-200"
                    enter-from-class="opacity-0"
                    leave-to-class="opacity-0 hidden"
                >
                    <component :is="Component" />
                </transition>
            </router-view>
        </div>

        <Toast />

        <Footer />
    </div>
</template>

<script setup>
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
import Toast from "./components/Toast.vue";
</script>
