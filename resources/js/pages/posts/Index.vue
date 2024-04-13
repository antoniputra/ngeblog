<script setup>
import Container from "@/components/Container.vue";
import Pagination from "@/components/Pagination.vue";
import { onMounted } from "vue";
import { apiBasePath, formatDate } from "@/utils";
import { useLoadData } from "@/composables/loadData";

const posts = useLoadData(apiBasePath("posts"));

onMounted(() => {
    document.title = "Posts - Ngeblog Administration";
    posts.fetchData();
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
                    <span v-else v-text="`(${posts.data?.meta?.total})`" />
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

                        <tr v-else-if="!posts.data?.data?.length">
                            <td colspan="100%">
                                <div>No Data</div>
                            </td>
                        </tr>

                        <template v-else>
                            <tr v-for="row in posts.data?.data">
                                <td>
                                    <div class="flex items-center gap-3">
                                        <!-- <div class="avatar">
                                            <div
                                                class="mask mask-squircle w-12 h-12"
                                            >
                                                <img
                                                    src="/tailwind-css-component-profile-2@56w.png"
                                                    alt="Avatar Tailwind CSS Component"
                                                />
                                            </div>
                                        </div> -->
                                        <div>
                                            <router-link
                                                :to="{
                                                    name: 'posts-edit',
                                                    params: { id: row.id },
                                                }"
                                                class="block pb-2 font-semibold tracking-wide underline underline-offset-2 duration-100 hover:underline-offset-4"
                                            >
                                                {{ row.title }}
                                            </router-link>
                                            <div
                                                class="flex flex-wrap items-center gap-2"
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
                                        class="dropdown dropdown-top dropdown-hover"
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
                                            class="dropdown-content z-10 space-y-2 rounded bg-base-100 p-2 text-xs shadow"
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
                                                            },
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
                                                            },
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
                                        class="btn btn-outline btn-error btn-sm"
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

            <div class="mt-4 flex justify-center py-4">
                <Pagination
                    :links="posts.data?.meta?.links"
                    @handle-click="(url) => posts.fetchData(url)"
                />
            </div>
        </Container>
    </div>
</template>
