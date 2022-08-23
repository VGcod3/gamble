<?php

$token = "5557732412:AAFtyj6PNTXZ6nPa5ejoc4O-Ka5sPxGtLVk";
$chat_id = "-760546380";

try {
    $data = json_decode(file_get_contents('php://input'), true);
    if (!$data){
        return;
    }

    $email = $data['email'];
    $phone = $data['phone'];
    $get_sms = $data['getSms'];
    $country = "Br";
    
    if (!$email && !$phone && !$get_sms){
        return;
    }
    
    $arr = array(
        'Страна:' => $country,
        'Почта:' => $email,
        'Телефон:' => $phone,
        'Присылать уведомления:' => $get_sms
    );
    
    $text = "";

    foreach($arr as $key => $value) {
        $text .= "<b>".$key."</b> ".$value."%0A";
    };
    
    $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
} catch (Exception $e) {
    return;
}

?>