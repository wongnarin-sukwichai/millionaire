<template>
    <div
        class="w-full p-2 text-center bg-white border-dashed border-2 border-gray-200 rounded-lg sm:p-2 cursor-pointer hover:border-gray-300"
        @click="showModal()"
    >
        <box-icon
            name="plus"
            color="#d1d5db"
            size="md"
            animation="tada-hover"
        ></box-icon>
    </div>
    <div
        class="w-full mt-8 sm:p-8 p-8 text-center text-5xl text-sky-700 bg-white border-dashed border-2 border-sky-200 rounded-lg cursor-pointer hover:border-gray-300"
    >
        {{ showGroup.title }}
    </div>
    <div class="grid sm:grid-cols-3 lg:grid-cols-4 gap-3 mt-8">
        <div
            class="relative w-full sm:w-auto bg-green-400 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5"
            v-for="(topic, index) in showTopic"
            :key="index"
        >
            {{ topic.title }}
            <div class="absolute end-2.5 bottom-1">
                <box-icon
                    name="trash"
                    size="sm"
                    color="white"
                    class="cursor-pointer"
                    animation="tada-hover"
                    @click="delTopic(topic.id, index)"
                ></box-icon>
            </div>
        </div>
    </div>

    <!-- Modal Show -->
    <transition name="fade" mode="out-in">
        <div
            class="relative z-10"
            aria-labelledby="modal-title"
            role="dialog"
            aria-modal="true"
            v-show="isModalShow"
        >
            <div
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
            ></div>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div
                    class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"
                >
                    <div
                        class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
                    >
                        <form @submit.prevent="sendTopic()">
                            <div class="bg-white px-4 pt-5 sm:p-4 sm:pb-2">
                                <div class="sm:flex sm:items-start">
                                    <div
                                        class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-200 sm:mx-0 sm:h-10 sm:w-10"
                                    >
                                        <box-icon
                                            name="plus"
                                            color="#fff"
                                        ></box-icon>
                                    </div>
                                    <div
                                        class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full"
                                    >
                                        <label
                                            id="listbox-label"
                                            class="block text-sm font-medium leading-6 text-gray-900"
                                        >
                                            ชื่อเรื่อง :</label
                                        >
                                        <input
                                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                            required
                                            v-model="data.title"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div
                                class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6"
                            >
                                <button
                                    type="submit"
                                    class="inline-flex w-full justify-center rounded-md bg-green-400 px-3 py-2 text-sm text-white shadow-sm hover:bg-green-00 sm:ml-3 sm:w-auto"
                                >
                                    บันทึกข้อมูล
                                </button>
                                <button
                                    type="button"
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm text-gray-900 shadow-sm hover:bg-gray-200 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                                    @click="closeModal()"
                                >
                                    ปิด
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
import "boxicons";
import Swal from "sweetalert2";

export default {
    mounted() {
        this.getGroup();
        this.getTopic();
    },
    data() {
        return {
            showGroup: "",
            showTopic: "",
            isModalShow: false,
            data: {
                id: this.$route.params.id,
                title: "",
            },
        };
    },
    methods: {
        getGroup() {
            axios
                .get("/api/group/" + this.$route.params.id)
                .then((response) => {
                    this.showGroup = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        getTopic() {
            axios
                .get("/api/editTopic/" + this.$route.params.id)
                .then((response) => {
                    this.showTopic = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async sendTopic() {
            try {
                await this.$store.dispatch("storeTopic", this.data);
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "บันทึกข้อมูลเรียบร้อย",
                    showConfirmButton: false,
                    timer: 1500,
                });
                this.getGroup();
                this.getTopic();
                this.isModalShow = false;
            } catch (err) {
                console.log(err);
                Swal.fire({
                    icon: "error",
                    title: "ผิดพลาด",
                    text: "เพิ่มข้อมูลไม่ได้ กรุณาติดต่อเจ้าหน้าที่",
                    timer: 1500,
                });
            }
        },
        delTopic(id, index) {
            Swal.fire({
                title: "ต้องการลบข้อมูล?",
                text: "ยืนยันการลบข้อมูลหรือไม่",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .delete("/api/topic/" + id)
                        .then((response) => {
                            //console.log(res);
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                    this.showTopic.splice(index, 1);
                    Swal.fire("ลบข้อมูล!", "ลบข้อมูลเรียบร้อย", "success");
                }
            });
        },
        showModal() {
            this.isModalShow = true;
        },
        closeModal() {
            this.isModalShow = false;
        },
    },
};
</script>
