<template>
  <div class="input-group mb-3">
    
    <input
      type="text"
      class="form-control"
      placeholder="Buscar"
      :name="parametroBusca"
      :value="valor"
      @keyup="updateSeach($event.target.value)"
    />
    <div class="input-group-append">
      <button class="btn btn-outline-secondary" type="button" @click.prevent="buscar">Buscar</button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    urlModulo: {
      type: String,
      required: true
    },
    parametroBusca: {
      type: String,
      required: false,
      default: ""
    },
    valor: {
      type: String,
      required: false
    }
  },
  data() {
      return {
          inputValue: ''
      }
  },
  mounted(){
    this.inputValue = this.valor;
  },
  methods: {
    buscar() {
      //console.log(this.inputValue)
      //console.log(`${this.urlModulo}?${this.parametroBusca}=${this.inputValue}`);
      window.location = `${this.urlModulo}?${this.parametroBusca}=${this.inputValue}`;
    },
    updateSeach(valor){
        this.inputValue = valor;
    }
  }
};
</script>

<style lang="scss" scoped>
</style>