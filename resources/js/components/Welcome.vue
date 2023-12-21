<template>
    <div class="flex h-screen items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <center><img :src="icon" class="cursor-pointer hover:scale-105"/></center>

            <form class="mt-8 space-y-6" @submit.prevent="login()">
                <input type="hidden" name="remember" value="true" />
                <div class="-space-y-px rounded-md shadow-sm">
                    <div>
                        <label for="email-address" class="sr-only"
                            >Email address</label
                        >
                        <input
                            type="email"
                            required
                            class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-700 placeholder-gray-400 focus:z-10 focus:border-red-300 focus:outline-none focus:ring-red-300 sm:text-sm"
                            placeholder="Email"
                            v-model="auth.email"
                        />
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input
                            type="password"
                            required
                            class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-400 focus:z-10 focus:border-red-300 focus:outline-none focus:ring-red-300 sm:text-sm"
                            placeholder="Password"
                            v-model="auth.password"
                        />
                    </div>
                </div>

                <div class="flex items-center justify-between"></div>

                <div>
                    <button
                        class="group relative flex w-full justify-center rounded-md border border-transparent bg-red-400 py-2 px-4 text-sm font-medium text-white hover:bg-red-500 "
                    >
                        เข้าสู่ระบบ
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Swal from "sweetalert2";

export default {
    mounted() {
        console.log("Component mounted.");
    },
    data() {
        return {
            icon: "img/main.png",
            auth: {
                email: "",
                password: "",
            },
        };
    },
    methods: {
        async login() {
            try {
                await this.$store.dispatch("login", this.auth);
                this.$router.push({ name: "home" });
            } catch {
                Swal.fire({
                    icon: "error",
                    title: "ผิดพลาด",
                    text: "กรุณาตรวจสอบ Email, Password",
                    timer: 1500,
                });
            }
        },
    },
};
</script>
