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

    <painel titulo="Lista de Artigos">
      <migalhas v-bind:lista="<?php echo e($listaMigalhas); ?>"></migalhas>



      <tabela-lista
      v-bind:titulos="['#','Título','Descrição','Autor','data']"
      v-bind:itens="<?php echo e(json_encode($listaArtigos)); ?>"
      ordem="desc" ordemcol="0"
      criar="#criar" detalhe="/admin/artigos/" editar="/admin/artigos/" deletar="/admin/artigos/" token="<?php echo e(csrf_token()); ?>"
      modal="sim"

      ></tabela-lista>
      <div align="center">
        <?php echo e($listaArtigos); ?>

      </div>
    </painel>

  </pagina>

  <modal nome="adicionar" titulo="Adicionar">
    <formulario id="formAdicionar" css="" action="<?php echo e(route('artigos.store')); ?>" method="post" enctype="" token="<?php echo e(csrf_token()); ?>">

      <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" value="<?php echo e(old('titulo')); ?>">
      </div>
      <div class="form-group">
        <label for="descricao">Descrição</label>
        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="<?php echo e(old('descricao')); ?>">
      </div>

      <div class="form-group">
        <label for="addConteudo">Conteúdo</label>

        <ckeditor
          id="addConteudo"
          name="conteudo"
          value="<?php echo e(old('conteudo')); ?>"
          v-bind:config="{
                    toolbar: [
                      [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]
                    ],
                    height: 200
                  }" >
        </ckeditor>

      </div>

      <div class="form-group">
        <label for="data">Data</label>
        <input type="date" class="form-control" id="data" name="data" value="<?php echo e(old('data')); ?>">
      </div>

    </formulario>
    <span slot="botoes">
      <button form="formAdicionar" class="btn btn-info">Adicionar</button>
    </span>

  </modal>
  <modal nome="editar" titulo="Editar">
    <formulario id="formEditar" v-bind:action="'/admin/artigos/' + $store.state.item.id" method="put" enctype="" token="<?php echo e(csrf_token()); ?>">

      <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" v-model="$store.state.item.titulo" placeholder="Título">
      </div>
      <div class="form-group">
        <label for="descricao">Descrição</label>
        <input type="text" class="form-control" id="descricao" name="descricao" v-model="$store.state.item.descricao" placeholder="Descrição">
      </div>
      <div class="form-group">
        <label for="editConteudo">Conteúdo</label>

        <ckeditor
          id="editConteudo"
          name="conteudo"
          v-model="$store.state.item.conteudo"
          v-bind:config="{
                    toolbar: [
                      [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]
                    ],
                    height: 200
                  }" >
        </ckeditor>


      </div>

      <div class="form-group">
        <label for="data">Data</label>
        <input type="date" class="form-control" id="data" name="data" v-model="$store.state.item.data">
      </div>
    </formulario>
    <span slot="botoes">
      <button form="formEditar" class="btn btn-info">Atualizar</button>
    </span>
  </modal>
  <modal nome="detalhe" v-bind:titulo="$store.state.item.titulo">
    <p>{{$store.state.item.descricao}}</p>
    <p>{{$store.state.item.conteudo}}</p>
  </modal>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>