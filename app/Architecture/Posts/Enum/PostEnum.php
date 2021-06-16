<?php

namespace App\Architecture\Posts\Enum;

class PostEnum
{
    const NOT_FOUND = 'Post não encontrado.';
    const CREATED = 'Post criado com sucesso.';
    const UPDATED = 'Post atualizado com sucesso.';
    const DELETED = 'Post excluído com sucesso.';
    const NOT_CREATED = 'Erro ao criar o post';
    const NOT_UPDATED = 'Erro ao atualizar o post.';
    const NOT_DELETED = 'Erro ao excluir o post.';
}
