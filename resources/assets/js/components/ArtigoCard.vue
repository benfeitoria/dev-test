<template>
  <div :class="'col-sm-'+ (sm || '6') + ' col-md-'+ (md || '4')">
    <div class="thumbnail">
      <img src="https://coletiva.net/files/e4da3b7fbbce2345d7772b0674a318d5/midia_foto/20170713/118815-maior_artigo_jul17.jpg" alt="...">
      <div class="caption">
        <small>{{data | formataData}} - {{autor}}</small>
        <h3>{{titulo}}</h3>
        <p>{{descricao}}</p>
        <p><a :href="link" class="btn btn-primary" role="button">Leia mais</a></p>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
      props:['titulo','descricao','link','imagem','data','autor','sm','md'],
      filters: {
        formataData: function(valor){
          if(!valor) return '';
          valor = valor.toString();
          valor = valor.split('-');
          return valor[2] + '/' + valor[1]+ '/' + valor[0];
        }
      }
    }
</script>
