<template>
  <div>
    
    <busca-component @buscar="buscar" />

    <row-component v-if="posts.data && posts.data.length > 0">
      <column-component :sizes="'12 col-md-4 mb-4'" v-for="post in posts.data" :key="post.id">
        <div class="card h-100 box-shadow">
          <div
            class="img_destaque_div"
            v-if="post.img_destaque"
            :style="'background-image: url(storage/posts/' + post.img_destaque + ')'"
          ></div>

          <div
            class="img_destaque_div"
            style="background-image: url(./images/no-image.png);"
            v-else
          ></div>

          <img
            v-if="post.img_destaque"
            class="card-img-top"
            style="display: none;"
            :src="'storage/posts/' + post.img_destaque"
            data-holder-rendered="true"
          />
          <div class="card-body">
            <p class="card-text m-0">{{ post.titulo }}</p>

            <div class="d-flex justify-content-between align-items-center">
              <div v-if="post.categorias && post.categorias.length > 0" class="mt-2 mb-2">
                <small class="text-muted">
                  <b>Categorias:</b>
                  <span
                    class="text-muted"
                    v-for="item in post.categorias"
                    :key="item.id"
                  >{{ item.nome }},</span>
                </small>
              </div>

              <div v-if="post.autor" class="mt-2 mb-2">
                <small class="text-muted">
                  <b>Por:</b>
                  {{ post.autor.name }}
                </small>
              </div>
            </div>

            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a :href="'./post/'+post.id" class="btn btn-sm btn-outline-secondary">Saiba Mais...</a>
              </div>
              <small class="text-muted">{{ post.data_publicacao | dataFormat }}</small>
            </div>
          </div>
        </div>
      </column-component>
    </row-component>

    <row-component v-else>
      <column-component :sizes="'12'">
        <div class="alert alert-info">Nenhum resultado correspondente.</div>
      </column-component>
    </row-component>

    <row-component>
      <column-component :sizes="'12'">
        <pagination :data="posts" :align="'center'" @pagination-change-page="getResults"></pagination>
      </column-component>
    </row-component>
  </div>
</template>

<script>
import moment from "moment";
moment.locale("pt-BR");

import pagination from "laravel-vue-pagination";
import BuscaComponent from '../layouts/BuscaComponent';

export default {
  computed: {
    posts() {
      return this.$store.state.post.posts.data;
    },
  },
  data() {
    return {
      categorias_id: "",
      autor_id: ""
    };
  },
  mounted() {
    this.carregaLastPosts();
  },
  methods: {
    carregaLastPosts() {
      this.$store
        .dispatch("loadPosts")
        .then()
        .catch(erro => {});
    },
    buscar(params) {
      this.$store
        .dispatch("loadPosts", params)
        .then()
        .catch(erro => {});
    },
    getResults(page = 1) {
      
        this.$store
          .dispatch("loadPosts", {
            categorias_id: this.categorias_id,
            autor_id: this.autor_id,
            page: page
          })
          .then()
          .catch(erro => {});
    }
  },
  filters: {
    dataFormat: function(data) {
      return moment(data).format("D/MM/Y");
    }
  },
  components: {
    pagination,
    BuscaComponent
  }
};
</script>

<style lang="scss" scoped>
</style>