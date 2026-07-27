<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyGithubWebhook
{
    public function handle(Request $request, Closure $next): Response
    {
        $signature = $request->header('X-Hub-Signature-256');
        if (!$signature) {
            return response()->json([
                'success' => false,
                'message' => 'Missing signature.'
            ], 401);
        }
        $secret = config('services.github.webhook_secret');

        $hash = 'sha256=' . hash_hmac(
            'sha256',
            $request->getContent(),
            $secret
        );

        dd($hash);

        if (! hash_equals($hash, $signature)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid webhook signature.'
            ], 403);
        }

        if ($request->input('ref') !== 'refs/heads/main') {
            return response()->json([
                'success' => false,
                'message' => 'Ignored.',
            ]);
        }

        return $next($request);
    }
}