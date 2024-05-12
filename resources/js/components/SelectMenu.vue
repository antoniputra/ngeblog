<script setup>
import { ref, computed } from "vue";
import { computedAsync, useDebounceFn } from "@vueuse/core";
import {
    Combobox,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
    TransitionRoot,
} from "@headlessui/vue";
import {
    CheckCircleIcon,
    ChevronDownIcon,
    XMarkIcon,
} from "@heroicons/vue/20/solid";

const props = defineProps({
    modelValue: {
        type: [String, Number, Object],
    },
    options: [Array, Object, Function],
    labelProp: {
        type: String,
        default: "label",
    },
    valueProp: {
        type: String,
        default: "value",
    },
    searchable: {
        type: Boolean,
        default: true,
    },
    debounce: {
        type: Number,
        default: 400,
    },
    color: {
        type: String,
        default: "gray",
    },
    placeholder: String,
    nullable: Boolean,
    multiple: Boolean,
});

const emit = defineEmits(["update:modelValue"]);

const theValue = computed({
    get() {
        return props.modelValue;
    },
    set(value) {
        emit("update:modelValue", value);
    },
});

const debouncedSearch =
    typeof props.options === "function"
        ? useDebounceFn(props.options, props.debounce)
        : undefined;

const query = ref("");
const filterableOptions = computedAsync(async () => {
    if (debouncedSearch) {
        return await debouncedSearch(query.value);
    }

    let theOptions = props.options;
    if (typeof theOptions === "object" && !Array.isArray(theOptions)) {
        theOptions = Object.entries(props.options).map(([key, value]) => ({
            label: value,
            value: key,
        }));
    }

    if (query.value === "") {
        return theOptions;
    }

    return query.value === ""
        ? theOptions
        : theOptions.filter((optionItem) =>
              optionItem[props.labelProp]
                  .toLowerCase()
                  .replace(/\s+/g, "")
                  .includes(query.value.toLowerCase().replace(/\s+/g, "")),
          );
});

const selected = computed(() => {
    // * If multiple values.
    if (Array.isArray(props.modelValue) && props.modelValue.length) {
        return `${props.modelValue.length} selected`;
    }

    // * If single value.
    if (!Array.isArray(props.modelValue) && props.modelValue) {
        if (Array.isArray(filterableOptions.value)) {
            if (typeof props.modelValue === "object") {
                return props.modelValue[props.labelProp];
            }

            const foundOption = filterableOptions.value.find(
                (i) => i.value === props.modelValue,
            );
            if (foundOption) {
                return foundOption.label;
            } else {
                return props.labelProp === props.valueProp
                    ? props.modelValue
                    : filterableOptions.value.find(
                          (option) =>
                              option[props.valueProp] === props.modelValue,
                      )[props.labelProp];
            }
        }

        return props.valueProp
            ? props.modelValue
            : props.modelValue[props.labelProp];
    }

    return null;
});

const presets = computed(() => ({
    input: {
        gray: `border`,
        blue: `bg-${props.color}-100 border-${props.color}-200 dark:bg-${props.color}-900 dark:border-${props.color}-800`,
        green: `bg-${props.color}-100 border-${props.color}-200 dark:bg-${props.color}-900 dark:border-${props.color}-800`,
        orange: `bg-${props.color}-100 border-${props.color}-200 dark:bg-${props.color}-900 dark:border-${props.color}-800`,
        purple: `bg-${props.color}-100 border-${props.color}-200 dark:bg-${props.color}-900 dark:border-${props.color}-800`,
    },
    dropdowns: {
        gray: `bg-gray-50 dark:bg-gray-950`,
        blue: `bg-${props.color}-50 dark:bg-${props.color}-950`,
        green: `bg-${props.color}-50 dark:bg-${props.color}-950`,
        orange: `bg-${props.color}-50 dark:bg-${props.color}-950`,
        purple: `bg-${props.color}-50 dark:bg-${props.color}-950`,
    },

    // when hovered
    dropdownActive: {
        gray: `bg-gray-600 text-white dark:bg-gray-500 black:text-black`,
        blue: `bg-${props.color}-600 text-white dark:bg-${props.color}-500 black:text-black`,
        green: `bg-${props.color}-600 text-white dark:bg-${props.color}-500 black:text-black`,
        orange: `bg-${props.color}-600 text-white dark:bg-${props.color}-500 black:text-black`,
        purple: `bg-${props.color}-600 text-white dark:bg-${props.color}-500 black:text-black`,
    },

    dropdownSelected: {
        gray: `text-gray-600 dark:text-gray-400`,
        blue: `text-${props.color}-600 dark:text-${props.color}-400`,
        green: `text-${props.color}-600 dark:text-${props.color}-400`,
        orange: `text-${props.color}-600 dark:text-${props.color}-400`,
        purple: `text-${props.color}-600 dark:text-${props.color}-400`,
    },
}));
</script>

<template>
    <Combobox
        v-model="theValue"
        :nullable="props.nullable"
        :multiple="props.multiple"
        v-slot="{ open }"
    >
        <div class="relative">
            <div
                class="relative flex w-full cursor-default overflow-hidden rounded-md text-left focus:outline-none dark:border-gray-500 dark:bg-gray-600"
                :class="[presets.input[props.color]]"
            >
                <ComboboxButton
                    tabindex="0"
                    class="w-full rounded-md p-2 text-left"
                    :class="[
                        !selected
                            ? 'text-sm italic text-gray-400'
                            : 'dark:text-gray-200',
                    ]"
                >
                    {{ selected || props.placeholder }}
                </ComboboxButton>

                <button
                    type="button"
                    class="absolute inset-y-0 right-5 flex items-center pr-2"
                    v-if="
                        props.nullable &&
                        ((!props.multiple && theValue) || theValue?.length)
                    "
                    @click="
                        props.multiple
                            ? (theValue = [])
                            : (theValue = undefined)
                    "
                >
                    <XMarkIcon
                        class="h-5 w-5 text-neutral-800 duration-100 hover:rotate-12 hover:scale-125 dark:text-neutral-300"
                        aria-hidden="true"
                    />
                </button>
                <ComboboxButton
                    class="absolute inset-y-0 right-0 flex items-center pr-2"
                >
                    <ChevronDownIcon
                        class="h-5 w-5 text-neutral-800 duration-200 dark:text-neutral-300"
                        :class="[
                            open
                                ? ' rotate-180'
                                : 'rotate-0 hover:rotate-12 hover:scale-125',
                        ]"
                        aria-hidden="true"
                    />
                </ComboboxButton>
            </div>

            <TransitionRoot
                leave="transition ease-in duration-100"
                leaveFrom="opacity-100"
                leaveTo="opacity-0"
                @after-leave="query = ''"
            >
                <ComboboxOptions
                    class="absolute z-30 max-h-60 w-full overflow-auto rounded-md py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
                    :class="[presets.dropdowns[props.color]]"
                >
                    <ComboboxInput
                        v-if="searchable"
                        class="w-full rounded border-none py-2 pl-3 pr-10 leading-5 text-neutral-800 placeholder:text-sm placeholder:italic placeholder:text-gray-400 focus:ring-0 dark:text-neutral-300"
                        :class="presets.dropdowns[props.color]"
                        :placeholder="$t('common.search_here')"
                        @change="query = $event.target.value"
                        :display-value="
                            (display) => (display ? display.title : '')
                        "
                        autocomplete="off"
                    />
                    <div
                        v-if="filterableOptions.length === 0 && query !== ''"
                        class="relative cursor-default select-none px-4 py-2 text-gray-700 dark:text-neutral-300"
                    >
                        {{ $t("common.nothing_found") }}
                    </div>

                    <ComboboxOption
                        v-for="(optionItem, index) in filterableOptions"
                        as="template"
                        :key="index"
                        :value="
                            props.valueProp
                                ? optionItem[props.valueProp]
                                : optionItem
                        "
                        v-slot="{ selected, active }"
                    >
                        <li
                            class="relative cursor-default select-none py-2 pl-10 pr-4"
                            :class="{
                                [presets.dropdownActive[props.color]]: active,
                                'text-gray-900 dark:text-neutral-300': !active,
                            }"
                        >
                            <span
                                class="block truncate"
                                :class="{
                                    'font-medium': selected,
                                    'font-normal': !selected,
                                }"
                            >
                                {{ optionItem[props.labelProp] }}
                            </span>
                            <span
                                v-if="selected"
                                class="absolute inset-y-0 left-0 flex items-center pl-3"
                                :class="{
                                    'text-white dark:text-black': active,
                                    [presets.dropdownSelected[props.color]]:
                                        !active,
                                }"
                            >
                                <CheckCircleIcon
                                    class="h-5 w-5"
                                    aria-hidden="true"
                                />
                            </span>
                        </li>
                    </ComboboxOption>
                </ComboboxOptions>
            </TransitionRoot>
        </div>
    </Combobox>
</template>
