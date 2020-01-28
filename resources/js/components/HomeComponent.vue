<template>
    <div class="container">
        <h1>Articles</h1>
        <article v-for='post in articles' :key='post.id'>
            <header>
                <h1>{{post.title}}</h1>
            </header>
            <main>
                <aside><img v-bind:src="post.image"></aside>
            </main>
            <aside>
                {{post.content}}
            </aside>
            <footer>
                {{post.name}}
            </footer>
        </article>
    </div>
</template>

<script>

    export default {
        name: "HomeComponent",
        mounted() {
            console.log();
            this.getArticles();
        },
        data(){
            return{
                articles:[],
            }
        },

        methods:{
            getArticles(){
                self = this;
                axios.get('../api/allarticles').then(function(res){
                    self.articles = res.data;
                });
            }
        }

    }
</script>

<style scoped>

</style>
