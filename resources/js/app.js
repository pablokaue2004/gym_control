import { createApp } from "vue";
import router from "./router/index.js";
import App from "./App.vue";
import VueApexCharts from "vue3-apexcharts";
const app = createApp(App).use(VueApexCharts);
app.use(router).mount("#app");
