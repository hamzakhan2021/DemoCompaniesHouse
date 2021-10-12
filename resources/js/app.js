
import { createApp } from "vue";

import App from "./App.vue";
// import Select2Component
import Select2 from 'vue3-select2-component';

import axios from 'axios'
import router   from './router';
// Create a Vue application
const app = createApp(App);
app.config.globalProperties.$axios = axios;
// Define a new global component called button-counter
app.use(router)


// app.component('pagination', require('laravel-vue-pagination'));


app.component('Select2', Select2);

app.mount("#app");

require("./bootstrap");