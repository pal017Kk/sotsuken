if (!$_GET["code"]) {
    // エラー                                                                                                                                                                                                      
}

// アクセストークン取得
$url = "https://api.line.me/v1/oauth/accessToken";

$data = array(
    "grant_type" => "authorization_code",
    "client_id" => LINE_CLIENT_ID,
    "client_secret" => LINE_CLIENT_SECRET,
    "code" => $_GET["code"],
    "redirect_uri" => "",
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);
curl_close($ch);
$result = (array)json_decode($response, true);

if (empty($result) || isset($result["error"])) {
    // エラー
}

print_r($result);
/*
Array
(
    [mid] => xxxxxxxxxxxxxxxxxxxxxxxxx
    [access_token] => xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
    [token_type] => Bearer
    [expires_in] => 2568710
    [refresh_token] => xxxxxxxxxxxxxxxxxxxx
    [scope] =>
)
 */

// プロフィール情報を取得                                                                                                                                                                                          
$url = "https://api.line.me/v2/profile";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.line.me/v2/profile");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $result["access_token"]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

$result = (array)json_decode($response, true);
if (empty($result) || empty($result["userId"])) {
    // エラー
}

print_r($result);
/*
Array
(
    [userId] => xxxxxxxxxxxxxxxx
    [displayName] => ユーザー名
    [pictureUrl] => ユーザー画像のURL
)
 */