<template>
  <div>
    <div class="row justify-content-around">
      <div class="col-10 input-group my-4">
        <form style="width: 100%;">
            <div class="form-group">
                <label for="files">Imagem</label>
                <input
                    type="file"
                    id="files"
                    class="form-control-file"
                    ref="files"
                    v-on:change="handleFileUpload($event)"
                />
            </div>
            <div class="form-group">
                <label for="titulo">Titulo</label>
                <input id="titulo" v-model="data.titulo" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <select v-model="data.id_category" class="form-control">
                    <option v-bind:key="categoria.id" v-for="categoria in categorias" v-bind:value="categoria.id">
                        {{ categoria.nome }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="autor">Autor</label>
                <select v-model="data.autor" class="form-control">
                    <option v-bind:key="autor.id" v-for="autor in autores" v-bind:value="autor.id">
                        {{ autor.name }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="conteudo">Conteúdo</label>
                <textarea v-model="data.conteudo" class="form-control" id="conteudo" rows="3"></textarea>
            </div>
            <button type="button" class="btn btn-primary" v-on:click="save()">Salvar</button>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
    props: ['data'],
    data: function() {
        return {
            files: "",
            categorias: [''],
            autores: ['']
        }
    },
    mounted: function() {
        // Categorias
        axios
        .get("/api/categoria")
        .then(response => response.data)
        .then(data => {
            this.categorias = data;
        });
        // Autores
        axios
        .get("/api/autor")
        .then(response => response.data)
        .then(data => {
            this.autores = data;
        });
    },
    methods: {
        handleFileUpload(event) {
            this.files = event.target.files;
        },
        save: function() {

            let formData = new FormData();
            formData.append("autor", this.data.autor);
            formData.append("titulo", this.data.titulo);
            formData.append("conteudo", this.data.conteudo);
            formData.append("id_category", this.data.id_category);

            for (var i = 0; i < this.files.length; i++) {
                let file = this.files[i];
                formData.append("files[" + i + "]", file);
            }

            axios
            .post("/api/post/save/"+this.data.id, formData, {
                headers: {
                "Content-Type": "multipart/form-data"
                }        
            })
            .then(response => response.data)
            .then(data => {
                window.location.href = "/post/admin";
            });
        }
    }
};
</script>
<style></style>