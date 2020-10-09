<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class RefreshToken extends BaseMiddleware
{
    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|mixed
     * @throws JWTException
     */
    public function handle($request, Closure $next)
    {
        //BaseMiddleware内方法
//        $this->checkForToken($request);
        try {
            if ($userInfo = $this->auth->parseToken()->authenticate()) {
                return $next($request);
            }

            return redirect()->route('登录页');
        } catch (TokenExpiredException $exception) {
            //是否可以刷新,刷新后加入到响应头
            try {
                $token = $this->auth->refresh();
                // 使用一次性登录以保证此次请求的成功
                Auth::guard('api')->onceUsingId($this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray()['sub']);
            } catch (JWTException $exception) {
                return redirect()->route('登录页');
                throw new UnauthorizedHttpException('jwt-auth', $exception->getMessage());
            }
        } catch (TokenBlacklistedException $exception) {
            return redirect()->route('登录页');
//            throw new UnauthorizedHttpException('jwt-auth', '未登录');
        } catch (JWTException $exception){
            return redirect()->route('登录页');
        }
        return $this->setAuthenticationHeader($next($request), $token);
    }
}