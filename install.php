<?php

# Install Unotify

# Import Unotify SDK
require 'caminho/para/o/sdk';

use UnotifySDK\Unotify;

$uny = new Unotify('api_token','url_base');

$arg = $argv[1] ?? false;

echo $uny->obterAcesso($arg) . PHP_EOL;
