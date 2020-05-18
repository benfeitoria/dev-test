<template>
  <div>
    <md-table md-card>
      <md-table-toolbar>
        <h1 class="md-title">Postagens - {{ usuario }}</h1>
      </md-table-toolbar>

      <md-table-row>
        <md-table-head md-numeric>ID</md-table-head>
        <md-table-head>Titulo</md-table-head>
        <md-table-head>Criado em</md-table-head>
        <md-table-head>Categoria</md-table-head>
        <md-table-head></md-table-head>
      </md-table-row>

      <md-table-row v-for="(item, index) in items">
        <md-table-cell md-numeric>{{ item.id }}</md-table-cell>
        <md-table-cell>{{ item.titulo }}</md-table-cell>
        <md-table-cell>{{ item.created_at | formatodata }}</md-table-cell>
        <md-table-cell>{{ item.categoria_descricao }}</md-table-cell>
        <md-table-cell></md-table-cell>
      </md-table-row>

    </md-table>
  </div>
</template>

<script>
  export default {
    name: 'TableCard',
    props: [
      'autor_id',
      'usuario'
    ],
    data() {
        return { 
            items: null,
            loading: true, 
            errored: false
        }
    },
    filters: {
        formatodata (value) {
            let data = new Date(value);
            return data.toLocaleDateString() +' '+ data.toLocaleTimeString()
        }
    },
    mounted() {
      console.log(this.usuario);

      let url  = '/api/postagens';
          url += '?autor='+ this.autor_id;

      axios
        .get(url)
        .then(data => this.items = data.data)
        .catch(error => {
            console.log(error)
            this.errored = true
        })
        .finally(() => this.loading = false)
    }
  }
</script>
