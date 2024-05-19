<script setup>
import { toasts, useToastable } from "@/composables/useToastable";

const { removeToast } = useToastable();
</script>

<template>
    <div
        v-for="toast in toasts.list"
        :key="toast.id"
        class="toast toast-end toast-top"
    >
        <div
            class="alert alert-info relative"
            role="button"
            @click="removeToast(toast.id)"
        >
            <div v-if="toast.isHtml" v-html="toast.message"></div>
            <div v-else>{{ toast.message }}</div>
        </div>
    </div>
</template>
