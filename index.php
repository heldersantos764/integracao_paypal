<?php
require_once "Init.php";
?>

<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Pagamento com Paypal</title>
</head>

<body>

    <div class="container">
        <div id="paypal-button-container" class="paypal-button-container"></div>
        <!--<form id="form-card" action="" method="post">
            <div>
                <label for="card-number">Número do Cartão</label>
                <div id="card-number" class="card_field"></div>
            </div>
            <div>
                <label for="expiration-date">Vencimento</label>
                <div id="expiration-date" class="card_field"></div>
            </div>
            <div>
                <label for="cvv">CVV</label>
                <div id="cvv" class="card_field"></div>
            </div>
            <div class="form-group">
                <label for="card-holder-name">Titular do cartão</label>
                <input class="form-control" type="text" id="card-holder-name" name="card-holder-name" autocomplete="off" placeholder="Titular do cartão" />
            </div>
            <div>
                <label for="card-billing-address-street">Endereço</label>
                <input class="form-control" type="text" id="card-billing-address-street" name="card-billing-address-street" autocomplete="off" placeholder="Endereço" />
            </div>
            <div>
                <label for="card-billing-address-unit">Moeda</label>
                <input class="form-control" type="text" id="card-billing-address-unit" name="card-billing-address-unit" autocomplete="off" placeholder="Moeda" />
            </div>
            <div>
                <label for="card-billing-address-unit">Cidade</label>
                <input class="form-control" type="text" id="card-billing-address-city" name="card-billing-address-city" autocomplete="off" placeholder="Cidade" />
            </div>
            <div>
                <label for="card-billing-address-unit">Estado</label>
                <input class="form-control" type="text" id="card-billing-address-state" name="card-billing-address-state" autocomplete="off" placeholder="Estado" />
            </div>
            <div>
                <label for="card-billing-address-unit">CEP</label>
                <input class="form-control" type="text" id="card-billing-address-zip" name="card-billing-address-zip" autocomplete="off" placeholder="CEP" />
            </div>
            <div>
                <label for="card-billing-address-unit">Código do País</label>
                <input class="form-control" type="text" id="card-billing-address-country" name="card-billing-address-country" autocomplete="off" placeholder="Código do País" />
            </div>

            <div class="mt-2">
                <button value="submit" id="submit" class="btn btn-primary">Pagar</button>
            </div>
        </form>-->
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://www.paypal.com/sdk/js?components=buttons,hosted-fields&client-id=<?= $paypal->getClientId() ?>&currency=BRL" data-client-token="<?= $paypal->generateClientToken() ?>"></script>
    <script src="Paypal.js"></script>
</body>

</html>