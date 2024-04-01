import {createRouter, createWebHistory} from "vue-router";

const routes =[
    {
        path: '/dashboard',
        name: 'dashboard',
        component : Dashboard
    },
    
];

const router=createRouter({
    history: createWebHistory(),//userii vor fi domain.com/users fara #
    routes
})

export default router
