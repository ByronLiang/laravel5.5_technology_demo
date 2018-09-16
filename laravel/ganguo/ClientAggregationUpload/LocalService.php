<?php

namespace Ganguo\ClientAggregationUpload;

class LocalService implements FactoryInterface
{
    private $cache_key;

    public function __construct()
    {
        $this->cache_key = md5(self::class.'_token_'.request()->getClientIp());
    }

    public function getForm(): array
    {
        $token = \Cache::remember($this->cache_key, 2, function () {
            return str_random(10);
        });

        return compact('token');
    }

    public function getHeaders(): array
    {
        return [];
    }

    public function getAccessUrl(): String
    {
        return url('/upload/');
    }

    public function getUploadUrl(): String
    {
        return request()->url();
    }

    public function getFileField(): String
    {
        return 'file';
    }

    public function securityCheck(\Illuminate\Http\Request $request)
    {
        $token = $request->token;

        if (!$token || \Cache::get($this->cache_key) !== $token) {
            abort(403, 'token 无效');
        }
    }
}
