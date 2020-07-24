<?php
    require_once 'vendor/autoload.php';

    $session = new SpotifyWebAPI\Session(
        'CLIENT_ID',
        'CLIENT_SECRET',
        'REDIRECT_URI'
    );

    $options = [
        'scope' => [
            'user-top-read'
        ],
    ];
    
    header('Location: ' . $session->getAuthorizeUrl($options));
    die();
?>
