<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\Direction;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class GlobalData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $directions = Direction::with('categories')->get();
        View::share('directions', $directions);

        return $next($request);
    }
}
