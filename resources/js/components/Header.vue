<template>
    <div class="bg-teal-50 border-b border-teal-100 mb-8">
        <div class="max-w-7xl mx-auto">
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
                            class="menu menu-sm dropdown-content mt-3 z-10 p-2 shadow bg-base-100 rounded-box w-60"
                        />
                    </div>

                    <router-link
                        :to="{ name: 'dashboard' }"
                        class="btn btn-ghost text-xl !bg-transparent"
                    >
                        <img
                            src="https://raw.githubusercontent.com/antoniputra/ngeblog/master/publishable/assets/img/logo.png"
                            class="h-8 md:h-10"
                        />
                    </router-link>
                </div>

                <div class="navbar-center hidden lg:flex">
                    <MenuList class="menu menu-horizontal px-1 gap-1" />
                </div>

                <div class="navbar-end">
                    <div class="dropdown dropdown-end">
                        <div
                            tabindex="0"
                            role="button"
                            class="flex items-center hover:bg-teal-100 text-base md:text-lg gap-1 py-1 px-3 rounded-lg font-semibold tracking-wide"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="w-5 h-5"
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
                            class="dropdown-content z-10 menu p-2 shadow bg-base-100 rounded-box w-52 text-lg"
                        >
                            <li>
                                <router-link
                                    :to="{ name: 'post-create' }"
                                    class="hover:bg-teal-100 focus:bg-teal-100"
                                >
                                    New Blog
                                </router-link>
                            </li>
                            <li>
                                <router-link
                                    :to="{ name: 'tag-create' }"
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
