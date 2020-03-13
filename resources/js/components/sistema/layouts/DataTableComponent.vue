
<template>
  <div class="data-table">
    <table class="table">
      <thead>
        <tr>
          <th v-for="column in columns" :key="column" class="table-head">{{ column | columnHead }}</th>
          <th>AÇÕES</th>
        </tr>
      </thead>
      <tbody>
        <tr class v-if="object_data.data.length === 0">
          <td class="lead text-center" :colspan="columns.length + 1">Sem Registros.</td>
        </tr>
        <tr v-for="(item, key1) in object_data.data" :key="key1" class="m-itemtable__row" v-else>
          <td v-for="(value, key) in columns" :key="key">{{ item[value] }}</td>
          <td>
            <a
              v-if="acaoEdicao"
              title="Editar Categoria"
              class="btn btn-info"
              href="#"
              @click.prevent="redirectEdicar(item.id)"
            >
              <i class="fas fa-pencil-alt"></i>
            </a>
            <a
              v-if="acaoExclusao"
              title="Apagar"
              class="btn btn-danger"
              @click.prevent="redirectExcluir(item.id)"
            >
              <i class="fas fa-trash"></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>

    <pagination :data="object_data" @pagination-change-page="getResults"></pagination>
  </div>
</template>

<script>
import pagination from "laravel-vue-pagination";

export default {
  components: {
    pagination
  },
  props: {
    urlModulo: {
      type: String,
      required: true
    },
    urlExclusao: {
      type: String,
      required: false
    },
    acaoExclusao: {
      type: Boolean,
      default: false
    },
    urlEdicao: {
      type: String,
      required: false
    },
    acaoEdicao: {
      type: Boolean,
      default: false
    },
    busca:{
      type: String,
      required: false,
      default: ''
    },
    parametroBusca: {
      type: String,
      required: false,
      default: ''
    },
    columns: {
      type: Array,
      required: true
    },
    object_data: {
      type: Object,
      required: true,
      default: []
    }
  },
  data() {
    return {
      tableData: []
    };
  },
  methods: {
    getResults(page = 1) {
      if(this.busca){
        window.location = `${this.urlModulo}?${this.parametroBusca}=${this.busca}&page=${page}`;
      }else{
        window.location = `${this.urlModulo}?page=${page}`;
      }
    },
    redirectEdicar(id) {
      window.location = `${this.urlEdicao}/${id}`;
    },
    redirectExcluir(id) {
      window.location = `${this.urlExclusao}/${id}`;
    }
  },
  filters: {
    columnHead(value) {
      return value
        .split("_")
        .join(" ")
        .toUpperCase();
    }
  },
  name: "DataTable"
};
</script>

<style scoped>
</style>