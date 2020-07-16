<?php


namespace TradeFair\Middleware;


use Closure;
use TradeFair\Validation\ValidationException;
use WPEmerge\Requests\RequestInterface;

class ValidationMiddleware
{
	public function handle(RequestInterface $request, Closure $next) {
		try {
			return $next( $request );
		} catch (ValidationException $exception){
			\TradeFair::flash()->add('errors', $exception->getErrors());
			return \TradeFair::redirect()->back();
		}
	}
}
