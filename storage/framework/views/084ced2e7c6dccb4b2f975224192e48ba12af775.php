<?php $__env->startSection('content'); ?>
<pagina tamanho="10">
  <painel titulo="Dashboard">
    <migalhas v-bind:lista="<?php echo e($listaMigalhas); ?>"></migalhas>

    <div class="row">
      <div class="col-md-4">

        <caixa  qtd="<?php echo e($totalUsuarios); ?>" titulo="Artigos" url="<?php echo e(route('artigos.index')); ?>" cor="orange" icone="ion ion-pie-graph"></caixa>

      </div>
      <div class="col-md-4">
      <caixa qtd="<?php echo e($totalArtigos); ?>" titulo="Usuários" url="<?php echo e(route('usuarios.index')); ?>" cor="blue" icone="ion ion-person-stalker"></caixa>
      </div>
      <div class="col-md-4">
      <caixa qtd="<?php echo e($totalAutores); ?>" titulo="Autores" url="<?php echo e(route('autores.index')); ?>" cor="red" icone="ion ion-person"></caixa>
      </div>
    </div>



  </painel>

</pagina>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>