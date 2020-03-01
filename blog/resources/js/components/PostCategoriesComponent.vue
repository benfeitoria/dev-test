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
                                placeholder="Encontre a categoria pelo nome"
                                v-model="search"
                            />
                            <div class="input-group-append">
                                <a class="btn btn-primary text-white" @click="searchCategories">Pesquisar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>Nome</td>
                            <td>Ação</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="category of categories">
                            <td>{{category.id}}</td>
                            <td>{{category.name}}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                <a class="btn btn-sm btn-primary text-white" @click="edit(category)">Editar</a>
                                <a class="btn btn-sm btn-danger text-white"
                                   @click="deleteCategory(category.id)">Excluir</a>
                                </div>

                            </td>
                        </tr>
                        <tr v-if="categories.length < 1">
                            <td colspan="3" class="text-center">Nenhuma categoria encontrada!</td>
                        </tr>
                        </tbody>
                    </table>
                    <paginate-component
                        :current="paginate.page"
                        @resetCurrent="paginate.page = $event"
                        :total="paginate.total"
                        :action="getCategories"
                    />
                </div>

            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="postCategoriesModal" tabindex="-1" role="dialog"
             aria-labelledby="postCategoriesModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="postCategoriesModalLabel">
                            {{editing ? titleModalUpdate : titleModalCreate}}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nome</label>
                            <input class="form-control" v-model="category.name">
                            <input type="hidden" class="form-control" v-model="category.id">
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

    import paginateModel from '../model/paginate.js';
    import PaginateComponent from "./PaginateComponent";

    export default {
        name: "PostCategoriesComponent",
        components: {PaginateComponent},
        data: function () {
            return {
                title: 'Categorias',
                paginate: new paginateModel(),
                categories: [],
                search: '',
                urlApi: './api/post-categories',
                category: {},
                editing: false,
                titleModalCreate: 'Nova Categoria',
                titleModalUpdate: 'Editar Categoria'
            }
        },
        mounted() {
            this.getCategories();
        },
        methods: {
            getCategories: async function () {
                try {
                    const resp = await axios.get(`${this.urlApi}/?page=${this.paginate.page}&search=${this.search}`);
                    const data = await resp.data;
                    this.categories = data.data;
                    this.paginate.total = data.last_page;
                } catch (e) {
                    alert("Ocorreu um erro!");
                    console.log(e);
                }

            },
            searchCategories: function () {
                this.paginate = new paginateModel();
                this.getCategories();
            },
            openModal: function () {
                jQuery("#postCategoriesModal").modal("show");
            },
            closeModal: function () {
                jQuery("#postCategoriesModal").modal("hide");
            },
            create: function () {
                this.editing = false;
                this.category = {};
                this.openModal();
            },
            save: async function () {
                try {
                    const resp = await axios.post(`${this.urlApi}`, this.category);
                    const data = await resp.data;
                    if (data.success) {
                        this.closeModal();
                        this.paginate.page = 1;
                        this.paginate.total = 0;
                        this.getCategories();
                        this.category = {};
                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                    console.log(data);
                } catch (e) {
                    alert("Ocorreu um erro!");
                    console.log(e);
                }
            },
            edit: function (category) {
                this.category = Object.assign({}, category);
                this.editing = true;
                this.openModal();
            },
            update: async function () {
                try {
                    const resp = await axios.put(`${this.urlApi}`, this.category);
                    const data = await resp.data;
                    if (data.success) {
                        this.closeModal();
                        this.getCategories();
                        this.category = {};
                        alert(data.message);
                    }
                    console.log(data);
                } catch (e) {
                    console.log(e);
                }
            },
            deleteCategory: async function (id) {
                const resp = confirm("Deseja excluir?");
                if (resp) {
                    const resp = await axios.delete(`${this.urlApi}/${id}`);
                    const data = await resp.data;
                    if (data.success) {
                        alert(data.message);
                        this.getCategories();
                    }
                }
            }

        }
    }
</script>

<style scoped>

</style>
