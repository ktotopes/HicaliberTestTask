import './bootstrap';
import { createApp } from "vue/dist/vue.esm-bundler" // components
import VHouseList from "./components/House/VHouseList.vue";


const app = createApp({})

app.component('v-house-list', VHouseList)

app.mount('#app')
