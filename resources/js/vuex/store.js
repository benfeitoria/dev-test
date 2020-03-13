//importa o vue
import Vue from 'vue'
//importa o vuex
import Vuex from 'vuex'

import post from "./post/post";
import categoria from "./categoria/categoria";
import autor from "./autor/autor";

//vue usa o vuex
Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        //aqui vem a importação de todos os vuex dos modulos exemplo abaixo:
       post,
       categoria,
       autor
    }
})

export default store