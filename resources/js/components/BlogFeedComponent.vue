<template>
    <div class="container">

        <div class="row">
            <div class="col-md-6"><h1>Feed de Artigos</h1></div>
            <div class="col-md-6"><div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Busque os artigos que desejar por título, categoria ou autor" v-model="search">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="search">Busca</button>
                </div>
            </div></div>


        </div>
        <hr>
        <div class="row">
        <div class="col-md-3" v-for='post in articles.data' :key='post.articlesId'>
            <div class="card" style="margin-bottom:15px;">
                <img :src="post.image" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">{{post.title}}.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Categoria:{{post.categoryName}}</li>
                    <li class="list-group-item">Autor:{{post.author}}</li>
                </ul>
                <div class="card-body">
                    <a :href="'/showArticle/' + post.articlesId" class="card-link">Veja o artigo</a>
                </div>
            </div>
        </div>
        </div>

        <paginate :data="articles" @pagination-change-page="getArticles"></paginate>
    </div>
</template>
<script>
    import paginate from 'laravel-vue-pagination';
    export default {
        name: "BlogFeedComponent",
        created() {
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
                axios.get('../api/allarticles?page=' + page,{params:{search:this.search}})
                    .then(response => {
                        self.articles = response.data;
                        //console.log(this.articles.data);
                    });
            }
        }

    }
</script>

<style scoped>

</style>
