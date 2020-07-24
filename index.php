<!DOCTYPE html>
<html lang="en">
<head>
    <title>Spotify Top Ten Example</title>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <style>
        #short, #medium, #long {
            margin-left: 20px;
        }
    </style>
</head>

<body>
    <main>
        <h1>Spotify Top Ten Example (PHP)</h1>
        <form action="auth.php">
            <input type="submit" value="Login" />
        </form>
        <?php
            require 'vendor/autoload.php';
            
            $session = new SpotifyWebAPI\Session(
                'CLIENT_ID',
                'CLIENT_SECRET',
                'REDIRECT_URI'
            );

            // Request a access token using the code from Spotify
            $session->requestAccessToken($_GET['code']);

            $accessToken = $session->getAccessToken();
            $refreshToken = $session->getRefreshToken();

            $api = new SpotifyWebAPI\SpotifyWebAPI();

            // Fetch the access token.
            $api->setAccessToken($accessToken);

            $optionsShort = [
                'limit' => 10, 
                'time_range' => 'short_term'
            ];
            
            $optionsMedium = [
                'limit' => 10, 
                'time_range' => 'medium_term'
            ];

            $optionsLong = [
                'limit' => 10, 
                'time_range' => 'long_term'
            ];
        ?>
        <h2>Last 4 Weeks</h2>
        <div id="short">
        <h2>Artists</h2>
            <ol>
                <?php 
                    $artists = $api->getMyTop('artists', $optionsShort)->items;

                    foreach ($artists as $artist) {
                        echo("<li>" . $artist->name . "</li>\n");
                    }
                ?>
            </ol>
        <h2>Tracks</h2>
            <ol>
                <?php 
                    $tracks = $api->getMyTop('tracks', $optionsShort)->items;

                    foreach ($tracks as $track) {
                        echo("<li>" . $track->name . "</li>\n");
                    }
                ?>
            </ol>
        </div>

        <h2>Last 6 Months</h2>
        <div id="medium"> 
        <h2>Artists</h2>
            <ol>
                <?php 
                    $artists = $api->getMyTop('artists', $optionsMedium)->items;
                    
                    foreach ($artists as $artist) {
                        echo("<li>" . $artist->name . "</li>\n");
                    }
                ?>
            </ol>
        <h2>Tracks</h2>
            <ol>
                <?php 
                    $tracks = $api->getMyTop('tracks', $optionsMedium)->items;
                    
                    foreach ($tracks as $track) {
                        echo("<li>" . $track->name . "</li>\n");
                    }
                ?>
            </ol>
        </div>
        
        <h2>All Time</h2>
        <div id="long"> 
        <h2>Artists</h2>
            <ol>
                <?php 
                    $artists = $api->getMyTop('artists', $optionsLong)->items;
                    
                    foreach ($artists as $artist) {
                        echo("<li>" . $artist->name . "</li>\n");
                    }
                ?>
            </ol>
        <h2>Tracks</h2>
            <ol>
                <?php 
                    $tracks = $api->getMyTop('tracks', $optionsLong)->items;
                    
                    foreach ($tracks as $track) {
                        echo("<li>" . $track->name . "</li>\n");
                    }
                ?>
            </ol>
        </div>
    </main>
</body>
</html>

