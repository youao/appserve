import { createWebHistory, createRouter } from "vue-router";

const routes = [
  { path: "/", name: "index", component: () => import("@/pages/index.vue") },
  { path: "/user", name: "user", component: () => import("@/pages/user.vue") },
  {
    path: "/:pathMatch(.*)*",
    name: "404",
    component: () => import("@/pages/404.vue")
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach(async (to, from, next) => {
  console.log(to, from);
  next();
});

export default router;
