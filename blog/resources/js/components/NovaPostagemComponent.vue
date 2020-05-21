<template>
  <div>
    <md-field>
      <label>Imagem</label>
      <md-input v-model="url" placeholder="Informe a url para a imagem"></md-input>
    </md-field>

    <md-field>
      <label>Titulo</label>
      <md-input v-model="titulo" placeholder="Título da postagem"></md-input>
    </md-field>

    <combo-categorias-component v-on:capturarCategoria="selectCategoria"></combo-categorias-component>

    <md-field>
      <label>Texto</label>
      <md-textarea v-model="texto"></md-textarea>
    </md-field>
  </div>
</template>

<script>
  export default {
    name: 'TextFields',
    props: [
      'autor_id'
    ],
    data: () => ({
      url: null,
      titulo: null,
      texto: null,
      categoria_id: null,
      postagem: {}
    }),
    methods: {
      selectCategoria (value) {
        this.categoria_id = value;
      },
      salvar(app) {
        axios({
            url: '/api/postagem',
            method: 'post',
            data: {
              imagem       : this.url,
              titulo       : this.titulo,
              texto        : this.texto,
              categoria_id : this.categoria_id,
              autor_id     : this.autor_id,
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
            this.postagem = response.data;
            app.showModal = false;
            app.$children.forEach(children => {

              if (children.$options._componentTag == 'administrar-postagens-component') {
                children.items.push(this.postagem)
              }
            })
          })
          .catch(error => {
              console.error(error)
          })
      }
    }
  }
</script>