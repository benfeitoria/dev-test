<template>
  <div>
    <div class="row justify-content-around">
      <div class="col-10 input-group my-4">
        <form style="width: 100%;">
            <div class="form-group">
                <label for="titulo">Nome</label>
                <input id="titulo" v-model="category.nome" type="text" class="form-control">
            </div>
            <button :disabled="!category.nome" type="button" class="btn btn-primary" v-on:click="save()">Salvar</button>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
    data: function() {
        return {
            category: {
                nome: ""
            }
        }
    },
    methods: {
        save: function() {
            axios
            .post("/api/categoria/save", { nome: this.category.nome })
            .then(response => response.data)
            .then(data => {
                window.location.href = "/categoria";
            });
        }
    }
};
</script>
<style></style>