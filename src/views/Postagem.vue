<template>

<div>
    
    <h1 class="text-center">{{dados.categoria.titulo}}</h1>
     
      <v-img
       
        class="white--text"
        height="500px"
        :src='dados.imagem'
      >
        <v-card-title class="align-end fill-height">{{dados.updated_at}}</v-card-title>
      </v-img>
      <v-row >
         <v-col cols="6" >
           <p class="font-weight-black" style="font-size:25px;">{{dados.titulo}}</p>
           <p class="text-justify">{{dados.texto_postagem}}</p>
          </v-col>
      </v-row>
   
     <v-btn  class="ma-5" href="javascript:history.go(-1)">Voltar</v-btn>
     
    
  </div>
</template>
<script>
import api from '../services/api';

export default {
    data:() => ({
    dados:[],
    load: true

  }),
   created() {
     
              this.postagem();
          },
  methods: {
    
      postagem: function () {
       
         api.get('postagens/'+this.$route.params.id).then(response=>{
           
           this.dados =response.data
            this.loading =false;
           console.log(response.data);
        }).catch(err=>{
          console.log(err);
        })
     }
     
  },
}
</script>