<template>
  <modal-component>
      <h2 slot="header">Nova Categoria</h2>
      <div slot="body">
        <nova-categoria-component></nova-categoria-component>
      </div>
      <div slot="footer">
        <md-button class="modal-defult-button" v-on:click.native="fechar">FECHAR</md-button>
        <md-button class="modal-defult-button" v-on:click.native="salvar">SALVAR</md-button>
      </div>
  </modal-component>
</template>

<script>
  export default {
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
          if (children.$options._componentTag == "nova-categoria-component") {
            children.salvar(this.app);
          }
        })
      }
    }
  }
</script>