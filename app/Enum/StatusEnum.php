<?php

namespace App\Enum;

class StatusEnum
{
    //Messages
    const MESSAGE_BAD_REQUEST = 'Erro ao realizar a solicitação.';
    const MESSAGE_UNAUTHORIZED = 'Não autorizado.';
    const MESSAGE_NOT_FOUND = 'O servidor não pôde encontrar o recurso solicitado.';
    const MESSAGE_SERVER_ERROR = 'Erro do servidor ao processar a solicitação.';

    //Status
    const OK = 200;
    const CREATED = 201;
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const NOT_FOUND = 404;
    const SERVER_ERROR = 500;
    const UNPROCESSABLE_ENTITY = 422;
}
