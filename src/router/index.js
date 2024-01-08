import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/auth/Loginview.vue'
import DashboardView from '../views/DashboardView.vue'
import Logout from '../views/auth/Logout.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/login',
      name: 'Halaman Login',
      component: LoginView
    },
    {
      path: '/logout',
      name: 'Wait Logout',
      component: Logout
    },
    {
        path: '/dashboard',
        name: 'Halaman Dashboard',
        component: DashboardView
    }
  ]
})

router.beforeEach((to, from, next) => {
  document.title = to.name;
  next();
});

export default router
