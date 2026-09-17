<?php

namespace App\Http\Middleware;

use App\Constants\HasLookupType\AllowedLanguages;
use App\Constants\SystemDefault;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $localization = $request->header('Accept-Language');

        $localization = in_array($localization, [

            AllowedLanguages::ENGLISH['key'],

            AllowedLanguages::ARABIC['key']

        ], true) ? $localization : SystemDefault::DEFAUL_LANGUAGE;

        app()->setLocale($localization);

        return $next($request);
    }
}
