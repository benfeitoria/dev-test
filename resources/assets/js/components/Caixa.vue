<template>
  <div class="small-box" v-bind:style="defineCor">
    <div class="inner">
      <h3>{{qtd}}</h3>

      <p>{{titulo}}</p>
    </div>
    <div class="icon">
      <i v-bind:class="icone"></i>
    </div>
    <a v-bind:href="url" class="small-box-footer">
      Ver mais <i class="fa fa-arrow-circle-right"></i>
    </a>
  </div>
</template>

<script>
    export default {
      props:['qtd','titulo','url','cor','icone'],
      computed:{
        defineCor:function(){
          return "background-color: "+this.cor+" !important;"
        }
      }

    }
</script>

<style media="screen">
  .bg-aqua{
      background-color: #00c0ef !important;
  }

  .small-box {
    border-radius: 2px;
    position: relative;
    display: block;
    margin-bottom: 20px;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    color: #FFF;
  }

  .small-box:hover {
    text-decoration: none;
    color: #f9f9f9;
  }

  .small-box>.inner {
    padding: 10px;
  }

  .small-box h3, .small-box p {
    z-index: 5;
  }

  .small-box h3 {
    font-size: 38px;
    font-weight: bold;
    margin: 0 0 10px 0;
    white-space: nowrap;
    padding: 0;
  }

  .small-box p {
    font-size: 15px;
  }

  p {
    margin: 0 0 10px;
  }

  .small-box .icon {
    -webkit-transition: all .3s linear;
    -o-transition: all .3s linear;
    transition: all .3s linear;
    position: absolute;
    top: -10px;
    right: 10px;
    z-index: 0;
    font-size: 90px;
    color: rgba(0,0,0,0.15);
  }

  .small-box:hover .icon {
    font-size: 95px;
  }

  .small-box>.small-box-footer {
    position: relative;
    text-align: center;
    padding: 3px 0;
    color: #fff;
    color: rgba(255,255,255,0.8);
    display: block;
    z-index: 10;
    background: rgba(0,0,0,0.1);
    text-decoration: none;
  }

  a {
    color: #3c8dbc;
  }

  .small-box>.small-box-footer:hover {
    color: #fff;
    background: rgba(0,0,0,0.15);
  }

  a:hover, a:active, a:focus {
    outline: none;
    text-decoration: none;
    color: #72afd2;
  }


</style>
