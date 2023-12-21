<template>
    <div
        class="w-full p-2 text-center bg-white border-dashed border-2 border-gray-200 rounded-lg sm:p-2 cursor-pointer hover:border-gray-300"
    >
        <box-icon
            name="plus"
            color="#d1d5db"
            size="md"
            animation="tada-hover"
        ></box-icon>
    </div>
    <div class="grid sm:grid-cols-3 lg:grid-cols-4  gap-3 mt-8">
        <div
            class="relative w-full sm:w-auto bg-green-400 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5"
            v-for="(group, index) in showGroup"
            :key="index"
        >
            {{ group.title }}
            <div class="absolute end-2.5 bottom-1">
                <box-icon name="trash" size="sm" color="white" class="cursor-pointer" animation="tada-hover"
                @click="delGroup(group.id, index)"
                ></box-icon>
            </div>
        </div>
    </div>
</template>

<script>
import "boxicons";
import Swal from "sweetalert2";

export default {
    mounted() {
        this.getGroup();
    },
    data() {
        return {
            showGroup: "",
        };
    },
    methods: {
        getGroup() {
            axios
                .get("/api/group")
                .then((response) => {
                    this.showGroup = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        delGroup(id, index) {
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
                        .delete("/api/group/" + id)
                        .then((response) => {
                            //console.log(res);
                        })
                        .catch((err) => {
                            //console.log(err);
                        });
                    this.showGroup.splice(index, 1);
                    Swal.fire("ลบข้อมูล!", "ลบข้อมูลเรียบร้อย", "success");
                }
            });
        }
    },
};
</script>
