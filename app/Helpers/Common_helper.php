<?php

use CodeIgniter\Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function jwt_token($data = [])
{
    // $key        = getenv('JWT_SECRET');
    $key     = Services::getSecretKey();
    $payload = array(
        "iss"  => "http://localhost",
        "aud"  => "http://localhost",
        "exp"  => time() + (30 * 60),
        "data" => [
            "user_id"     => $data['id'],
            "firstname"   => $data['firstname'],
            "lastname"    => $data['lastname'],
            "email"       => $data['email'],
        ]
    );

    $jwt = JWT::encode($payload, $key, 'HS256');
    return $jwt;
}