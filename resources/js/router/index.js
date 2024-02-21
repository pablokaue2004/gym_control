import { createRouter, createWebHistory } from "vue-router";
import Login from "../components/Login.vue";
import Main from "../components/Main/Main.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: "/",
            name: "login",
            component: Login,
            meta: { requiresAuth: false }, // Login doesn't require auth
        },
        {
            path: "/main",
            name: "main",
            component: Main,
            meta: { requiresAuth: true }, // Main requires auth
        },
    ],
});

router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some((record) => record.meta.requiresAuth);
    const isAuthenticated = localStorage.getItem("token");

    if (requiresAuth && !isAuthenticated) {
        console.warn("Unauthorized access: Redirecting to Login");
        next({ name: "login" });
    } else if (!requiresAuth && isAuthenticated) {
        console.warn("User is already authenticated: Redirecting to Main");
        next({ name: "main" });
    } else {
        next();
    }
});

export default router;
