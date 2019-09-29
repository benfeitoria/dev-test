<template>
  <div>
   <v-row no-gutters >
      
     <v-col :md='10'>
      <Postagens :pagina='page' @paginas="paginacao"></Postagens>
      {{name}}
     </v-col>
     <v-col md:2>
        <RigthMenu />
     </v-col>
   </v-row>
  
<div class="text-center">
      <v-pagination
        v-model="page"
        :length="total"
         :total-visible="7"
        circle
      ></v-pagination>
 </div>
 
  </div>
</template>

<script>

import Postagens from '../components/Postagens';
import RigthMenu from '../components/navegacao/RightMenu';


export default {
  components: {
    Postagens,
    RigthMenu
  },
  data: function () {
    return {
      page: 1,
      total:'',
    }
  },
  methods:{
    paginacao:function(dados){
      this.total = dados.last_page
      
    }
  }
  
};
</script>
