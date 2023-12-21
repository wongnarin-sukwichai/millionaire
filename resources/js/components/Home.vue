<template>
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <header class="bg-white">
            <nav
                class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8"
                aria-label="Global"
            >
                <div class="flex lg:flex-1">
                    <a href="#" class="-m-1.5 p-1.5">
                        <img class="h-12 w-auto" :src="icon" alt="" />
                    </a>
                </div>
                <div class="flex lg:hidden">
                    <button
                        type="button"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                    >
                        <svg
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            aria-hidden="true"
                            @click="show()"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                            />
                        </svg>
                    </button>
                </div>
                <div class="hidden lg:flex lg:gap-x-12">
                    <div class="relative">
                        <router-link
                            type="button"
                            class="flex items-center gap-x-1 text-sm font-semibold leading-6 text-gray-800 hover:text-gray-900"
                            aria-expanded="false"
                            to="../dashboard"
                        >
                            หน้าแรก
                        </router-link>
                    </div>

                    <router-link
                        href="#"
                        class="flex text-sm font-semibold leading-6 text-gray-900"
                        to="/group"
                        >หมวดหมู่
                    </router-link>
                    <a
                        href="#"
                        class="flex text-sm font-semibold leading-6 text-gray-900"
                        >เปลี่ยนพื้นหลัง
                    </a>
                    <a
                        href="#"
                        class="flex text-sm font-semibold leading-6 text-gray-900"
                        v-if="level"
                        >ระบบหลังบ้าน
                    </a>
                    <a
                        href="#"
                        class="text-sm font-semibold leading-6 text-red-300 hover:text-red-400"
                        @click="logout()"
                        >ออกจากระบบ</a
                    >
                </div>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                    <span
                        class="border-2 border-red-200 rounded-xl p-2 text-sm text-right text-gray-500 shadow-lg"
                    >
                        <p>{{ user.name }}</p>
                        <p>{{ user.email }}</p>
                    </span>
                </div>
            </nav>

            <!-- Mobile menu, show/hide based on menu open state. -->
            <transition name="fade" mode="out-in">
                <div
                    class="lg:hidden"
                    role="dialog"
                    aria-modal="true"
                    v-if="showNav"
                >
                    <div class="fixed inset-0 z-10"></div>
                    <div
                        class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10"
                    >
                        <div class="flex items-center justify-between">
                            <a href="#" class="-m-1.5 p-1.5">
                                <img class="h-8 w-auto" :src="icon" alt="" />
                            </a>
                            <button
                                type="button"
                                class="-m-2.5 rounded-md p-2.5 text-gray-700"
                            >
                                <svg
                                    class="h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                    @click="close()"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                        <div class="mt-6 flow-root">
                            <div class="-my-6 divide-y divide-gray-500/10">
                                <div class="space-y-2 py-6">
                                    <div class="-mx-3">
                                        <router-link
                                            type="button"
                                            class="flex w-full items-center justify-between rounded-lg py-2 pl-3 pr-3.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                                            aria-controls="disclosure-1"
                                            aria-expanded="false"
                                            to="../dashboard"
                                        >
                                            หน้าแรก
                                        </router-link>
                                    </div>
                                    <router-link
                                        href="#"
                                        class="flex text-sm font-semibold leading-6 text-gray-900"
                                        to="/group"
                                        >หมวดหมู่
                                    </router-link>
                                    <a
                                        href="#"
                                        class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                                        >เปลี่ยนพื้นหลัง</a
                                    >
                                    <a
                                        href="#"
                                        class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                                        v-if="level"
                                        >ระบบหลังบ้าน</a
                                    >
                                    <a
                                        href="#"
                                        class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-red-300 hover:text-red-400"
                                        @click="logout()"
                                        >ออกจากระบบ</a
                                    >
                                </div>
                                <div class="py-6">
                                    <box-icon
                                        name="user"
                                        color="#6b7280"
                                    ></box-icon>
                                    <span
                                        href="#"
                                        class="-mx-3 block rounded-lg px-3 py-2 text-base leading-7 text-gray-500"
                                    >
                                        <p>{{ user.name }}</p>
                                        <p>{{ user.email }}</p>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </header>

        <!-- Main -->
        <div
            class="min-h-full items-center justify-center px-4 py-4 sm:px-6 lg:px-8"
        >
            <router-view />
        </div>
    </div>
</template>

<script>
import "boxicons";

export default {
    mounted() {},
    data() {
        return {
            icon: "/img/thumbnails/main.png",
            user: "",
            showNav: false,
        };
    },
    methods: {
        async logout() {
            await this.$store.dispatch("logout");
            this.$router.push({ name: "welcome" });
        },
        show() {
            this.showNav = true;
        },
        close() {
            this.showNav = false;
        },
    },
    computed: {
        user() {
            return this.$store.getters.user;
        },
        level() {
            return this.$store.getters.level;
        },
    },
};
</script>
