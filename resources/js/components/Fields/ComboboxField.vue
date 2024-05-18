<script setup>
import { ref, computed } from "vue";
import {
    Combobox,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
} from "@headlessui/vue";
import { computedAsync, useDebounceFn } from "@vueuse/core";
import { autoPlacement, autoUpdate, useFloating } from "@floating-ui/vue";

const props = defineProps({
    modelValue: {
        type: [String, Number, Object, Array, Boolean],
        default: "",
    },
    query: {
        type: String,
        default: null,
    },
    placeholder: {
        type: String,
        default: null,
    },
    options: {
        type: Array,
        default: [],
    },
    multiple: {
        type: Boolean,
        default: false,
    },
    required: {
        type: Boolean,
        default: false,
    },
    loading: {
        type: Boolean,
        default: false,
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    searchable: {
        type: [Boolean, Function],
        default: false,
    },
    searchablePlaceholder: {
        type: String,
        default: "Search...",
    },
    searchableLazy: {
        type: Boolean,
        default: false,
    },
    searchAttributes: {
        type: Array,
        default: [],
    },
    valueAttribute: {
        type: String,
        default: null,
    },
    labelAttribute: {
        type: String,
        default: "label",
    },
    debounce: {
        type: Number,
        default: 300,
    },
    clearSearchOnClose: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["update:modelValue"]);

const trigger = ref(null);
const floating = ref(null);
const { floatingStyles } = useFloating(trigger, floating, {
    middleware: [autoPlacement()],
    whileElementsMounted: autoUpdate,
});

const internalQuery = ref("");
const query = computed({
    get() {
        return props.query ?? internalQuery.value;
    },
    set(value) {
        internalQuery.value = value;
    },
});

const label = computed(() => {
    if (props.multiple) {
        if (Array.isArray(props.modelValue) && props.modelValue.length) {
            return `${props.modelValue.length} selected`;
        } else {
            return null;
        }
    } else if (props.modelValue !== undefined && props.modelValue !== null) {
        if (props.valueAttribute) {
            const option = props.options.find(
                (option) => option[props.valueAttribute] === props.modelValue,
            );
            return option ? option[props.labelAttribute] : null;
        } else {
            return ["string", "number"].includes(typeof props.modelValue)
                ? props.modelValue
                : props.modelValue[props.labelAttribute];
        }
    }

    return null;
});

const debouncedSearch =
    typeof props.searchable === "function"
        ? useDebounceFn(props.searchable, props.debounce)
        : undefined;

const filteredOptions = computedAsync(
    async () => {
        if (props.searchable && debouncedSearch) {
            return await debouncedSearch(query.value);
        }

        if (query.value === "") {
            return props.options;
        }

        return props.options.filter((option) => {
            return (
                props.searchAttributes.length
                    ? props.searchAttributes
                    : [props.labelAttribute]
            ).some((searchAttribute) => {
                if (["string", "number"].includes(typeof option)) {
                    return (
                        String(option).search(new RegExp(query.value, "i")) !==
                        -1
                    );
                }

                const result = option[searchAttribute];

                return (
                    result !== null &&
                    result !== undefined &&
                    String(result).search(new RegExp(query.value, "i")) !== -1
                );
            });
        });
    },
    [],
    {
        lazy: props.searchableLazy,
    },
);

const onUpdate = (value) => {
    emit("update:modelValue", value);
};
</script>

<template>
    <Combobox
        v-slot="{ open }"
        :model-value="modelValue"
        :multiple="multiple"
        @update:model-value="onUpdate"
        as="div"
        class="relative"
    >
        <slot name="selected" />

        <ComboboxButton
            ref="trigger"
            as="div"
            role="button"
            :class="['relative flex w-full items-center']"
        >
            <slot :open="open" :disabled="disabled" :loading="loading">
                <button
                    :class="[
                        'w-full rounded border px-4 py-2 text-left shadow',
                    ]"
                    :disabled="disabled"
                    type="button"
                >
                    <slot name="label">
                        <span v-if="label" :class="['block truncate']">
                            {{ label }}
                        </span>
                        <span v-else :class="['block truncate']">
                            {{ placeholder || "Select" }}
                        </span>
                    </slot>
                </button>
                <span
                    v-if="loading"
                    class="loading loading-spinner absolute right-2 ml-auto"
                ></span>
            </slot>
        </ComboboxButton>

        <div
            v-if="open"
            ref="floating"
            :style="floatingStyles"
            :class="['group z-20 w-full bg-white']"
        >
            <Transition
                appear
                v-bind="{
                    leaveActiveClass: 'transition ease-in duration-100',
                    leaveFromClass: 'opacity-100',
                    leaveToClass: 'opacity-0',
                }"
            >
                <ComboboxOptions
                    static
                    as="ul"
                    :class="[
                        'relative scroll-py-1 overflow-y-auto shadow focus:outline-none', // uiMenu.base
                        'ring-1 ring-gray-200 dark:ring-gray-700', // uiMenu.ring
                        'max-h-60', // uiMenu.height
                    ]"
                >
                    <ComboboxInput
                        v-if="searchable"
                        :display-value="() => query"
                        name="q"
                        :placeholder="searchablePlaceholder"
                        autofocus
                        autocomplete="off"
                        :class="[
                            'sticky top-0 z-10 mb-1 block w-full border-0 border-b border-gray-200 bg-white px-3 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-transparent dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:placeholder-gray-500',
                        ]"
                        @change="(event) => (query = event.target.value)"
                    />

                    <ComboboxOption
                        as="template"
                        v-for="(option, index) in filteredOptions"
                        v-slot="{ active, selected, disabled: optionDisabled }"
                        :key="index"
                        :value="
                            valueAttribute ? option[valueAttribute] : option
                        "
                        :disabled="option.disabled"
                    >
                        <li
                            :class="[
                                'relative flex cursor-default select-none items-center justify-between gap-1 px-3 py-1.5', // uiMenu.option.base,
                                active ? 'bg-gray-100 dark:bg-gray-900' : '',
                                selected ? 'bg-teal-100 dark:bg-teal-700' : '',
                            ]"
                        >
                            <div :class="['flex min-w-0 items-center gap-1.5']">
                                <slot
                                    name="option"
                                    :option="option"
                                    :active="active"
                                    :selected="selected"
                                >
                                    <span class="truncate">
                                        {{
                                            ["string", "number"].includes(
                                                typeof option,
                                            )
                                                ? option
                                                : option[labelAttribute]
                                        }}
                                    </span>
                                </slot>
                            </div>

                            <span v-if="selected" :class="[]">
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
                                    <path
                                        stroke="none"
                                        d="M0 0h24v24H0z"
                                        fill="none"
                                    />
                                    <path d="M5 12l5 5l10 -10" />
                                </svg>
                            </span>
                        </li>
                    </ComboboxOption>

                    <ComboboxOption v-if="props.createable">
                        Create "{{ query }}"?
                    </ComboboxOption>

                    <p
                        v-else-if="
                            searchable && query && !filteredOptions?.length
                        "
                        :class="[
                            'px-2 py-1.5 text-sm text-gray-400 dark:text-gray-500',
                        ]"
                    >
                        <slot name="option-empty" :query="query">
                            No results for "{{ query }}".
                        </slot>
                    </p>
                    <p
                        v-else-if="!filteredOptions?.length"
                        :class="[
                            'px-2 py-1.5 text-sm text-gray-400 dark:text-gray-500',
                        ]"
                    >
                        <slot name="empty" :query="query">
                            {{ props.loading ? "Loading..." : "No options." }}
                        </slot>
                    </p>
                </ComboboxOptions>
            </Transition>
        </div>
    </Combobox>
</template>
