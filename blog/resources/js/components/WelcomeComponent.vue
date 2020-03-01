<template>

    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Seja bem vindo!</h1>
            <hr>
        </div>
        <div class="col-md-3 ml-2 mr-1 mb-4  bg-light">
            <div class="form-group col-md-12">
                <label>Pesquisa</label>
                <input class="form-control text-center" v-model="search">
            </div>
            <div class="form-group col-md-12">
                <label>Categoria</label>
                <select class="form-control" v-model="searchCategoryId">
                    <option value="">--Todos--</option>
                    <option v-for="category of categories" :value="category.id">{{category.name}}</option>
                </select>
            </div>
            <div class="form-group col-md-12">
                <label>Autor</label>
                <select class="form-control" v-model="authorId">
                    <option value="">--Todos--</option>
                    <option v-for="author of authors" :value="author.id">{{author.name}}</option>
                </select>
            </div>
            <div class="btn-group col-md-12">
                <a class="btn btn-primary text-white" @click="getSearch">Filtrar</a>
                <a class="btn btn-secondary text-white" @click="clearSearch">Limpar</a>
            </div>
        </div>
        <div class="col-md-8 bg-white rounded p-2">
            <div class="row">

                <div class="col-md-4 mb-4" v-for="post of posts">
                    <a :href="'post-show/'+post.id" class="link-card">
                    <div class="card">
                        <img :src="post.urlImage" class="card-img-top" style="max-height:150px">
                        <div class="card-body">
                            <h5 class="card-title">{{post.title}}</h5>
                            <p class="card-text">{{getContentShort(post.content)}}</p>
                        </div>
                        <div class="card-footer">
                            Data de publicação: {{post.publicationDatePtBr}}
                        </div>
                    </div>
                    </a>
                </div>

                <div v-if="posts.length < 1" class="col-md-12 m-2">
                    <h3  class="text-center">Nenhum post encontrado!</h3>
                </div>
                <div class="col-md-12">
                    <paginate-component
                        :total="paginate.total"
                        :current="paginate.page"
                        :action="getRecentPosts"
                        @resetCurrent="paginate.page = $event"
                    />
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import paginateModel from "../model/paginate";
    import PaginateComponent from "./PaginateComponent";

    export default {
        name: "WelcomeComponent",
        components: {PaginateComponent},
        data: function () {
            return {
                posts: [],
                authors:[],
                categories:[],
                urlApi: 'api/home',
                search:'',
                searchCategoryId:'',
                paginate: new paginateModel(),
                authorId:''
            }
        },
        mounted() {
            this.getRecentPosts();
            this.getCategories();
            this.getAuthors();
        },
        methods: {
            getSearch:function(){
                this.paginate = new paginateModel();
               this.getRecentPosts();
            },
            clearSearch:function(){
               this.search = '';
               this.searchCategoryId='';
               this.authorId='';
               this.paginate = new paginateModel();
               this.getRecentPosts();
            },
            getRecentPosts: async function () {
                try {
                    const resp = await axios.get(`${this.urlApi}/posts/?page=${this.paginate.page}&search=${this.search}&category_id=${this.searchCategoryId}&author_id=${this.authorId}`);
                    const data = await resp.data;
                    this.posts = data.data;
                    this.paginate.total = data.last_page;
                } catch (e) {
                    Vue.$toast.error("Ocorreu um erro!");
                }
            },
            getContentShort: function (content) {
                const regex = /(<[^>]+>|<[^>]>|<\/[^>]>)/g;
                return content.replace(regex, '').substr(0, 50) + '...';
            },
            getCategories: async function(){
                try {
                    const resp = await axios.get(`${this.urlApi}/categories`);
                    const data = await resp.data;
                    this.categories = data;
                } catch (e) {
                    Vue.$toast.error("Ocorreu um erro!");
                }
            },
            getAuthors: async function(){
                try {
                    const resp = await axios.get(`${this.urlApi}/authors`);
                    const data = await resp.data;
                    this.authors = data;
                } catch (e) {
                    Vue.$toast.error("Ocorreu um erro!");
                }
            }
        },
    }
</script>

<style scoped>
.link-card{
    text-decoration: none;
}
</style>
