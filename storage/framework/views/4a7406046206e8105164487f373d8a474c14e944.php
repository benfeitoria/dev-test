<?php $__env->startSection('content'); ?>
  <pagina tamanho="12">
    <painel titulo="Artigos">

      <div class="row">
        <?php $__currentLoopData = $lista; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <artigocard
          titulo="<?php echo e($value->titulo); ?>"
          descricao="<?php echo e($value->descricao); ?>"
          link="<?php echo e(route('artigo',[$value->id,str_slug($value->titulo)])); ?>"
          imagem="https://coletiva.net/files/e4da3b7fbbce2345d7772b0674a318d5/midia_foto/20170713/118815-maior_artigo_jul17.jpg"
          data="<?php echo e($value->data); ?>"
          autor="<?php echo e($value->autor); ?>"
          sm="6"
          md="4">
          </artigocard>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





      </div>

      <div align="center">
        <?php echo e($lista); ?>

      </div>

    </painel>
  </pagina>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>