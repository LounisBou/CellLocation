<?php

use CellLocation\CellLocator;
use CellLocation\OpenCellIDService;
use CellLocation\UnwiredLabsService;
use CellLocation\GoogleGeolocationService;

test('findLocation returns not found with OpenCellID service', function () {
    // Create an instance of the OpenCellID service
    $openCellIdService = new OpenCellIDService($_ENV['OPENCELLID_API_KEY']);

    // Create an instance of the CellLocator
    $cellLocator = new CellLocator($openCellIdService);

    // Expect the output to be 'Location not found.'
    $this->expectOutputString('Location not found.' . PHP_EOL);

    // Test with unknown cell location data
    $cellLocator->findLocation(0, 0, 0, 0);
});

test('findLocation returns not found with UnwiredLabs service', function () {
    // Create an instance of the UnwiredLabs service
    $unwiredLabsService = new UnwiredLabsService($_ENV['UNWIREDLABS_API_KEY']);

    // Create an instance of the CellLocator
    $cellLocator = new CellLocator($unwiredLabsService);

    // Expect the output to be 'Location not found.'
    $this->expectOutputString('Location not found.' . PHP_EOL);

    // Test with unknown cell location data
    $cellLocator->findLocation(0, 0, 0, 0);
});

test('findLocation returns not found with GoogleGeolocation service', function () {
    // Create an instance of the GoogleGeolocationService
    $googleGeolocationService = new GoogleGeolocationService($_ENV['GOOGLE_API_KEY']);

    // Create an instance of the CellLocator
    $cellLocator = new CellLocator($googleGeolocationService);

    // Expect the output to be 'Location not found.'
    $this->expectOutputString('Location not found.' . PHP_EOL);

    // Test with unknown cell location data
    $cellLocator->findLocation(0, 0, 0, 0);
});
