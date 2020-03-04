<?php $__env->startSection('content'); ?>
  <pagina tamanho="12">

    <?php if($errors->all()): ?>
      <div class="alert alert-danger alert-dismissible text-center" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><strong><?php echo e($value); ?></strong></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    <?php endif; ?>

    <painel titulo="Lista de Autores">
      <migalhas v-bind:lista="<?php echo e($listaMigalhas); ?>"></migalhas>


      <tabela-lista
      v-bind:titulos="['#','Nome','E-mail']"
      v-bind:itens="<?php echo e(json_encode($listaModelo)); ?>"
      ordem="desc" ordemcol="1"
      criar="#criar" detalhe="/admin/autores/" editar="/admin/autores/"
      modal="sim"

      ></tabela-lista>
      <div align="center">
        <?php echo e($listaModelo); ?>

      </div>
    </painel>

  </pagina>

  <modal nome="adicionar" titulo="Adicionar">
    <formulario id="formAdicionar" css="" action="<?php echo e(route('autores.store')); ?>" method="post" enctype="" token="<?php echo e(csrf_token()); ?>">

      <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nome" value="<?php echo e(old('name')); ?>">
      </div>
      <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php echo e(old('email')); ?>">
      </div>
      <div class="form-group">
        <label for="autor">Autor</label>
        <select class="form-control" id="autor" name="autor">
          <option <?php echo e((old('autor') && old('autor') == 'N' ? 'selected' : '' )); ?> value="N">Não</option>
          <option <?php echo e((old('autor') && old('autor') == 'S' ? 'selected' : ''  )); ?> <?php echo e((!old('autor') ? 'selected' : ''  )); ?> value="S">Sim</option>
        </select>
      </div>

      <div class="form-group">
        <label for="password">Senha</label>
        <input type="password" class="form-control" id="password" name="password" value="<?php echo e(old('password')); ?>">
      </div>

    </formulario>
    <span slot="botoes">
      <button form="formAdicionar" class="btn btn-info">Adicionar</button>
    </span>

  </modal>
  <modal nome="editar" titulo="Editar">
    <formulario id="formEditar" v-bind:action="'/admin/autores/' + $store.state.item.id" method="put" enctype="" token="<?php echo e(csrf_token()); ?>">

      <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" class="form-control" id="name" name="name" v-model="$store.state.item.name" placeholder="Nome">
      </div>
      <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" v-model="$store.state.item.email" placeholder="E-mail">
      </div>
      <div class="form-group">
        <label for="autor">Autor</label>
        <select class="form-control" id="autor" name="autor" v-model="$store.state.item.autor">
          <option value="N">Não</option>
          <option value="S">Sim</option>
        </select>
      </div>
      <div class="form-group">
        <label for="password">Senha</label>
        <input type="password" class="form-control" id="password" name="password" >
      </div>
    </formulario>
    <span slot="botoes">
      <button form="formEditar" class="btn btn-info">Atualizar</button>
    </span>
  </modal>
  <modal nome="detalhe" v-bind:titulo="$store.state.item.name">
    <p>{{$store.state.item.email}}</p>
  </modal>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>