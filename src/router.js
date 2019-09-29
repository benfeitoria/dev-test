import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
import Postagem from './views/Postagem.vue'
import CadastroPost from './views/CadastroPost.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    { path: '/',name: 'home', component: Home},
    { path: '/cadastroPost',name: 'CadastroPost', component: CadastroPost},
    { path: '/:id',name: 'postagem', component: Postagem},
  ]
})
