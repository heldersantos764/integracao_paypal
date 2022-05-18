<?php

class Paypal
{

    private $baseUrl;
    private $clientId;
    private $secret;

    public function __construct(string $baseUrl, string $clientId, string $secret)
    {
        $this->baseUrl = $baseUrl;
        $this->clientId = $clientId;
        $this->secret = $secret;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Retorna o header de autenticação AUTH BASIC
     */
    private function getAuthBasicHeader()
    {
        $auth = base64_encode($this->clientId . ":" . $this->secret);
        return [
            'Authorization: Basic ' . $auth,
            'Content-Type: application/json'
        ];
    }

    /**
     * Retorna o header de autenticação AUTH BEARER
     */
    private function getBearerHeader()
    {
        return [
            'Authorization: Bearer ' . $this->generateAccessToken(),
            "Accept-Language: pt_BR",
            "Content-Type: application/json"
        ];
    }

    /**
     * retorna a URL para uma requisição ao Pagar.me
     * 
     * @var string $route
     * @return string
     */
    private function getUrl(string $route = ''): string
    {
        return $this->baseUrl . $route;
    }

    /**
     * Create JSON order
     */
    private function getJsonOrder($purchaseAmount)
    {
        $order =    [
            'intent' => "CAPTURE",
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => "BRL",
                        'value' => $purchaseAmount
                    ],
                ],
            ]
        ];

        return json_encode($order);
    }

    //call this function to create your client token
    public function generateClientToken()
    {
        $accessToken = $this->generateAccessToken();
        $urlGenarateToken = $this->getUrl('/v1/identity/generate-token');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $urlGenarateToken);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->getBearerHeader());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, []);
        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response);

        return $data->client_token;
    }

    //access token is used to authenticate all REST API requests
    public function generateAccessToken()
    {
        $requestUrl = $this->getUrl('/v1/oauth2/token');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $requestUrl);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->getAuthBasicHeader());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response);
        return $data->access_token;
    }

    /**
     * Create a order
     */
    public function createOrder()
    {
        $purchaseAmount = "1.00";
        $headers = $this->getBearerHeader();
        $requestUrl = $this->getUrl('/v2/checkout/orders');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $requestUrl);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BEARER);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->getBearerHeader());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $this->getJsonOrder($purchaseAmount));
        $response = curl_exec($curl);
        curl_close($curl);

        echo $response;
    }

    /**
     * capture payment for an order
     */
    public function capturePayment($orderId){
        $accessToken = $this->generateAccessToken();
        $requestUrl  = $this->getUrl("/v2/checkout/orders/$orderId/capture");

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $requestUrl);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BEARER);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->getBearerHeader());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_POST, true);
        $response = curl_exec($curl);
        curl_close($curl);

        echo $response;
    }
}
