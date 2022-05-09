<?php

namespace App\Filters;

use CodeIgniter\Config\Services;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services as ConfigServices;
use Exception;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;


class BasicauthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $request    = service('request');
        // $key        = getenv('JWT_SECRET');
        $key        = Services::getSecretKey();
        $headers    = $request->getHeader('authorization');
        $token      = '';
        
        if($headers)
        {
            $token    = $headers->getValue();
        }

        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
        } catch (Exception $ex) {
            if($ex->getMessage() == "Expired token")
            {
                $response = service('response');
                $response->setBody('Token Expired');
                $response->setStatusCode(401);
                return $response;
            }
            else
            {
                $response = service('response');
                $response->setBody('Access denied');
                $response->setStatusCode(401);
                return $response;
            }
        }

        // if($token)
        // {
        //     $decoded = JWT::decode($token, new Key($key, 'HS256'));
        // }
        // else
        // {
        //     $response = service('response');
        //     $response->setBody('Access denied');
        //     $response->setStatusCode(401);
        //     return $response;
        // }
       
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}