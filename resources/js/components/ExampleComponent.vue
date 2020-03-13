<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Example Component</div>

          <div class="card-body"></div>
          
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    posts() {
      return this.$store.state.post.posts;
    }
  },
  mounted() {
    this.carregaLastPosts();
  },
  methods: {
    carregaLastPosts() {
      this.$store
        .dispatch("loadLastPosts")
        .then()
        .catch(erro => {
        });
    },
  }
};
</script>
