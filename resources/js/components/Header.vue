<template>
    <div class="mb-8 border-b border-teal-100 bg-teal-50">
        <div class="mx-auto max-w-7xl">
            <div class="navbar py-0">
                <div class="navbar-start">
                    <div class="dropdown">
                        <div
                            tabindex="0"
                            role="button"
                            class="btn btn-ghost lg:hidden"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h8m-8 6h16"
                                />
                            </svg>
                        </div>

                        <MenuList
                            tabindex="0"
                            class="menu dropdown-content menu-sm z-10 mt-3 w-60 rounded-box bg-base-100 p-2 shadow"
                        />
                    </div>

                    <router-link
                        :to="{ name: 'dashboard' }"
                        class="btn btn-ghost !bg-transparent text-xl"
                    >
                        <img
                            src="https://raw.githubusercontent.com/antoniputra/ngeblog/master/publishable/assets/img/logo.png"
                            class="h-8 md:h-10"
                        />
                    </router-link>
                </div>

                <div class="navbar-center hidden lg:flex">
                    <MenuList class="menu menu-horizontal gap-1 px-1" />
                </div>

                <div class="navbar-end">
                    <div class="dropdown dropdown-end">
                        <div
                            tabindex="0"
                            role="button"
                            class="flex items-center gap-1 rounded-lg px-3 py-1 text-base font-semibold tracking-wide hover:bg-teal-100 md:text-lg"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke="none"
                                    d="M0 0h24v24H0z"
                                    fill="none"
                                />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            <span>New</span>
                        </div>
                        <ul
                            tabindex="0"
                            class="menu dropdown-content z-10 w-52 rounded-box bg-base-100 p-2 text-lg shadow"
                        >
                            <li>
                                <router-link
                                    :to="{ name: 'posts-create' }"
                                    class="hover:bg-teal-100 focus:bg-teal-100"
                                >
                                    New Post
                                </router-link>
                            </li>
                            <li>
                                <router-link
                                    :to="{ name: 'tags-create' }"
                                    class="hover:bg-teal-100 focus:bg-teal-100"
                                >
                                    New Tag
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import MenuList from "./MenuList.vue";
</script>
