<template>
    <div>
        <!--Table-->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="card-title text-center"><h3>{{title}}</h3></div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <a class="btn btn-primary text-white" @click="create">Novo</a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="input-group mb-3">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Encontre o post pelo titulo,categoria ou conteudo"
                                v-model="search"
                            />
                            <div class="input-group-append">
                                <a class="btn btn-primary text-white" @click="searchPosts">Pesquisar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="overflow-auto w-100">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td>#</td>
                                <td>Imagem</td>
                                <td>Title</td>
                                <td>Autor</td>
                                <td>Categoria</td>
                                <td>Ação</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="post of posts">
                                <td>{{post.id}}</td>
                                <td><img :src="post.urlImage" class="img-post"/></td>
                                <td>{{post.title}}</td>
                                <td>{{post.user.name}}</td>
                                <td>{{post.categories.name}}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-sm btn-primary text-white" @click="edit(post)">Editar</a>
                                        <a class="btn btn-sm btn-danger text-white"
                                           @click="deletePost(post.id)">Excluir</a>
                                        <a class="btn btn-sm btn-info text-white" @click="publictionOrRemove(post.id)">{{
                                            post.publication_date==null ? 'Publicar' : 'Remover'}}</a>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="posts.length < 1">
                                <td colspan="6" class="text-center">Nenhum post encontrado!</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <paginate-component
                        :current="paginate.page"
                        @resetCurrent="paginate.page = $event"
                        :total="paginate.total"
                        :action="getPosts"

                    />
                </div>

            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="postModal" tabindex="-1" role="dialog"
             aria-labelledby="postModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="postModalLabel">
                            {{editing ? titleModalUpdate : titleModalCreate}}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Titulo</label>
                            <input class="form-control" v-model="post.title">
                        </div>
                        <div class="form-group">
                            <label>Categoria</label>
                            <select class="form-control" v-model="post.category_id">
                                <option>--</option>
                                <option v-for="category of categories" :value="category.id">{{category.name}}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Imagem de destaque </label>
                            <input type="file" class="form-control-file" id="file">
                        </div>

                        <div class="col-md-12">
                            <quill-editor v-model="post.content"
                                          :options="editorOption">
                            </quill-editor>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary text-white" data-dismiss="modal">Cancelar</a>
                        <a class="btn btn-primary text-white" v-if="!editing" @click="save">Salvar</a>
                        <a class="btn btn-primary text-white" v-if="editing" @click="update">Atualizar</a>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
    import paginateModel from "../model/paginate";
    import 'quill/dist/quill.core.css'
    import 'quill/dist/quill.snow.css'
    import 'quill/dist/quill.bubble.css'
    import {quillEditor} from 'vue-quill-editor';

    export default {
        name: "PostsComponent",
        components: {
            quillEditor
        },
        data: function () {
            return {
                title: 'Posts',
                editing: false,
                titleModalUpdate: 'Atualizar post',
                titleModalCreate: 'Novo post',
                search: '',
                paginate: new paginateModel(),
                posts: [],
                categories: [],
                post: {},
                urlApi: './api/post',
                urlApiCategories: './api/post-categories',
                editorOption: { /* quill options */}

            }
        },
        mounted() {
            this.getPosts();
        },
        methods: {
            searchPosts: function () {
                this.paginate = new paginateModel();
                this.getPosts();
            },
            getPosts: async function () {
                try {
                    const resp = await axios.get(`${this.urlApi}/?page=${this.paginate.page}&search=${this.search}`);
                    const data = await resp.data;
                    this.posts = data.data;
                    this.paginate.total = data.last_page;
                } catch (e) {
                    Vue.$toast.error("Ocorreu um erro!");
                }

            },
            openModal: function () {
                this.getCategories();
                jQuery("#postModal").modal("show");
            },
            closeModal: function () {
                jQuery("#postModal").modal("hide");
            },
            getCategories: async function () {
                try {
                    const resp = await axios.get(`${this.urlApiCategories}/all`);
                    const data = await resp.data;
                    this.categories = data;
                } catch (e) {
                    Vue.$toast.error("Ocorreu um erro!");
                }


            },
            create: function () {
                this.editing = false;
                this.post = {};
                this.openModal();
            },
            save: async function () {
                let form = new FormData();
                let image = document.getElementById("file");
                form.append("title", this.post.title);
                form.append("category_id", this.post.category_id);
                form.append("image", image.files[0]);
                form.append("content", this.post.content);
                try {
                    const resp = await axios.post(this.urlApi, form);
                    const data = await resp.data;
                    if (data.success) {
                        this.closeModal();
                        this.paginate = new paginateModel();
                        this.getPosts();
                        Vue.$toast.success(data.message);
                    } else {
                        Vue.$toast.warning(data.message);
                    }
                } catch (e) {
                    Vue.$toast.error("Ocorreu um erro!");
                }

            },
            edit: function (post) {
                this.post = Object.assign({}, post);
                this.editing = true;
                this.openModal();

            },
            update: async function () {
                let form = new FormData();
                let image = document.getElementById("file");
                form.append("title", this.post.title);
                form.append("category_id", this.post.category_id);
                form.append("image", image.files[0]);
                form.append("content", this.post.content);
                form.append("id", this.post.id);
                try {
                    const resp = await axios.post(`${this.urlApi}/update`, form);
                    const data = await resp.data;
                    if (data.success) {
                        this.closeModal();
                        this.paginate = new paginateModel();
                        this.getPosts();
                        Vue.$toast.success(data.message);
                    } else {
                        Vue.$toast.warning(data.message);
                    }
                } catch (e) {
                    if (e.response.status == 403) {
                        Vue.$toast.error(e.response.data.message);
                    }
                }
            },
            deletePost: async function (id) {
                const resp = confirm("Deseja excluir?");
                if (resp) {
                    try {
                        const resp = await axios.delete(`${this.urlApi}/${id}`);
                        const data = await resp.data;
                        if (data.success) {
                            Vue.$toast.success(data.message);
                            this.getPosts();
                        } else {
                            Vue.$toast.warning(data.message);
                        }
                    } catch (e) {
                        if (e.response.status == 403) {
                            Vue.$toast.error(e.response.data.message);
                        }
                    }

                }
            },
            publictionOrRemove: async function (id) {
                const resp = confirm("Deseja realizar essa ação?");
                if (resp) {
                    try {
                        const resp = await axios.put(`${this.urlApi}/publication/${id}`);
                        const data = await resp.data;
                        if (data.success) {
                            Vue.$toast.success(data.message);
                            this.getPosts();
                        } else {
                            Vue.$toast.warning(data.message);
                        }

                    } catch (e) {
                        if (e.response.status == 403) {
                            Vue.$toast.error(e.response.data.message);
                        }
                    }

                }
            }
        }
    }
</script>

<style scoped>
    .img-post {
        width: 50px;
        height: 50px;
    }
</style>
