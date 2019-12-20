<?php
/*
 * Created on Wed Dec 18 2019 by DaRock
 *
 * Aweb Design
 * https://www.awebdesign.ro
 *
 */

namespace OpenCore\App\General;

use Illuminate\Routing\UrlGenerator as DefaultUrlGenerator;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;

class UrlGenerator extends DefaultUrlGenerator
{
    private $tokenKey = null;

    /**
     * Get the URL to a named route.
     *
     * @param  string  $name
     * @param  mixed   $parameters
     * @param  bool  $absolute
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function route($name, $parameters = [], $absolute = true)
    {
        if (strstr($name, 'admin::')) {
            if (isOc3()) {
                $this->tokenKey = 'user_token';
            } else {
                $this->tokenKey = 'token';
            }

            $parameters[$this->tokenKey] = Request::input($this->tokenKey);
        }

        return parent::route($name, $parameters, $absolute);
    }

    /**
     * Format the array of URL parameters.
     *
     * @param  mixed|array  $parameters
     * @return array
     */
    public function formatParameters($parameters)
    {
        $hasToken = $this->tokenKey && isset($parameters[$this->tokenKey]) ? $parameters[$this->tokenKey] : null;

        $parameters = parent::formatParameters($parameters);

        if($hasToken && !isset($parameters[$this->tokenKey])) {
            $parameters[$this->tokenKey] = $hasToken;
        }

        return $parameters;
    }
}
