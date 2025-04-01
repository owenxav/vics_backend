<?php

use App\Helpers\V1\ApiResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\ApiKeyMiddleware;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'api-key' => ApiKeyMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            return ApiResponse::error($e->getMessage(), Response::HTTP_UNAUTHORIZED, [
                'logout' => true,
            ]);
        });
        $exceptions->respond(function (Response $response) {
            $content = json_decode($response->getContent());

            if ($response->getStatusCode() === Response::HTTP_UNAUTHORIZED) {
                if (isset($content->message) && $content->message === 'Unauthenticated.') {
                    return ApiResponse::error($content->message, Response::HTTP_UNAUTHORIZED, [
                        'logout' => true,
                    ]);
                }
            }

            if ($response->getStatusCode() === Response::HTTP_NOT_FOUND) {
                return ApiResponse::error('Not Found Error', Response::HTTP_NOT_FOUND);
            }

            if ($response->getStatusCode() === Response::HTTP_INTERNAL_SERVER_ERROR) {
                return ApiResponse::error('Internal Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            if ($response->getStatusCode() === Response::HTTP_FORBIDDEN) {
                return ApiResponse::error('Forbidden Error', Response::HTTP_FORBIDDEN);
            }

            if ($response->getStatusCode() === Response::HTTP_METHOD_NOT_ALLOWED) {
                return ApiResponse::error('Method Not Allowed Error', Response::HTTP_METHOD_NOT_ALLOWED);
            }

            if (isset($content->message)) {
                $response->setContent(json_encode([
                    'status' => false,
                    'message' => $content->message,
                    'error' => [
                        'message' => $content->message,
                    ],
                ]));
            }
            return $response;
        });
    })->create();
