<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="row">
                    <div class="col-md-5">
                        <h2>Gerencie Seus Artigos</h2>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control pull-right" placeholder="Procure seus artigos por titulo ou categoria" v-model="search">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="search">Busca</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Título</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for='post in articles.data' :key='post.articlesId'>
                        <th scope="row">{{post.articlesId}}</th>
                        <td>{{post.title}}</td>
                        <td>{{post.categoryName}}</td>
                        <td>{{post.author}}</td>
                        <td><a v-bind:href="'/setArticle/' + post.articlesId"> <button class="btn btn-success">editar</button></a>  <button @click="deleteArticle(post.articlesId)" class="btn btn-danger">Excluir</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-2">
                <a href="/addArticle"><button class="button btn btn-success" style="margin-bottom:15px;">Criar Artigo</button></a>
                <a href="/addCategory"><button class="button btn btn-success">Gerenciar Categorias</button></a>
            </div>
        </div>
        <paginate :data="articles" @pagination-change-page="getArticles"></paginate>
    </div>
</template>

<script>
    import paginate from 'laravel-vue-pagination';
    export default {
        name: "DashboardComponent",
        mounted() {
            console.log();
            this.getArticles();
        },
        components: {
            paginate,
        },
        data(){
            return{
                articles:{},
                search:[]
            }
        },
        watch:{
            search(after,before){
                this.getArticles();
            }
        },
        methods:{
            getArticles(page =1) {
                self =this;
                axios.get('../api/allarticles?page=' + page,{params:{search:self.search}})
                    .then(response => {
                        self.articles = response.data;
                        //console.log(this.articles.data);
                    });
            },
            deleteArticle(id){
                console.log(id);
                self = this;
                if(!confirm('Tem certeza que deseja excluir este artigo?'))return;
                axios.delete('../api/articles/' + id ).then(function(res){
                    self.getArticles();
                });

            }
        }
    }
</script>

<style scoped>

</style>
