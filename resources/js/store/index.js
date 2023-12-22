import { createStore } from "vuex";
import user from './modules/user';
import group from './modules/group';
import topic from "./modules/topic";

const store = createStore({
    modules:{
        user,
        group,
        topic
    }
})

export default store