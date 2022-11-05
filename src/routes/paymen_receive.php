<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;
date_default_timezone_set('Europe/Istanbul');
        /** # TR #
        * token bölümüne sitenize özel aldığınız token kodunu yazınız.
        * secret_key bölümüne sitenize özel aldığınız secret key kodunu yazınız.
        * Herhangi bir sorununuz olursa panelinize girip iletişim online destekten bize yazabilirsiniz.
        */
        /** # EN #
        * In the token section, write the token code you received for your site.
        * In the secret_key section, write the secret key code you received for your site.
        * If you have any problems, you can enter your panel and write to us from the contact online support.
        */
        /** # CN #
        * 在令牌部分，写下您为您的站点收到的令牌代码。
        * 在 secret_key 部分，写下您为您的站点收到的密钥代码。
        * 如果您有任何问题，您可以进入您的面板并通过联系在线支持给我们写信。
        */
$token      = "your token";
$secret_key = "your secret key";

$app->post('/payment/receive', function (Request $request, Response $response) {
    $check_code   = $request->getParam("check_code");
    $payment_type = $request->getParam("payment_type");
    $name         = $request->getParam("name");
    $amount       = $request->getParam("amount");
    $value        = $request->getParam("value");
    $link_key     = $request->getParam("link_key");

    if ($check_code == hash("sha256", $token . "|" . $secret_key . "|" . $value . "|" . $amount . "|true")) {


        /** # TR #
        * Burada veritabanınıza bağlanarak kullanıcınıza bakiye ekleme yapabilirsiniz.
        * Güvenliğinizi sağlamak için lütfen $check_code kullanın.
        * Response değerleri sabittir lütfen düzenleme yapmayınız.
        */
        /** # EN #
        * Here you can load balance to your user by connecting to the database.
        * Please use $check_code to ensure your security.
        * Response values are fixed, please do not edit.
        */
        /** # CN #
        * 在这里，您可以通过连接到数据库来为您的用户进行负载平衡。
        * 请使用 $check_code 以确保您的安全。
        * 响应值是固定的，请勿编辑。
        */



        return $response
        ->withStatus(200)
        ->withHeader("Content-Type", 'application/json')
        ->withJson(array(
            "status"  => "200",
            "response" => array(
                "text"  => array(
                    "tr" => "Onay başarılı bir şekilde gerçekleşti!",
                    "en" => "Confirmation successful!",
                    "cn" => "确认成功！"
                )
            )
        ));
    }else{
        return $response
        ->withStatus(500)
        ->withHeader("Content-Type", 'application/json')
        ->withJson(array(
            "status"  => "500",
            "response" => array(
                "text"  => array(
                    "tr" => "Check kodu ayrıştırılamadı!",
                    "en" => "Failed to parse hash code!",
                    "cn" => "无法解析哈希码！"
                )
            )
        ));
    }
    
});