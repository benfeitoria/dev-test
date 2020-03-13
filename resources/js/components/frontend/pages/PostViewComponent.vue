<template>
  <div id="post-view">
    <row-component>
      <column-component :sizes="'12'">
        <!-- Title -->        
        <h1 class="mt-4">{{ post.titulo }}</h1>
        <!-- Author -->
        <p class="lead" v-if="post.autor">
          por
          <a href="#">{{ post.autor.name }}</a>
        </p>
        <hr>
        <!-- Date/Time -->
        <p>Postado em {{ post.data_publicacao | dataFormat}}</p>
        <hr>

        <!-- Preview Image -->
        <div
            class="img-post"
            v-if="post.img_destaque"
            :style="'background-image: url(../storage/posts/' + post.img_destaque + ')'"
          ></div>

          <div class="img-fluid" style="background-image: url(./images/no-image.png);" v-else>
          </div>
        <hr>

        <div v-html="post.conteudo"></div>

      </column-component>
    </row-component>
  </div>
</template>

<script>
import CardComponent from "../../layouts/CardComponent";
import RowComponent from "../../layouts/RowComponent";
import ColumnComponent from "../../layouts/ColumnComponent";
import moment from 'moment'
moment.locale('pt-BR');

export default {
  props: {
    id: {
      type: String,
      required: true 
    },
  },
  data() {
    return {
      post: {}
    }
  },
  mounted() {
    this.carregaPost();
  },
  methods: {
    carregaPost() {
      this.$store
        .dispatch("carregarPost", this.id)
        .then(response =>{
          this.post = response;
        })
        .catch(erro => {});
    }
  },
  filters: {
      dataFormat: function(data) {
          return moment(data).format('D  MMMM YYYY, h:mm:ss a');
      }
  },
  components: {
    RowComponent,
    ColumnComponent
  }
};
</script>

<style lang="scss" scoped>

@media only screen and (min-width: 768px) { 
  #post-view .img-post{
  width: 100%;
  height: 500px;
  background-position: top center;
  background-size: cover;
  }
}

@media only screen and (max-width: 767px) { 
  #post-view .img-post{
  width: 100%;
  height: 240px;
  background-position: top center;
  background-size: cover;
  }
}

</style>