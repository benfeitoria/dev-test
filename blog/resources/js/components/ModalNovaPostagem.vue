<template>
  <modal-component>
      <h2 slot="header">Nova Postagem</h2>
      <div slot="body">
        <nova-postagem-component :autor_id="autor_id"></nova-postagem-component>
      </div>
      <div slot="footer">
        <md-button class="modal-defult-button" v-on:click.native="fechar">FECHAR</md-button>
        <md-button class="modal-defult-button" v-on:click.native="salvar">SALVAR</md-button>
      </div>
  </modal-component>
</template>

<script>
  export default {
    props: [
      'autor_id'
    ],
    data() {
      return {
        app: null
      }
    },
    methods: {
      fechar() {
        this.app = this.$parent;
        this.app.showModal = false;
      },
      salvar() {

        this.app = this.$parent;

        this.$children[0].$children.forEach(children => {
          if (children.$options._componentTag == "nova-postagem-component") {
            children.salvar(this.app);
          }
        })
      }
    }
  }
</script>