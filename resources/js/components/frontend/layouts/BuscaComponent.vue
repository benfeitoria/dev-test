<template>
  <div>
    <row-component>
      <column-component :sizes="'12 col-md-4 mb-3'">
        <select name="categoria_id" class="form-control" v-model="categorias_id">
          <option value>Todas as Categoria</option>
          <option v-for="item in categorias.data" :key="item.id" :value="item.id">{{ item.nome }}</option>
        </select>
      </column-component>
      <column-component :sizes="'12 col-md-4 mb-3'">
        <select name="autor_id" class="form-control" v-model="autor_id">
          <option value>Todos os Autores</option>
          <option v-for="item in autores.data" :key="item.id" :value="item.id">{{ item.name }}</option>
        </select>
      </column-component>
      <column-component :sizes="'12 col-md-4 mb-3'">
        <button class="btn btn-secondary btn-block" @click.prevent="buscar">BUSCAR</button>
      </column-component>
    </row-component>
  </div>
</template>

<script>
export default {
  computed: {
    categorias() {
      return this.$store.state.categoria.categorias;
    },
    autores() {
      return this.$store.state.autor.autores;
    }
  },
  data() {
    return {
      categorias_id: "",
      autor_id: ""
    };
  },
  mounted() {
    this.carregaCategorias();
    this.carregaAutores();
  },
  methods: {
    carregaCategorias() {
      this.$store
        .dispatch("loadCategorias")
        .then()
        .catch(erro => {});
    },
    carregaAutores() {
      this.$store
        .dispatch("loadAutores")
        .then()
        .catch(erro => {});
    },
    buscar() {
      this.$emit("buscar", {
        categorias_id: this.categorias_id,
        autor_id: this.autor_id,
        page: 1
      });
    }
  }
};
</script>

<style lang="scss" scoped>
</style>