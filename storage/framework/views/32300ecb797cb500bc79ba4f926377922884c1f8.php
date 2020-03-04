<?php $__env->startSection('content'); ?>
  <pagina tamanho="12">
    <painel>

      <h2 align="center"><?php echo e($artigo->titulo); ?></h2>
      <h4 align="center"><?php echo e($artigo->descricao); ?></h4>
      <p>
        <?php echo $artigo->conteudo; ?>

      </p>
      <p align="center">
        <small>Por: <?php echo e($artigo->user->name); ?> - <?php echo e(date('d/m/Y',strtotime($artigo->data))); ?></small>

      </p>


    </painel>
  </pagina>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>