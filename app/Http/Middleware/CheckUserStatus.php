<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->status == 0) {
            return $next($request);
        }

        // หากไม่ใช่ลูกค้า, เปลี่ยนเส้นทางไปยังหน้าอื่น (ตัวอย่าง: หน้า home)
        return redirect('/');
    }
}
