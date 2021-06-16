<?php

namespace App\Architecture;

use App\Exceptions\SystemException;
use App\Traits\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use stdClass;
use Throwable;

class Validate
{
    use Requests;

    protected $rules = [];
    protected $messages = [];

    /**
     * @param stdClass $params
     * @param string|null $message
     * @throws Throwable
     */
    public function validaParametros(stdClass $params, string $message = null) : void
    {
        $validator = Validator::make((array)$params, $this->getRules(), $this->getMessages());

        if ($validator->fails()) {
            $this->shootExeception(new ValidationException($validator), $message);
        }
    }

    /**
     * @param int $id
     * @return bool
     * @throws SystemException
     */
    public function validateInt(int $id): bool
    {
        if (!is_int($id)) {
            throw new SystemException('Erro ao validar inteiro.');
        }

        return true;
    }

    /**
     * @return array
     */
    public function getRules() : array
    {
        return $this->rules;
    }

    /**
     * @return array
     */
    public function getMessages() : array
    {
        return $this->messages;
    }
}
