<template>
  <div id="administrar-categorias">
    <md-table md-card>
      <md-table-toolbar>
        <h1 class="md-title">Categorias</h1>
      </md-table-toolbar>

      <md-table-row>
        <md-table-head md-numeric>ID</md-table-head>
        <md-table-head>Descricao</md-table-head>
        <md-table-head></md-table-head>
      </md-table-row>

      <md-table-row v-for="(item, index) in items">
        <md-table-cell md-numeric>{{ item.id }}</md-table-cell>
        <md-table-cell>{{ item.descricao }}</md-table-cell>
        <md-table-cell>
          <md-icon v-on:click.native="clickAdd(item.id)">add</md-icon>
          <md-icon v-on:click.native="clickRemove(item.id)">remove</md-icon>
        </md-table-cell>
      </md-table-row>

    </md-table>
  </div>
</template>

<script>
  export default {
    name: 'TableCard',
    data() {
        return { 
            items: null,
            loading: true, 
            errored: false
        }
    },
    mounted() {
      let url  = '/api/categorias';

      axios
        .get(url)
        .then(data => this.items = data.data)
        .catch(error => {
            console.log(error)
            this.errored = true
        })
        .finally(() => this.loading = false)
    },
    methods: {
      clickAdd: function () {

        alert('not yet')

        axios
          .get(url)
          .then(data => this.items = data.data)
          .catch(error => {
              console.log(error)
              this.errored = true
          })
          .finally(() => this.loading = false)

      },
      clickRemove(id) {
        
        axios
          .delete('/api/categorias/'+ id)
          .then(this.items = this.items.slice(0, -1))
          .catch(error => {
              alert(error);
              console.log(error)
              this.errored = true
          })
          .finally(() => this.loading = false)
      }
    }
  }
</script>
