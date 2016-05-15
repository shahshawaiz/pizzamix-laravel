<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
    
    ];

	//add an array of Routes to skip CSRF check
	private $openRoutes = ['postRequest'];

	//modify this function
	public function handle($request, Closure $next)
    {
        //add this condition 
	    foreach($this->openRoutes as $route) {

	      if ($request->is($route)) {
	        return $next($request);
	      }
	    }

	    return parent::handle($request, $next);
  	}    

	protected function tokensMatch($request){
	// If request is an ajax request, then check to see if token matches token provider in 
	// the header. This way, we can use CSRF protection in ajax requests also         
		$token = $request->ajax() ? $request->header('X-CSRF-Token') : $request->input('_token');

        return $request->session()->token() == $token;     
	}    

}