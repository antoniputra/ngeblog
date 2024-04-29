<script setup>
defineProps({
    links: Object,
});

defineEmits(["handleClick"]);
</script>

<template>
    <div class="join">
        <button
            v-for="link in links"
            type="button"
            @click="$emit('handleClick', link.url, link)"
            class="join-item btn btn-outline"
            :class="{
                'btn-active': link.active,
                'btn-disabled cursor-not-allowed': !link.url,
            }"
        >
            <span v-html="link.label" />
        </button>
    </div>
</template>
