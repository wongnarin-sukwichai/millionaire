<template>
    <div class="flex justify-center" ref="printcontent">
        <img :src="bg + shop.pic" class="size-full lg:size-2/5"/>
        <p
            class="first text-white absolute text-center top-40 mt-10 md:mt-20 lg:mt-5 md:top-1/4 lg:top-1/8 left-1/2 -translate-x-1/2 -translate-y-1/2 text-3xl md:text-6xl lg:text-6xl"
            style="font-family: kart"
        >
            {{ topic.title }}
        </p>

        <transition name="fade" mode="out-in">
            <table
                class="absolute text-amber-300 text-center top-64 mt-10 md:mt-20 lg:mt-0 md:top-1/2 lg:top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-4xl md:text-8xl lg:text-5xl"
                style="font-family: Muyang"
                v-if="show"
            >
                <tr>
                    <td
                        class="p-2 md:p-4 lg:p-4"
                        v-for="(num1, index) in row1"
                        :key="index"
                    >
                        {{ num1 }}
                    </td>
                </tr>
                <tr>
                    <td
                        class="p-2 md:p-4 lg:p-4"
                        v-for="(num2, index) in row2"
                        :key="index"
                    >
                        {{ num2 }}
                    </td>
                </tr>
                <tr>
                    <td
                        class="p-2 md:p-4 lg:p-4"
                        v-for="(num3, index) in row3"
                        :key="index"
                    >
                        {{ num3 }}
                    </td>
                </tr>
            </table>
        </transition>

        <p
            class="absolute text-white mt-12 md:mt-80 lg:mt-100 ml-20 md:ml-24 lg:ml-20 top-96 md:top-2/4 lg:top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 text-md md:text-6xl lg:text-4xl"
            style="font-family: Muyang"
        >
            {{ moment().format("LL") }}
        </p>
    </div>

    <div class="text-center">
        <button
            class="w-full mt-4 p-1 border-2 border-green-500 rounded-lg bg-white text-green-500 hover:bg-green-500 hover:text-white font-normal text-1xl lg:text-2xl"
            style="font-family: kart"
            @click="random()"
        >
            สุ่มข้อมูล
        </button>
    </div>

    <div class="text-center">
        <button
            class="w-full mt-4 p-1 border-2 border-sky-400 rounded-lg bg-white text-sky-400 hover:bg-sky-400 hover:text-white font-normal text-1xl lg:text-2xl"
            style="font-family: kart"
            @click.prevent="printThis()"
        >
            ดาวน์โหลด
        </button>
    </div>

    <img :src="output" />
</template>

<script>
import moment from "moment"; //format date thai
import "moment/dist/locale/th";
moment.locale("th");
import html2canvas from "html2canvas";

export default {
    mounted() {
        this.getShop();
        this.getTopic();
        this.random();
    },
    data() {
        return {
            bg: "../storage/shop/",
            row1: [],
            row2: [],
            row3: [],
            today: new Date(),
            moment: moment,
            show: false,
            output: null,
            shop: "",
            topic: "",
        };
    },
    methods: {
        getShop() {
            axios
                .get("/api/shop/")
                .then((response) => {
                    this.shop = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        getTopic() {
            axios
                .get("/api/topic/" + this.$route.params.id)
                .then((response) => {
                    this.topic = response.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        async random() {
            var i = 0;
            var j = 0;
            var k = 0;

            try {
                for (i = 0; i < 4; i++) {
                    this.row1[i] = Math.floor(Math.random() * 100);
                }

                for (j = 0; j < 4; j++) {
                    this.row2[j] = Math.floor(Math.random() * 100);
                }

                for (k = 0; k < 4; k++) {
                    this.row3[k] = Math.floor(Math.random() * 1000);
                }

                this.show = true;
            } catch (err) {
                console.log(err);
            }
        },

        async printThis() {
            // console.log("printing..");
            const el = this.$refs.printcontent;

            const options = {
                type: "dataURL",
            };
            const printCanvas = await html2canvas(el, options);

            const link = document.createElement("a");
            link.setAttribute("download", "download.png");
            link.setAttribute(
                "href",
                printCanvas
                    .toDataURL("image/png")
                    .replace("image/png", "image/octet-stream")
            );
            link.click();

            // console.log("done");
        },
    },
};
</script>

<style type="text/css">
@font-face {
    font-family: "Muyang";
    src: url("/fonts/MN-Muyang.ttf");
}

@font-face {
    font-family: "kart";
    src: url("/fonts/kart-chinesestyle.ttf");
}
</style>
