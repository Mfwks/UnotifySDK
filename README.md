# UnotifySDK
SDK oficial para integração simplificada com as API's do Unotify.

## Instalação (estável)

```shell
composer require mfwks/unotifysdk
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
