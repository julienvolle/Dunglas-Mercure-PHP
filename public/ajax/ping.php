<?php

// Setup
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Security
if(!empty($_SERVER['HTTP_HOST']) && strtolower($_SERVER['HTTP_HOST']) === 'localhost:8080')
{
    /**
     * Container "ipv4_address"
     * 
     * In CMD:
     * docker inspect <MercureContainerName>
     * Config -> NetworkSettings -> Networks -> <MercureNetworkName> -> Gateway
     * 
     * Exemple:
     * - MercureContainerName: dunglas-mercure_mercure_1
     * - MercureNetworkName: dunglas-mercure_backend
     */
    $gateway = '172.28.1.2';

    // Config
    $url = 'http://' . $gateway . ':3000/hub';
    $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtZXJjdXJlIjp7InB1Ymxpc2giOlsiKiJdfX0.OixxclMTzRaafcsI3hP8MnpIf9v_RqQzmvSygxizYJ0';
    $header = [
        'Content-Type: application/x-www-form-urlencoded',
        'Authorization: Bearer ' . $token
    ];
    $id = (isset($_GET['id']) ? '/' . strip_tags($_GET['id']) : '');
    $body = [
        'topic' => 'http://localhost:8080/ping' . $id,
        'data' => 0
    ];

    // Call
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body, '', '&'));
    $output = curl_exec($ch);
    if (curl_errno($ch)) {
        echo '<code><pre>';
        echo 'Error: ' . curl_error($ch);
        var_dump($output);
        echo '</pre></code>';
    }
    curl_close($ch);
}
else { header("HTTP/1.1 403 Forbidden"); die; }
