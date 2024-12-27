# UnotifySDK
SDK oficial para integração simplificada com as API's do Unotify.

## Uso
Obtenha o token e url base no dashboard do Unotify https://unotify.mfwks.com/dashboard
```php

$uny = new Unotify('token','https://unotify.mfwks.com/api/');
```
Requerer acesso à API (é necessário aprovar no dashboard):
```php
$uny->obterAcesso();
```
Casos de uso:
```php
$uny->enviarMsgWhatsApp($phone, $message);
$uny->enviarEmail($email, $title, $message);
```
## Instalação (estável)

```shell
composer require mfwks/unotifysdk
```
## Instalação (rudimentar)

1. Copie o arquivo Unotify.php.
2. Inclua no escopo de uso:
```php
include 'Unotify.php';

use UnotifySDK\Unotify;
```
## Instalação (desenvolvimento)

Inclua o código abaixo no composer.json, distribuindo os valores "repositories" e "require" adequadamente entre as outras dependências:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/Mfwks/UnotifySDK"
        }
    ],
    "require": {
        "mfwks/unotifysdk": "dev-master"
    }
}

```

Após isso basta instalar o SDK:

```shell
composer update
```

## Suporte

dev@microframeworks.com
