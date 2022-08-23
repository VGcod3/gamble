<?php
// $current_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

// $acceptLang       = ['ru', 'en', 'pt', 'de', 'es', 'fr', 'tr']; 
// $unsupportedLang  = ['kz', 'az', 'uz'];
$current_lang     = 'en';

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$country = isset( $_COOKIE['country'] ) ? $_COOKIE['country'] : null;

if( is_null( $country ) ){
    $ipdat = @json_decode(file_get_contents(
        "http://www.geoplugin.net/json.gp?ip=" . $ip));
    
    $country = $ipdat->geoplugin_countryCode ? strtolower( $ipdat->geoplugin_countryCode ) : 'br';
    setcookie( 'country', $country, strtotime( '+7 days' ) );
}

if( $country === 'us' && $ipdat->geoplugin_continentCode === 'AS' ){
    $country = 'uz';
}

// if( in_array( $country, $unsupportedLang ) ){
//     $current_lang = $country;
// }

$language = [
    'en' => [
        'title'                 => 'Gamble',
        'modal-phone'           => 'Enter your phone number',
        'modal-email'           => 'Type your e-mail',
        'phone-button'          => 'Via phone',
        'email-button'          => 'By email',
        'submit-button'         => 'Receive bonus',
        'modal-success'         => 'Thanks',
        'modal-subscribe'       => 'Receive newsletters about promotions by email and sms',
        'subscribe'             => 'Registrar',
        'try-again'             => 'TRY AGAIN',
        'wheel-src'             => './src/img/wheel.png',
        'bonus-1-header'        => '500% para o depósito',
        'bonus-1-text'          => '+250 rodadas grátis',
        'bonus-2-header'        => 'BONUS 1000R$',
        'register-header'       => 'Registrar',
        'register-bonus-header' => '500% para o depósito ',
        'register-bonus-text'   => '+250 rodadas grátis',
        'redirect-to'           => 'https://google.com'
    ]
];

// 1) Gire a roda e receba o bônus!
// 2) Girar! 
// 3) Sem ganho 
// 4) 1000R$ 
// 5) 15000R$ 
// 6) 500% para o depósito 
// 7) 100 rodadas grátis 
// 8) 250 rodadas grátis 
// 9) Registrar 
// 10) Baixe o aplicativo e recebe o bônus!


// 1) крути колесо и забери бонус!
// 2) крутить!
// 3) Проигрыш
// 4) 1000R$
// 5) 15000R$
// 6) 500% к депозиту
// 7) 100 фриспинов
// 8) 250 фриспинов
// 9) Регистрация
// 10) Качай приложение и забирай бонус!


function get_language( $key ){
    global $language, $current_lang;
    // return $language[$current_lang][$key];
    return $language[$current_lang][$key];
}

?>


<!DOCTYPE html>
<html lang="<?php echo $current_lang;?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= get_language( 'title' ); ?></title>
    <link rel="stylesheet" href="src/css/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="src/css/style.css">

</head>

<body>
    <div class="wrapper">
        <div class="els els1">
            <img src="src/img/elements.png" alt="bg">
        </div>

        <div class="els els2">
            <img src="src/img/elements2.png" alt="bg">
        </div>

        <div class="logo">
            <img src="src/img/1x.png" alt="pinup">
            <h1>Gire a roda e receba o bônus!</h1>
        </div>


        <div id="wheel">

            <img class="marker" src="./src/img/marker.png" />
            <img class="wheel" src="<?= get_language( 'wheel-src' );?>" />
            <img class="button" src="./src/img/button.png" />

        </div>

        <div class="man">
            <img src="./src/img/man.png" alt="">
        </div>
        <div class="woman">
            <img src="./src/img/woman.png" alt="">
        </div>
    </div>

    <div class="popup-left popup">
        <span></span>
        <hr>
        <span><?= get_language( 'try-again' );?></span>
    </div>

    <div class="popup-right popup">
        <span></span>
        <hr>
        <span><?= get_language( 'try-again' );?></span>
    </div>


   

     <div class="social-wrapper">
        <div class="modal-form ">
            <div class="form-title">
                <span><?= get_language( 'subscribe' );?></span>
            </div>
            <div class="bonus">
                <h1><?= get_language( 'bonus-1-header' );?></h1>
                <p><?= get_language( 'bonus-1-text' );?></p>
            </div>

            <div class="bonus">
                <h1>Baixe o aplicativo e recebe o bônus!</h2>
            </div>


            <div class="downloads">
                <a href="https://play.google.com/store/apps/details?id=com.ramses.ra.egypt">
                    <img src="src/img/google-play-badge.png" alt="">
                </a>
               
            </div>

            <div class="some-text">
                <h1><?= get_language( 'bonus-2-header' );?></h1>
                <hr>
            </div>

           

        </div>

    </div>


    <script>
        var redirectTo = '<?= get_language( 'redirect-to' ); ?>';
    </script>
    <script src="wheel.js"></script>
</body>

</html>