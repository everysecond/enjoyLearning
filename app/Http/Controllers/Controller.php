<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return ResponseFactory
     */
    protected function response(): ResponseFactory
    {
        return app(ResponseFactory::class);
    }

    /**
     * @param string $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($message = '', $data = null)
    {

        if (count(func_get_args()) == 1 && !is_string($message)) {
            $data = $message;
            $message = null;
        }
        $success = ['data' => null];

        if (!empty($message)) {
            $success['message'] = $message;
        }

        if (isset($data) && $data != []) {
            $success['data'] = $data;
        }
        return $this->response()->json($success);
    }

    public function null()
    {
        $success['data'] = [];
        return $success;
    }


    /**
     * @param $message
     * @param int $code
     * @throws ApiException
     */
    public function error($message, $code = 400)
    {
        throw new ApiException($message, $code);
    }


    public function operateSuccess($message = '操作成功')
    {
        return $this->success($message, null);
    }


    public function user()
    {
        return Auth::user();
    }

    public function userId()
    {
        return Auth::id();
    }

}
