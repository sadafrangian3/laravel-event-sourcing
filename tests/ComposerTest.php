<?php

namespace Spatie\EventSourcing\Tests;

use Illuminate\Support\Str;

use function PHPUnit\Framework\assertEquals;

use Spatie\EventSourcing\Support\Composer;

it('can get all loaded files', function () {
    $pathToComposerJson = __DIR__.'/../composer.json';

    $files = Composer::getAutoloadedFiles($pathToComposerJson);

    $files = array_map(function (string $path) {
        return Str::after($path, $this->pathToTests());
    }, $files);

    assertEquals([
        '/TestClasses/AutoDiscoverEventHandlers/functions.php',
    ], $files);
});
