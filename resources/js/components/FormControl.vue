<script setup>
const props = defineProps({
    label: String,
    required: Boolean,
    helpMessage: String,
    errorMessage: String,
});
</script>

<template>
    <label class="form-control">
        <div class="label text-sm">
            <span
                class="label-text font-medium"
                v-if="props.label"
                v-text="props.label"
            />
            <span v-if="required" class="label-text-alt italic">*Required</span>
        </div>

        <slot />

        <div class="label flex flex-col items-start md:flex-row">
            <span v-if="props.helpMessage" class="label-text-alt text-sm">
                {{ props.helpMessage }}
            </span>
            <span
                v-if="props.errorMessage"
                class="label-text-alt text-sm text-error"
            >
                {{ props.errorMessage }}
            </span>
        </div>
    </label>
</template>
