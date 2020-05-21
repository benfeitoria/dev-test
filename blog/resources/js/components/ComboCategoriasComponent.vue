<template>
  <div id="combo-categorias">
    <md-field>
      <label for="categorias">Categoria</label>
      <md-select v-model="categoria" name="categorias" id="categorias" v-on:md-selected="$emit('capturarCategoria', categoria)">
        <md-option value="0">Selecione</md-option>
        <md-option 
          v-for="categoria of listaCategorias"
          v-bind:value="categoria.id"
        >{{ categoria.descricao }}</md-option>
      </md-select>
    </md-field>
  </div>
</template>

<script>
  export default {
    name: 'BasicSelect',
    data: () => ({
      categoria: 0,
      listaCategorias: []
    }),
    mounted() {
      axios
        .get('/api/categorias')
        .then(data => this.listaCategorias = data.data)
        .catch(error => {
            console.log(error)
        })
    },
  }
</script>

<style type="text/css">
  body > div.md-select-menu.md-menu-content-bottom-start {
    z-index: 10000;
  }
</style>