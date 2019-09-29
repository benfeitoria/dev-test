<template>
<v-container :item="dados" >
    <v-progress-linear  v-if="loading == true"
      indeterminate
     
    ></v-progress-linear>
  <v-flex  v-for=" postagem in dados" :key="postagem.id">
 
      <v-card v-if="loading == false" flat class="ma-5 mx-auto" max-width="650" >
        <v-list-item>
       
          <v-list-item-content>
            <v-list-item-title class="headline">{{postagem.titulo}}</v-list-item-title>
            <v-list-item-subtitle>{{postagem.updated_at}}</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
    
        <v-img :src="postagem.imagem" height="194"></v-img>
    
        <v-card-text>
         {{postagem.categoria.titulo}}
        </v-card-text>
    
        <v-card-actions>
          <router-link :to="{ name: 'postagem',
                                        params: {
                                            id:postagem.id
                                        }}">
          <v-btn text color="amber darken-1"  @click="postagem()" >
           
            Leia mais 
          </v-btn>
         </router-link>
          <div class="flex-grow-1"></div>
          <v-btn icon>
            <v-icon>mdi-heart</v-icon>
          </v-btn>
          
        </v-card-actions>
      </v-card>
      </v-flex>
  
  </v-container>
</template>

<script>
 import api from '../services/api';

export default {
   
   props:['pagina'],

    data:() => ({
        dados:[],
        loading: false,
        pagina:'',
    }),
    watch: { 
            pagina: function(newVal, oldVal) { // watch it
               this.postagens(newVal);
            }
    },

    created() {
      
      this.postagens(this.$pagina);
    },
    methods:{

      postagens: function (page) {
       
        this.loading = true
          api.get('postagens?page='+page).then(response=>{
            
            this.dados =response.data.data
              this.loading =false;
              this.$emit('paginas',response.data)
            
          }).catch(err=>{
            console.log(err);
          })
         
          
      },

      
    }

}
</script>