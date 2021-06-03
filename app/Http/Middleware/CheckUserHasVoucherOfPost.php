<?php

namespace App\Http\Middleware;

use App\Voucher;
use Closure;

class CheckUserHasVoucherOfPost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $voucher = Voucher::where('user_id', auth()->id())->where('post_id', $request->post_id);
        if ($voucher->count() > 0)
        {
            return response()->json(['message' => 'Has some error'], 500);
        }
        return $next($request);
    }
}
