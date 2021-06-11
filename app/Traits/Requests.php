<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

trait Requests
{
    /**
     * Função que define o formato do resultado das requests
     *
     * @param string $message
     * @param int $status
     * @param Throwable|null $exception
     * @return JsonResponse
     */
    public function returnResponse(string $message, int $status, Throwable $exception = null)
    {
        $response['message'] = $message;

        if ($exception) {
            if (config('app.debug')) {
                $response['line'] = $exception->getLine();
                $response['file'] = $exception->getFile();
                $response['trace'] = $exception->getTrace();
                $response['msg'] = $exception->getMessage();
                $response['code'] = $exception->getCode();
            }
        }

        return response()->json($response, $status);
    }

    /**
     * Lanca excecao de erro com log
     *
     * @param Throwable $exception
     * @param string|null $messageLog
     * @throws Throwable
     */
    public function shootExeception(Throwable $exception, string $messageLog = null)
    {
        if ($messageLog) {
            $this->log_format($messageLog);
        }

        throw $exception;
    }

    /**
     * @param string $messageLog
     */
    private function log_format(string $messageLog)
    {
        if (auth()->user()) {
            $messageLog .= "; User: ". auth()->user()->id;
        }
        Log::warning($messageLog);
    }
}
