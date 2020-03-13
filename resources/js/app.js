require('./bootstrap');

window.Vue = require('vue');


/*IMPORTA O VUEX */
import store from './vuex/store'
//bases
Vue.component('row-component', require('./components/layouts/RowComponent').default);
Vue.component('card-component', require('./components/layouts/CardComponent').default);
Vue.component('column-component', require('./components/layouts/ColumnComponent').default);


import ExampleComponent from "./components/ExampleComponent";

//sistema
import DataTable from './components/sistema/layouts/DataTableComponent';
import BuscaSimples from './components/sistema/layouts/BuscaSimplesComponent'
import ImagePreview from './components/sistema/layouts/ImagePreviewComponent'

//site
import ListPosts from "./components/frontend/pages/ListPostsComponent";
import PostView from "./components/frontend/pages/PostViewComponent";


// URL DA API PARA NÃO GERAR PROBLEMAS COM O CAMINHO DAS ROTAS DO BLADE

const app = new Vue({
    el: '#app',
    store,
    components: {
        DataTable,
        BuscaSimples,
        ImagePreview,
        ExampleComponent,
        ListPosts,
        PostView
    },
});
