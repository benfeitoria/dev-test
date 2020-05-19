<template>
  <div>
    <md-field>
      <label>Descrição</label>
      <md-input v-model="descricao" placeholder="Informe a descrição da categoria"></md-input>
    </md-field>
  </div>
</template>

<script>
  export default {
    name: 'TextFields',
    data: () => ({
      descricao: null,
      categoria: {}
    }),
    methods: {
      salvar(app) {
        axios
          .post('/api/categorias', {
            descricao: this.descricao,
          })
          .then(data => {
            this.categoria = data.data;
            app.showModal = false;
            app.$children.forEach(children => {

              if (children.$options._componentTag == 'administrar-categorias-component') {
                children.items.push(this.categoria)
              }
            })
          })
          .catch(error => {
              console.log(error)
              alert(error);
          })
      }
    }
  }
</script>