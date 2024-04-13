<script setup>
import Container from "@/components/Container.vue";
import Pagination from "@/components/Pagination.vue";
import { onMounted } from "vue";
import { apiBasePath, formatDate } from "@/utils";
import { useLoadData } from "@/composables/loadData";
import ModalConfirmation from "@/components/ModalConfirmation.vue";
import { useConfirmable } from "@/composables/confirmable";
import axios from "axios";

const tags = useLoadData(apiBasePath("tags"));
const tagRemoving = useConfirmable({
    setTitle(data) {
        return `Are you sure to remove Tag "${data.title}"?`;
    },
    confirm(data, instance) {
        axios.delete(apiBasePath(`tags/${data.id}/destroy`)).then(() => {
            tags.fetchData();
            instance.close();
        });
    },
});

const toggleVisibility = (tag) => {
    axios.patch(apiBasePath(`tags/${tag.id}/toggle-visibility`));
};

onMounted(() => {
    document.title = "Tags - Ngeblog Administration";
    tags.fetchData();
});
</script>

<template>
    <div>
        <Container>
            <div class="mb-8">
                <h1
                    class="flex items-center gap-2 text-2xl font-bold tracking-wide"
                >
                    <span>Tags List</span>
                    <span
                        v-if="tags.loading"
                        class="loading loading-bars loading-md"
                    ></span>
                    <span v-else v-text="`(${tags.data?.meta?.total})`" />

                    <router-link
                        :to="{ name: 'tags-create' }"
                        class="btn btn-primary btn-sm ml-4"
                    >
                        + New Tag
                    </router-link>
                </h1>
            </div>

            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="text-base">
                        <tr>
                            <th class="min-w-80">Title</th>
                            <th>Posts Count</th>
                            <th>Last Updated</th>
                            <th>Visibility</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-base">
                        <tr v-if="tags.loading">
                            <td colspan="100%">
                                <div class="flex justify-center">
                                    <span
                                        class="loading loading-bars loading-lg"
                                    ></span>
                                </div>
                            </td>
                        </tr>

                        <tr v-else-if="!tags.data?.data?.length">
                            <td colspan="100%">
                                <div>No Data</div>
                            </td>
                        </tr>

                        <template v-else>
                            <tr v-for="row in tags.data?.data">
                                <td>
                                    <router-link
                                        :to="{
                                            name: 'tags-edit',
                                            params: { id: row.id },
                                        }"
                                        class="inline-block pb-2 font-semibold tracking-wide underline underline-offset-2 duration-100 hover:underline-offset-4"
                                    >
                                        {{ row.title }}
                                    </router-link>
                                </td>
                                <td>{{ row.posts_count }} Posts</td>
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
                                    <label
                                        class="label inline-flex cursor-pointer"
                                    >
                                        <input
                                            type="checkbox"
                                            class="toggle"
                                            :checked="row.is_visible"
                                            @change="toggleVisibility(row)"
                                        />
                                    </label>
                                </td>
                                <th class="flex gap-2">
                                    <router-link
                                        :to="{
                                            name: 'tags-edit',
                                            params: { id: row.id },
                                        }"
                                        class="btn btn-outline btn-sm"
                                    >
                                        Edit
                                    </router-link>
                                    <button
                                        type="button"
                                        @click="tagRemoving.open(row)"
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
                    :links="tags.data?.meta?.links"
                    @handle-click="(url) => tags.fetchData(url)"
                />
            </div>
        </Container>

        <ModalConfirmation
            :show="tagRemoving.show"
            @close="tagRemoving.close()"
            @confirm="tagRemoving.triggerConfirm()"
            v-bind="tagRemoving.props"
        />
    </div>
</template>
