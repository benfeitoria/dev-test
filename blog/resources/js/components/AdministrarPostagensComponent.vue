<template>
  <div id="administrar-postagens">
    <md-table md-card>
      <md-table-toolbar>
        <div><h1 class="md-title">Postagens</h1></div>
        <div id="button-new"><md-button class="modal-defult-button" v-on:click.native="clickAdd">NOVA</md-button></div>
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
        <md-table-cell>
          <md-icon v-on:click.native="clickAdd">add</md-icon>
          <md-icon v-on:click.native="clickRemove(item.id)">remove</md-icon>
        </md-table-cell>
      </md-table-row>

    </md-table>
  </div>
</template>

<script>
  export default {
    name: 'TableCard',
    props: [
      'autor_id'
    ],
    data() {
        return { 
            items: [],
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
    },
    methods: {
      clickAdd: function () {
        return this.$parent.showModal = true;
      },
      clickRemove(id) {

        if (!confirm('Tem certeza? Esta ação não poderá ser desfeita')) {
          return;
        }

        axios
          .delete('/api/postagens/'+ id)
          .then(response => this.items.forEach((item, ind) => {
            if (item.id == id) {
              return this.items = (new Array()).concat(this.items.slice(0, ind), this.items.slice(ind + 1))
            }
          }))
          .catch(error => {
              console.log(error)
              this.errored = true
              alert(error);
          })
          .finally(() => this.loading = false)
      }
    }
  }
</script>

<style type="text/css">
div#administrar-postagens {
  max-width: 80vw;
  margin: 0 auto;
}

div#administrar-postagens div.md-card {
  padding: 10px 30px;
}

div#administrar-postagens div.md-card div.md-toolbar div#button-new {

  position: absolute;
  right: 0;
}

div#administrar-postagens div.md-card div.md-content {
  margin: 0 auto;
}
</style>