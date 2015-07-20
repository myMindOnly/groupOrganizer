<?php

/*
 * This file is part of the GOrganizer package.
 *
 * (c) Osama Agh <osama.agha24@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__.'/src/Autoloader.php';

GOrganizer\Autoloader::register();

require __DIR__.'/../predis/src/Autoloader.php';

Predis\Autoloader::register();

GOrganizer\Configuration\Config::register();