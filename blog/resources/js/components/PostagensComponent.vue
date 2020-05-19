<template>
  <div>
    <md-card v-for="(item, index) in items">
      <md-card-media>
        <img v-bind:src="item.imagem" v-bind:alt="item.alt">
      </md-card-media>

      <md-card-header>
        <div class="md-title">{{ item.titulo }}</div>
        <div class="md-subhead">{{ item.autor_name }}</div>
      </md-card-header>

      <md-card-actions>
        <a v-bind:href="item.link">
            <md-button>Ler</md-button>
        </a>
      </md-card-actions>

      <md-card-content>
        {{ item.created_at | formatodata }}
      </md-card-content>
    </md-card>
  </div>
</template>

<script>
  export default {
    name: 'Layouts',
    props: [
      'categoria_id'
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

      let url = '/api/postagens';

      if (this.categoria_id) {
        url += '?categoria='+ this.categoria_id;
      }

      axios
        .get(url)
        .then(data => {

            let its = [];

            data.data.forEach(item => {
                item.link = 'postagem/' + item.id
                its.push(item)
            })

            this.items = its
        })
        .catch(error => {
            console.log(error)
            this.errored = true
        })
        .finally(() => this.loading = false)
    }
  }
</script>

<style lang="scss" scoped>
  .md-card {
    width: 320px;
    margin: 4px;
    display: inline-block;
    vertical-align: top;
  }
</style>
