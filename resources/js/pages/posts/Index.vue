<script setup>
import Container from "@/components/Container.vue";
import Pagination from "@/components/Pagination.vue";
import axios from "axios";
import { onMounted, reactive } from "vue";
import { apiBasePath, formatDate } from "@/utils";

onMounted(() => {
    document.title = "Posts - Ngeblog Administration";
    posts.fetchRecords();
});

const posts = reactive({
    loading: false,
    records: null,
    fetchRecords(url = null) {
        const self = this;
        self.loading = true;

        url = url || apiBasePath("posts");

        axios
            .get(url)
            .then((response) => {
                self.records = response.data;
            })
            .finally(() => {
                self.loading = false;
            });
    },
});
</script>

<template>
    <div>
        <Container>
            <div class="mb-8">
                <h1
                    class="flex items-center gap-2 text-2xl font-bold tracking-wide"
                >
                    <span>Posts List</span>
                    <span
                        v-if="posts.loading"
                        class="loading loading-bars loading-md"
                    ></span>
                    <span v-else v-text="`(${posts.records?.meta?.total})`" />
                </h1>
            </div>

            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="text-base">
                        <tr>
                            <th class="min-w-80">Title</th>
                            <th>Last Updated</th>
                            <th>Visibility</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-base">
                        <tr v-if="posts.loading">
                            <td colspan="100%">
                                <div class="flex justify-center">
                                    <span
                                        class="loading loading-bars loading-lg"
                                    ></span>
                                </div>
                            </td>
                        </tr>

                        <tr v-else-if="!posts.records?.data?.length">
                            <td colspan="100%">
                                <div>No Data</div>
                            </td>
                        </tr>

                        <template v-else>
                            <tr v-for="row in posts.records?.data">
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div
                                                class="mask mask-squircle w-12 h-12"
                                            >
                                                <img
                                                    src="/tailwind-css-component-profile-2@56w.png"
                                                    alt="Avatar Tailwind CSS Component"
                                                />
                                            </div>
                                        </div>
                                        <div>
                                            <router-link
                                                :to="{
                                                    name: 'post-edit',
                                                    params: { id: row.id },
                                                }"
                                                class="block font-semibold pb-2 tracking-wide underline underline-offset-2 hover:underline-offset-4 duration-100"
                                            >
                                                {{ row.title }}
                                            </router-link>
                                            <div
                                                class="flex items-center gap-2 flex-wrap"
                                            >
                                                <div
                                                    v-for="tag in row.tags"
                                                    type="button"
                                                    class="badge"
                                                >
                                                    {{ tag.title }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-sm">
                                    <div
                                        class="dropdown dropdown-hover dropdown-top"
                                    >
                                        <div tabindex="0">
                                            {{
                                                formatDate(row.updated_at, {
                                                    withTime: true,
                                                })
                                            }}
                                        </div>
                                        <ul
                                            tabindex="0"
                                            class="dropdown-content z-10 p-2 shadow bg-base-100 rounded text-xs space-y-2"
                                        >
                                            <li v-if="row.first_published_at">
                                                <p class="font-medium">
                                                    Published at:
                                                </p>
                                                <p>
                                                    {{
                                                        formatDate(
                                                            row.first_published_at,
                                                            {
                                                                withTime: true,
                                                            }
                                                        )
                                                    }}
                                                </p>
                                            </li>
                                            <li>
                                                <p class="font-medium">
                                                    Created at:
                                                </p>
                                                <p>
                                                    {{
                                                        formatDate(
                                                            row.created_at,
                                                            {
                                                                withTime: true,
                                                            }
                                                        )
                                                    }}
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <label class="label cursor-pointer">
                                        <input
                                            type="checkbox"
                                            class="toggle"
                                            :checked="row.is_visible"
                                        />
                                    </label>
                                </td>
                                <th class="flex gap-2">
                                    <button class="btn btn-outline btn-sm">
                                        Edit
                                    </button>
                                    <button
                                        class="btn btn-outline btn-sm btn-error"
                                    >
                                        Delete
                                    </button>
                                </th>
                            </tr>
                        </template>
                    </tbody>
                    <tfoot class="text-base">
                        <tr>
                            <!-- <th></th> -->
                            <th>Title</th>
                            <th>Last Updated</th>
                            <th>Visbility</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mt-4 py-4 flex justify-center">
                <Pagination
                    :links="posts.records?.meta?.links"
                    @handle-click="(url) => posts.fetchRecords(url)"
                />
            </div>
        </Container>
    </div>
</template>
