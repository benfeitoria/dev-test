<template>
  <div>
    
    <!-- Listagem de Posts -->
    <div class="row justify-content-around">
      <div class="col-8 mb-4">
        
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Nome</th>
              <th scope="col"><a target="_self" href="/categoria/add" class="btn btn-primary">adicionar categoria</a></th>
            </tr>
          </thead>
          <tbody>
            <div v-if="!displayedPosts.length" class="row justify-content-around">
              Nenhum resultado foi encontrado.
            </div>
            <tr v-else v-for="category in displayedPosts" v-bind:key="category.id">
              <td style="width: 70%;">
                <span>{{ category.nome }}</span>
              </td>
              <td>
                <button type="button" class="btn btn-primary btn-sm" v-on:click="edit(category)"><font-awesome-icon class="mr-1" icon="pen"/>Editar</button>
                <button type="button" class="btn btn-danger btn-sm" v-on:click="del(category)"><font-awesome-icon class="mr-1" icon="trash"/>Excluir</button>

              </td>
            </tr>
          </tbody>
        </table>
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
      categorias: [''],
      page: 1,
			perPage: 4,
      pages: []
    }
  },
  computed: {
		displayedPosts () {
			return this.paginate(this.categorias);
		}
	},
  mounted: function() {    
    // Categorias
    axios
    .get("/api/categoria")
    .then(response => response.data)
    .then(data => {
      this.categorias = data;
    });
  },
  watch: {
		categorias () {
			this.setPages();
		}
	},
  methods: {
    del: function(category) {
      if(confirm("Excluir categoria?")){
        const index = this.categorias.indexOf(category);
        this.categorias.splice(index, 1);
        axios
        .post("/api/categoria/delete", { id: category.id })
        .then(response => response.data)
        .then(data => {
          this.pages = [];
          this.setPages();
        });
      }
    },
    edit: function(category) {
      window.location.href = "/categoria/edit/"+category.id;
    },
    setPages () {
      let numberOfPages = Math.ceil(this.categorias.length / this.perPage);
			for (let index = 1; index <= numberOfPages; index++) {
				this.pages.push(index);
			}
		},
		paginate (categorias) {
			let page = this.page;
			let perPage = this.perPage;
			let from = (page * perPage) - perPage;
			let to = (page * perPage);
			return  categorias.slice(from, to);
		}
  }
};
</script>
<style></style>