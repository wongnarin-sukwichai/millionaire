<template>
    <div
        class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow-lg sm:p-8 mb-8"
        v-for="(group, index) in showGroup"
        :key="index"
    >
        <div class="flex justify-end">
            <box-icon
                name="cog"
                size="sm"
                color="#d1d5db"
                animation="tada-hover"
                class="cursor-pointer"
                @click="editTopic(group.id)"
            ></box-icon>
        </div>
        <h5 class="mb-2 text-5xl text-sky-700">{{ group.title }}</h5>
        <p class="m-5 text-gray-400 text-sm">
            ประจำวันที่ : {{ moment().format("LL") }}
        </p>
        <div
            class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 rtl:space-x-reverse"
        >
            <template v-for="(topic, index) in showTopic" :key="index">
                <div
                    class="text-left rtl:text-right"
                    v-if="topic.group_id === group.id"
                >
                    <a
                        href="#"
                        class="w-full sm:w-auto bg-green-400 hover:bg-green-500 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5"
                        @click="link(topic.id)"
                    >
                        <div class="text-sm">{{ topic.title }}</div>
                    </a>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
import moment from "moment"; //format date thai
import "moment/dist/locale/th";
moment.locale("th");

export default {
    mounted() {
        this.getGroup();
        this.getTopic();
    },
    data() {
        return {
            moment: moment,
            showGroup: "",
            showTopic: "",
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
        getTopic() {
            axios
                .get("/api/topic")
                .then((response) => {
                    this.showTopic = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        link(id) {
            this.$router.push("/topic/" + id);
        },
        edit(id) {
            this.$router.push("/editTopic/" + id);
        }
    },
};
</script>
