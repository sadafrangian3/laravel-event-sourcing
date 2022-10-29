<?php

namespace Spatie\EventSourcing\Tests;

use Illuminate\Support\Str;
use Spatie\EventSourcing\Support\Composer;

test('it can get all loaded files', function () {
    $pathToComposerJson = __DIR__.'/../composer.json';

    $files = Composer::getAutoloadedFiles($pathToComposerJson);

    $files = array_map(function (string $path) {
        return Str::after($path, $this->pathToTests());
    }, $files);

    $this->assertEquals([
        '/TestClasses/AutoDiscoverEventHandlers/functions.php',
    ], $files);
});
