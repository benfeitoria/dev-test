
require('./bootstrap');
window.Vue = require('vue');

import moment from 'moment';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faTrash, faPen } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faTrash)
library.add(faPen)

Vue.component('font-awesome-icon', FontAwesomeIcon)

window.moment = moment;

moment.locale('pt-br');

//Components

//Posts
import list_posts from './components/post/list.vue';
import admin_posts from './components/post/admin.vue';
import view_post from './components/post/view.vue';
import add_post from './components/post/add.vue';
import edit_post from './components/post/edit.vue';

//Categories
import list_categories from './components/category/list.vue';
import add_category from './components/category/add.vue';
import edit_category from './components/category/edit.vue';

const app = new Vue({
    el: '#app',
    components: {
        //Post
        list_posts,
        admin_posts,
        view_post,
        add_post,
        edit_post,
        //Categories
        list_categories,
        add_category,
        edit_category
    }
});