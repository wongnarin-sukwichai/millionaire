
/** หน้าที่หลักๆของ Vuex คือการดึงข้อมูลจาก database จากนั้นเราก็นำข้อมูลที่ได้นั้นมาเตรียมข้อมูลไว้่ เพื่อให้เราสะดวกในการนำไปแสดงที่หน้าเว็บไซต์ผ่าน computed อีกที */

export default {
    //สร้างตัวแปรนั่นแหละ
    state() {
        return {
            group: null,
        };
    },
    actions: {
        //action ส่วนในการคำนวณ ติดต่อข้อมูล api จาก backend ในที่นี้คือ axios ของ laravel นั่นเอง
        async storeGroup({ dispatch }, payload) {
            //async มาคู่กับ await เสมอ | dispatch เป็นการรับข้อมูลจาก function จาก .vue ในที่นี้รับจาก Login.vue
            //console.log(payload);
            try {
                await axios.get("/sanctum/csrf-cookie"); //await การ process ข้อมูลโดยบังคับให้ต้องรอ กระบวนการนี้เสร็จก่อนจึงจะสามารถไปทำ process อื่นๆได้

                await axios
                    .post("/api/group", payload) //ไปที่ routes->api->login
                    .then((response) => {
                       
                    })
                    .catch((err) => {
                        throw err.response;
                        
                    });
            } catch (e) {
                throw e;
            }
        },    
              
    },
};
