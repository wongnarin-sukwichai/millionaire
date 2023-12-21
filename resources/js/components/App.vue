<template>
    <main>

        <router-view v-slot="{ Component, route }">
            <transition name="fade" mode="out-in">
                <div :key="route.name">
                    <component :is="Component"> </component>
                </div>
            </transition>
        </router-view>
        
    </main>
</template>

<script>
export default {
    mounted() {
        console.log("Component mounted.");
    },
};
</script>
