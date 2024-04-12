<template>
    <div class="min-h-full bg-gray-100 flex"><!--fundal -->
        <!--sidebar-->
        <Sidebar :class="{'-ml-[200px]': !sidebarOpened}"/>
        <!--sidebar-->
        <div class="flex-1">
            <Navbar @toggle-sidebar='toggleSidebar'></Navbar>
            <!--content-->
            <main class="p-6">
                <div class="p-4 rounded bg-white"> <!--chenar-->
                    <router-view></router-view>
                </div>
            </main>
            <!--content-->
        </div>
    </div>
</template>

<script setup>
import {ref,onMounted, onUnmounted} from 'vue'
import Sidebar from "./Sidebar.vue";
import Navbar from "./Navbar.vue";
const {title} = defineProps({
    title: String
})

const sidebarOpened = ref(true);
function toggleSidebar() {
    sidebarOpened.value = !sidebarOpened.value
}

onMounted(() => {
   handleSidebarOpened();
   window.addEventListener('resize', handleSidebarOpened) //de fiecare data cand fereasta isi schimba marimea, este apelata functia handleSiebarOpened
})

onUnmounted(()=>{
    window.removeEventListener('resize', handleSidebarOpened)
})
function handleSidebarOpened(){
    sidebarOpened.value = window.outerWidth > 768; //daca ecranul e mai mare de 768 atunci value=> true, altfel => false
}
</script>

<style scoped>

</style>
