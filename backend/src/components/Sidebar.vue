<template>
    <div class="w-[200px] transition-all text-gray-800 bg-yellow-400 py-4 px-2">
        <router-link :to= "{name: 'app.dashboard'}" class="flex items-center py-1 px-3 rounded transition-colors hover:bg-yellow-500/40 mb-2">
            <span class="mr-2">
                <HomeIcon class="w-4"></HomeIcon>
            </span>
            <span>
                Dashboard
            </span>
        </router-link>
        <router-link :to= "{name: 'app.products'}" class="flex items-center py-1 px-3 rounded transition-colors hover:bg-yellow-500/40 mb-2">
            <span class="mr-2">
                <ViewListIcon class="w-4"></ViewListIcon>
            </span>
            <span>
                Products
            </span>
        </router-link>
        <router-link :to= "{name: 'app.dashboard'}" class="flex items-center py-1 px-3 rounded transition-colors hover:bg-yellow-500/40 mb-2">
            <span class="mr-2">
                <UsersIcon class="w-4"></UsersIcon>
            </span>
            <span>
                Users
            </span>
    </router-link>
        <router-link :to= "{name: 'app.dashboard'}" class="flex items-center py-1 px-3 rounded transition-colors hover:bg-yellow-500/40 mb-2">
            <span class="mr-2">
                <ChartBarIcon class="w-4"></ChartBarIcon>
            </span>
            <span>
                Reports
            </span>
        </router-link>


    </div>
</template>

<script setup>
    import {HomeIcon, UsersIcon, ViewListIcon, ChartBarIcon} from '@heroicons/vue/outline'
</script>

<style scoped>

</style>
