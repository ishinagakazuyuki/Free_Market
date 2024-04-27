<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permission;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        // ユーザーがログインしていることを確認
        if (!$request->user()) {
            return redirect('/');
        }

        // ユーザーが指定された権限を持っているかどうかを確認
        $user = $request->user();
        $permission = permission::where('user_id','=',$user['id'])->first();
        if (empty($permission)) {
            return redirect('/');
        } else {
            return $next($request);
        }
    }
}
