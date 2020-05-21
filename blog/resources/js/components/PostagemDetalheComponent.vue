<template>
  <div id="postagem-detalhe">
    <md-card v-for="(item, index) in items">
      <md-card-media>
        <img v-bind:src="item.imagem" v-bind:alt="item.alt">
      </md-card-media>

      <md-card-header>
        <div class="md-title">{{ item.titulo }}</div>
        <div class="md-subhead">{{ item.autor_name }}</div>
      </md-card-header>

      <md-card-content>
        {{ item.texto }}
        <div>{{ item.created_at | formatodata }}</div>
        <div>
          <a :href="item.link_categoria">
            <span>Categoria: {{ item.categoria_descricao }}</span>
          </a>
        </div>
      </md-card-content>
    </md-card>
  </div>
</template>

<script>
  export default {
    name: 'Layouts',
    props: [
      'id'
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
      axios
        .get('/api/postagem/'+ this.id)
        .then(data => {

            let its = [];

            data.data.forEach(item => {
                item.link_categoria = '/?categoria='+ item.categoria_id
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
  .card-expansion {
    height: 480px;
  }

  .md-card {
    width: 320px;
    margin: 4px;
    display: inline-block;
    vertical-align: top;
  }
</style>
