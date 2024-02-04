<?php

declare(strict_types=1);

namespace App\Middlewares;

use Framework\Contracts\MiddlewareInterface;
use App\Exceptions\SessionException;

class SessionMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {

        if (session_status() === PHP_SESSION_ACTIVE) {
            throw new SessionException("Session is already start");
        }


        if (headers_sent($filename, $line)) {
            throw new SessionException("Header is already sent. Consider enabling output buffering. data sent from {$filename} --Line: {$line}");
        }

        session_set_cookie_params([
            'secure' => $_ENV['APP_ENV'] === 'production',
            'httponly' => true,
            'samesite' => 'lax'
        ]);

        session_start();

        $next();

        session_write_close();
    }
}
