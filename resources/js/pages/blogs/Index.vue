<template>
    <div>
        <Container>
            <div class="mb-8">
                <h1 class="text-2xl font-bold tracking-wide">Blog List (69)</h1>
            </div>

            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="text-base">
                        <tr>
                            <th>
                                <label>
                                    <input type="checkbox" class="checkbox" />
                                </label>
                            </th>
                            <th>Title</th>
                            <th>Tags</th>
                            <th>Visibility</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="text-base">
                        <tr>
                            <th>
                                <label>
                                    <input type="checkbox" class="checkbox" />
                                </label>
                            </th>
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
                                            Hart Hagerty
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
                            <th>
                                <button class="btn btn-ghost btn-xs">
                                    details
                                </button>
                            </th>
                        </tr>
                    </tbody>
                    <tfoot class="text-base">
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Job</th>
                            <th>Favorite Color</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </Container>
    </div>
</template>

<script setup>
import Container from "@/components/Container.vue";
</script>
