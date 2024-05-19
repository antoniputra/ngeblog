<template>
    <div>
        <Container>
            <div class="flex flex-col items-center justify-center gap-2">
                <h2 class="text-2xl">404 Not Found</h2>
                <p>
                    <router-link :to="{ name: 'dashboard' }" class="link">
                        Back to home
                    </router-link>
                </p>
            </div>
        </Container>
    </div>
</template>

<script setup>
import Container from "./Container.vue";
</script>
