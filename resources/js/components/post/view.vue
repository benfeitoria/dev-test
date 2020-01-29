<template>
  <div v-if="data" class="my-5">
    <!-- Listagem de Posts -->
    <div class="row justify-content-around">
      <div class="card col-10 mb-4">
        <img class="card-img-top" :src="data.img" alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title">{{ data.titulo }}</h4>
          <p class="card-text">{{ data.conteudo }}</p>
        </div>
        <footer class="card-footer">
          <em v-if="data.category">{{ data.category.nome }} | </em>
          <em style="color: #767676;">{{ data.publicacao | formatDate }} | </em>
          <em v-if="data.autor && data.autor.name">{{ data.autor.name }}</em>
        </footer>
      </div>
    </div>
    <!-- Paginacao -->
    <nav class="row justify-content-around">
      <ul class="pagination">
        <li class="page-item">
          <button type="button" class="page-link" v-if="page != 1" @click="page--"> Previous </button>
        </li>
        <li class="page-item">
          <button type="button" class="page-link" v-for="pageNumber in pages.slice(page-1, page+5)" @click="page = pageNumber"> {{pageNumber}} </button>
        </li>
        <li class="page-item">
          <button type="button" @click="page++" v-if="page < pages.length" class="page-link"> Next </button>
        </li>
      </ul>
    </nav>	
  </div>
  <div v-else class="row justify-content-around">
      <h3 class="my-5">Post não encontrado.</h3>
  </div>
</template>
<script>
export default {
  props: ['data'],
  data: function() {
    return {
      posts: [''],
      categorias: [''],
      page: 1,
      perPage: 3,
      pages: []
    }
  },
  computed: {
    displayedPosts () {
        return this.paginate(this.posts);
    }
  },
  filters: {
    formatDate: function(date) {
      if (date) {
        return moment(String(date)).format('DD/MM/YYYY hh:mm')
      }
    }
  },
  watch: {
		posts () {
			this.setPages();
		}
	},
  methods: {
    setPages () {
      let numberOfPages = Math.ceil(this.posts.length / this.perPage);
			for (let index = 1; index <= numberOfPages; index++) {
				this.pages.push(index);
			}
		},
		paginate (posts) {
			let page = this.page;
			let perPage = this.perPage;
			let from = (page * perPage) - perPage;
			let to = (page * perPage);
			return  posts.slice(from, to);
		}
  }
};
</script>
<style></style>