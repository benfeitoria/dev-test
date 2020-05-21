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
        axios({
            url: '/api/categorias',
            method: 'post',
            data: {
              descricao: this.descricao,
            },
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
          .then(response => {
            this.categoria = response.data;
            app.showModal = false;
            app.$children.forEach(children => {

              if (children.$options._componentTag == 'administrar-categorias-component') {
                children.items.push(this.categoria)
              }
            })
          })
          .catch(error => {
              console.log(error)
          })
      }
    }
  }
</script>