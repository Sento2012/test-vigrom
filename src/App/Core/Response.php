<?php

namespace App\Core;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class Response
{
    public function getSuccessResponse(array $controller = null, array $arguments = null): string
    {
        $this->getHeaders();
        if ($controller && $arguments) {
            return json_encode(call_user_func_array($controller, $arguments));
        }

        return json_encode([]);
    }

    public function getFailedResponse(string $errorMessage): string
    {
        $this->getHeaders(SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);

        return json_encode([
            'status' => BaseController::STATUS_FAIL,
            'message' => $errorMessage,
        ]);
    }

    private function getHeaders(int $code = SymfonyResponse::HTTP_OK): void
    {
        if (headers_sent()) {
            return;
        }
        header('HTTP/1.1 ' . (string) $code . ' OK');
        header('Content-type: application/json');
    }
}