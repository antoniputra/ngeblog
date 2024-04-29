<script setup>
import Modal from "./Modal.vue";

const props = defineProps({
    context: Object,
    title: { type: String, default: "Are you sure?" },
    message: "",
    cancelText: String,
    confirmText: String,
});

const emit = defineEmits(["close", "confirm"]);

const close = () => {
    emit("close");
};

const confirm = (e) => {
    e.target.closest("button").setAttribute("disabled", true);
    setTimeout(() => {
        e.target.closest("button").removeAttribute("disabled");
    }, 2000);
    emit("confirm");
};
</script>

<template>
    <Modal @close="close">
        <div class="flex flex-col gap-4 p-4">
            <slot name="title" :title="title">
                <h2
                    class="text-lg font-medium text-gray-900 dark:text-gray-100"
                >
                    {{ title }}
                </h2>
            </slot>

            <slot name="content" :message="message">
                <p v-if="message">
                    {{ message }}
                </p>
            </slot>

            <div class="flex justify-end gap-4">
                <button
                    type="button"
                    v-text="cancelText || 'Cancel'"
                    @click="$emit('close')"
                    class="btn btn-outline btn-sm"
                />
                <button
                    type="button"
                    v-text="confirmText || 'Confirm'"
                    @click="confirm"
                    class="btn btn-sm"
                />
            </div>
        </div>
    </Modal>
</template>
