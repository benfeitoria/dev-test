<template>
  <div>
    <!-- Filtro -->
    <div class="row justify-content-around">
      <div class="col-10 input-group mb-4">
        <a target="_self" href="/post/add" class="btn btn-primary">criar post</a>
        <input type="text" class="form-control"  v-model="search.texto" placeholder="buscar post por texto">
        <div class="input-group-append">
          <button class="btn btn-outline-primary" type="button" v-on:click="filter(search)">Buscar</button>
          <button class="btn btn-outline-secondary" type="button" v-on:click="clearfilter()">Limpar</button>
        </div>
      </div>
    </div>
    <!-- Listagem de Posts -->
    <div v-if="!displayedPosts.length" class="row justify-content-around">
      Nenhum resultado foi encontrado.
    </div>
    <div v-else class="row justify-content-around">
      <div class="card col-5 mb-4" v-for="post in displayedPosts" v-bind:key="post.id">
        <img class="card-img-top" :src="post.img" alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title">{{ post.titulo }}</h4>
          <p class="card-text">{{ post.conteudo }}</p> 
          <a target="_self" :href="'/post/edit/'+post.id" class="btn btn-primary">editar</a>
          <button class="btn btn-danger" type="button" v-on:click="del(post)">exlcuir</button>
        </div>
        <footer class="card-footer">
          <em v-if="post.category">{{ post.category.nome }} | </em>
          <em style="color: #767676;">{{ post.publicacao | formatDate }} | </em>
          <em v-if="post.autor && post.autor.name">{{ post.autor.name }}</em>
        </footer>
      </div>
      
    </div>
    <!-- Paginacao -->
    <nav v-if="displayedPosts.length" class="row justify-content-around" aria-label="Page navigation example">
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
</template>
<script>
export default {
  data: function() {
    return {
      search: {
        autor:'',
        texto:'',
        categoria:''
      },
      posts: [''],
      categorias: [''],
      page: 1,
			perPage: 4,
      pages: [],
      showModal: false
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
  mounted: function() {
    // Posts
    axios
    .get("/api/post")
    .then(response => response.data)
    .then(data => {
      this.posts = data;
    });
    
    // Categorias
    axios
    .get("/api/categoria")
    .then(response => response.data)
    .then(data => {
      this.categorias = data;
    });
  },
  watch: {
		posts () {
			this.setPages();
		}
	},
  methods: {
    del: function(post) {
      if(confirm("Excluir post?")){
        const index = this.posts.indexOf(post);
        this.posts.splice(index, 1);
        axios
        .post("/api/post/delete", { id: post.id })
        .then(response => response.data)
        .then(data => {
          this.pages = [];
          this.setPages();
        });
      }
    },
    clearfilter: function(search) {
      this.search = {
        autor:'',
        titulo:'',
        categoria:''
      }
      this.filter();
    },
    filter: function(search) {
      // Posts
      axios
      .post("/api/post", { search: search })
      .then(response => response.data)
      .then(data => {
        this.posts = data;
        this.pages = [];
        this.page = 1;
      });
    },
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