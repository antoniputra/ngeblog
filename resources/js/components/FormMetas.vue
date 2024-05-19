<script setup>
import { reactive } from "vue";
import FormControl from "./FormControl.vue";

const props = defineProps({
    modelValue: Array,
});

const emits = defineEmits(["update:modelValue"]);

const metaItem = reactive({
    field_type: "text",
    key: "",
    label: "",
    value: "",
});
</script>

<template>
    <details class="collapse rounded border" open>
        <summary class="collapse-title p-0">
            <div
                class="flex items-center justify-between bg-gray-100 px-4 py-2 text-lg font-medium hover:bg-gray-200"
            >
                <p>
                    <span class="underline underline-offset-2">Meta Data</span>
                    <span class="ml-2 text-sm italic">(optional)</span>
                </p>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="h-6 w-6 flex-none"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M6 9l6 6l6 -6" />
                </svg>
            </div>
        </summary>

        <div class="collapse-content p-0">
            <div class="flex flex-col divide-y">
                <div
                    v-for="i in [1, 2, 3]"
                    class="relative grid grid-cols-3 justify-center gap-2 p-4 pt-8"
                >
                    <div
                        class="absolute left-1 top-1 inline-flex h-8 w-8 items-center justify-center self-start rounded-full border bg-gray-200 p-2"
                    >
                        {{ i }}
                    </div>

                    <FormControl label="Field Type:" required class="">
                        <select
                            v-model="metaItem.field_type"
                            class="select select-bordered select-sm"
                        >
                            <option value="text">Text</option>
                            <option value="textarea">Textarea</option>
                        </select>
                    </FormControl>

                    <FormControl label="Key:" required class="">
                        <input
                            type="text"
                            v-model="metaItem.key"
                            placeholder="e.g: co_author"
                            class="input input-sm input-bordered"
                        />
                    </FormControl>

                    <FormControl label="Label:" :required="false" class="">
                        <input
                            type="text"
                            placeholder="e.g: Co Author"
                            class="input input-sm input-bordered"
                        />
                    </FormControl>

                    <FormControl label="Value:" required class="col-span-full">
                        <input
                            type="text"
                            placeholder="e.g: Sobirin Rodriguez"
                            class="input input-sm input-bordered"
                        />
                    </FormControl>

                    <div class="absolute right-1 top-1 flex">
                        <button
                            type="button"
                            class="btn btn-outline btn-error btn-sm"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- <ModalConfirmation
            :show="postRemoving.show"
            @close="postRemoving.close()"
            @confirm="postRemoving.triggerConfirm()"
            v-bind="postRemoving.props"
        /> -->
    </details>
</template>
