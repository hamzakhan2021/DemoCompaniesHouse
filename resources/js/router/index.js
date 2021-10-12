import {createWebHistory, createRouter} from "vue-router";

import Home from '../components/Home';
import About from '../components/About';
import Product from '../components/Product';


export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'about',
        path: '/about',
        component: About
    },
    {
        name: 'product',
        path: '/product/:id',
        component: Product
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
