<template>
  <div id="administrar-categorias">
    <md-table md-card>
      <md-table-toolbar>
        <div><h1 class="md-title">Categorias</h1></div>
        <div id="button-new"><md-button class="modal-defult-button" v-on:click.native="clickAdd">NOVA</md-button></div>
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
            items: [],
            loading: true, 
            errored: false
        }
    },
    mounted() {
      let url  = '/api/categorias';

      axios({
          url: url,
          method: 'GET',
          transformResponse: [function (data) {
            
            try {

              let res = JSON.parse(data);

              if (res.msg) alert(res.msg)
              
              return res;

            } catch (e) {
              console.error(e);
            }
          }],
        })
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
        
        axios({
            url: '/api/categorias/'+ id,
            method: 'delete',
            transformResponse: [function (data) {
              
              try {

                let res = JSON.parse(data);

                if (res.msg) alert(res.msg)
                
                return res;

              } catch (e) {
                console.error(e);
              }
            }],
          })
          .then(response => this.items.forEach((item, ind) => {
            if (item.id == id) {
              return this.items = (new Array()).concat(this.items.slice(0, ind), this.items.slice(ind + 1))
            }
          }))
          .catch(error => {
              console.log(error)
              this.errored = true
          })
          .finally(() => this.loading = false)
      }
    }
  }
</script>

<style type="text/css">
div#administrar-categorias {
  max-width: 80vw;
  margin: 0 auto;
}

div#administrar-categorias div.md-card {
  padding: 10px 30px;
}

div#administrar-categorias div.md-card div.md-toolbar div#button-new {

  position: absolute;
  right: 0;
}

div#administrar-categorias div.md-card div.md-content {
  margin: 0 auto;
}
</style>