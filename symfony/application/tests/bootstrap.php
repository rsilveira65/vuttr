<?php
/**
 * Created by PhpStorm.
 * User: rafael
 * Date: 20/07/18
 * Time: 14:37
 */

echo 'cleaning cache';
$commands =
    [
        'php "%s/../bin/console" cache:clear --env=dev --no-warmup',
        'php "%s/../bin/console" cache:clear --env=prod --no-warmup',
    ];

foreach ($commands as $command) {
    executeCommand($command);
}

function executeCommand(string $command) {
    passthru(
        sprintf(
            $command,
            __DIR__
        )
    );
}

require __DIR__.'/../vendor/autoload.php';