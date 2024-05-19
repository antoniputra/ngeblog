<script setup>
import { useAxiosFetch } from "@/composables/useAxiosFetch";
import { apiBasePath } from "@/utils";

const props = defineProps({
    type: String,
    label: String,
    resolveApi: Function,
});

const endpointsByType = {
    post: apiBasePath("posts/stats"),
    tag: apiBasePath("tags/stats"),
};

const { state, fetchData } = useAxiosFetch();
fetchData(endpointsByType[props.type]);
</script>

<template>
    <div class="stat shadow">
        <div class="stat-figure text-primary">
            <svg
                v-if="props.type === 'tag'"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="inline-block h-12 w-12 stroke-current"
            >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                    d="M3 8v4.172a2 2 0 0 0 .586 1.414l5.71 5.71a2.41 2.41 0 0 0 3.408 0l3.592 -3.592a2.41 2.41 0 0 0 0 -3.408l-5.71 -5.71a2 2 0 0 0 -1.414 -.586h-4.172a2 2 0 0 0 -2 2z"
                />
                <path
                    d="M18 19l1.592 -1.592a4.82 4.82 0 0 0 0 -6.816l-4.592 -4.592"
                />
                <path d="M7 10h-.01" />
            </svg>

            <svg
                v-else-if="props.type === 'post'"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="inline-block h-12 w-12 stroke-current"
            >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                    d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"
                />
                <path d="M7 8h10" />
                <path d="M7 12h10" />
                <path d="M7 16h10" />
            </svg>

            <svg
                v-else
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="inline-block h-12 w-12 stroke-current"
            >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                    d="M16 18a2 2 0 0 1 2 2a2 2 0 0 1 2 -2a2 2 0 0 1 -2 -2a2 2 0 0 1 -2 2zm0 -12a2 2 0 0 1 2 2a2 2 0 0 1 2 -2a2 2 0 0 1 -2 -2a2 2 0 0 1 -2 2zm-7 12a6 6 0 0 1 6 -6a6 6 0 0 1 -6 -6a6 6 0 0 1 -6 6a6 6 0 0 1 6 6z"
                />
            </svg>
        </div>
        <div class="stat-title font-semibold" v-text="props.label" />

        <div class="stat-value text-primary">
            <span
                v-if="state.loading"
                class="loading loading-bars loading-md"
            ></span>
            <span v-else>{{ state?.data?.total_all_time || "-" }}</span>
        </div>
        <div class="stat-desc">
            {{ state?.data?.total_last_month }} from last month
        </div>
    </div>
</template>
