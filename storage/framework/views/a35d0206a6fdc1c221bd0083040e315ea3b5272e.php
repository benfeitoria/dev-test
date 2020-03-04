<?php $__env->startSection('content'); ?>
  <pagina tamanho="10">
    <painel titulo="Dashboard">
      <migalhas v-bind:lista="<?php echo e($listaMigalhas); ?>"></migalhas>

      <div class="row">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('autor')): ?>
          <div class="col-md-4">
            <caixa qtd="<?php echo e($totalArtigos); ?>" titulo="Artigos" url="<?php echo e(route('artigos.index')); ?>" cor="orange" icone="ion ion-pie-graph"></caixa>
          </div>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('eAdmin')): ?>
          <div class="col-md-4">
            <caixa qtd="<?php echo e($totalUsuarios); ?>" titulo="Usuários" url="<?php echo e(route('usuarios.index')); ?>" cor="blue" icone="ion ion-person-stalker"></caixa>
          </div>
          <div class="col-md-4">
            <caixa qtd="<?php echo e($totalAutores); ?>" titulo="Autores" url="<?php echo e(route('autores.index')); ?>" cor="red" icone="ion ion-person"></caixa>
          </div>
          <div class="col-md-4">
            <caixa qtd="<?php echo e($totalAdmin); ?>" titulo="Admin" url="<?php echo e(route('adm.index')); ?>" cor="green" icone="ion ion-person"></caixa>
          </div>
        <?php endif; ?>

      </div>
    </painel>

  </pagina>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>