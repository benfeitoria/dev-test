<template>
  <div class="about">
    
  <v-flex xs12 sm6 offset-sm3>
    
   <form>
      <v-row>
          <v-select 
          v-model="post.categoria"
           item-text="titulo"
           item-value="id"
          :items="itemSelect"
          label="Categoria"
          required
          :loading="loading.select"
        
        ></v-select>
      </v-row>
      <v-row>
          <v-text-field
            v-model="post.titulo"
            label="Titulo "
            required
           
          ></v-text-field>
      </v-row>
      <v-row>
          <v-btn raised class="sucesse" @click="pegaImagem" >Upload Imagem</v-btn>
          <input type="file" style="display: none" ref="fileInput" accept="image/*" @change="pegaImagemEscolhida">
      </v-row>
      <v-row>
          <v-textarea
                v-model="post.texto"
                label="Texto da postagem"
                required
          ></v-textarea>
      </v-row>
     
      <v-row>
          <v-btn :loading="loading.envia"  class="mr-4" @click="enviaPostagem" >enviar</v-btn>
        
      </v-row>
  </form>
   
 </v-flex>

  </div>
</template>

<script>
import api from '../services/api';
import { constants } from 'crypto';
export default {

    data:()=>({
       post:{
          titulo:'',
          texto :'',
          categoria :'',
          imagen:''

       },
       itemSelect:[],
       loading :{
         envia:false,
         select:false
       }
    }),
    created() {
              this.pegaCategoria();
          },

    methods:{
         
         pegaCategoria(){
           this.loading.select =true;
            api.get('categorias').then(response=>{
             
              this.itemSelect = response.data;
               this.loading.select=false;
            })
         },

         enviaPostagem(){
          this.loading.envia = true
           const data = {
             'imagem':this.post.imagen,
             'titulo':this.post.titulo,
             'texto_postagem': this.post.texto,
             'categoria_id':this.post.categoria
           }
           console.log(data);
          
            
            api.post('postagens',data).then(response=>{
                console.log(response.data)
                this.loading.envia = false
                this.$router.push({ path: '/', name:'home' })
            })
           

         },

         pegaImagem(){
           this.$refs.fileInput.click()
         },

         pegaImagemEscolhida(e){
            let file =event.target.files[0];
            //  console.log(event.target.files[0]);
            let reader = new FileReader();
                  let vm = this;

                  reader.onload = (e) => {
                    vm.post.imagen = e.target.result;
                  };
                  reader.readAsDataURL(file);
              console.log(vm.post.imagen)
         }
            

    }

}
</script>
