<script setup>
import Container from "@/components/Container.vue";
import Pagination from "@/components/Pagination.vue";
import axios from "axios";
import { onMounted, reactive } from "vue";
import { apiBasePath } from "@/utils";

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
                            <th>Tags</th>
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
                                            <div class="font-bold">
                                                {{ row.title }}
                                            </div>
                                            <div class="text-sm opacity-50">
                                                United States
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    Zemlak, Daniel and Leannon
                                    <br />
                                    <span class="badge badge-ghost badge-sm">
                                        Desktop Support Technician
                                    </span>
                                </td>
                                <td>Purple</td>
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
                            <th>Tags</th>
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
