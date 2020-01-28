<template>
    <div class="container">
        <h1>Adicione aqui seu artigo!</h1>
        <form @submit.prevent="submit">
            <div class="form-group">
                <label for="title">Titulo</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Titulo" v-model="fields.title">
                <div v-if="errors && errors.title" class="text-danger">{{ errors.title[0] }}</div>
            </div>
            <div class="form-group">
                <label for="category">Escolha a qual categoria pertence o seu artigo:</label>
                <select class="form-control" id="category" name="category" v-model="fields.category">
                    <option v-for="category in categories" :key="category.id" :value="category.id" >{{category.name}}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="content">Escreva seu artigo:</label>
                <textarea class="form-control" id="content" name="content" rows="3" v-model="fields.content"></textarea>
                <div v-if="errors && errors.content" class="text-danger">{{ errors.content[0] }}</div>
            </div>
            <div class="form-group">
                <label for="image">Imagem</label>
                <input type="file" class="form-control" id="image" name="image" v-on:change="onImageChange">
                <div v-if="errors && errors.image" class="text-danger">{{ errors.image[0] }}</div>
            </div>
            <div class="form-group">
                <input type="submit" value="Enviar" >
            </div>

            <div v-if="success" class="alert alert-success mt-3">
                Artigo salvo!
            </div>
        </form>
    </div>
</template>

<script>
    export default {

        name: "ArticleComponent",
        props: ['currentUser','update'],
        //debugger;
    mounted() {
        this.fields = JSON.parse(this.update);
        this.fields.category = this.fields.categorie_id;
        this.getCategories();
        },
        data(){
            return{
                categories:[],
                fields: {},
                errors: {},
                success: false,
                loaded:true,
                image:''
            }
        },

        methods:{
            getCategories(){
                self = this;
                axios.get('../api/categories').then(function(res){
                    self.categories = res.data;
                });
            },
            onImageChange(e){
                this.fields.image = e.target.files[0];
            },
            submit() {
                let formData = new FormData();

                formData.append('image', this.fields.image);
                formData.append('title', this.fields.title);
                formData.append('category', this.fields.category);
                formData.append('content', this.fields.content);
                formData.append('author', this.currentUser.id);
                formData.append('source', "articles");


                if (this.loaded) {
                    this.loaded = false;
                    this.success = false;
                    this.errors = {};
                    axios.post('../api/articles', formData, { headers: {'Content-Type': 'multipart/form-data'}
                        }).then(response => {
                            this.fields = {}; //Clear input fields.
                            this.loaded = true;
                            this.success = true;
                        }).catch(error => {
                            this.loaded = true;
                            this.errors = error.response.data.errors || {};

                        });
                }
            },

        }
    }
</script>

<style scoped>

</style>
