<?php

arch('app')
    ->expect(['dd', 'dump', 'die'])
    ->not->toBeUsed();
