<?php

declare(strict_types=1);

use Lounisbou\CellLocation\CellData;
use Lounisbou\CellLocation\CellLocator;
use Lounisbou\CellLocation\Enums\RadioType;
use Lounisbou\CellLocation\Services\OpenCellIDService;
use Lounisbou\CellLocation\Services\UnwiredLabsService;
use Lounisbou\CellLocation\Services\GoogleGeolocationService;

// Create cell data with known location data
$cellData = new CellData(
    mcc: 260,
    mnc: 2,
    lac: 10250,
    cellId: 2651, // Invalid cell ID (should be 26511)
    radioType: RadioType::GSM
);

test('getLocation returns not found with OpenCellID service', function () use ($cellData) {
    // Create an instance of the OpenCellID service
    $openCellIdService = new OpenCellIDService($_ENV['OPENCELLID_API_KEY']);

    // Create an instance of the CellLocator
    $cellLocator = new CellLocator($openCellIdService);

    // Expect cell location to be null
    $this->assertNull($cellLocator->getLocation($cellData));
});

test('getLocation returns not found with UnwiredLabs service', function () use ($cellData) {
    // Create an instance of the UnwiredLabs service
    $unwiredLabsService = new UnwiredLabsService($_ENV['UNWIREDLABS_API_KEY']);

    // Create an instance of the CellLocator
    $cellLocator = new CellLocator($unwiredLabsService);

    // Expect cell location to be null
    $this->assertNull($cellLocator->getLocation($cellData));
});

test('getLocation NEVER RETURN NOT FOUND WITH GOOGLE MAPS API', function () use ($cellData) {
    // Create an instance of the GoogleGeolocationService
    $googleGeolocationService = new GoogleGeolocationService($_ENV['GOOGLE_MAPS_API_KEY']);

    // Create an instance of the CellLocator
    $cellLocator = new CellLocator($googleGeolocationService);

    // Expect location accuracy to be over 2000 meters
    $cellLocation = $cellLocator->getLocation($cellData);
    // All values are float
    $this->assertIsFloat($cellLocation->latitude);
    $this->assertIsFloat($cellLocation->longitude);
    $this->assertIsFloat($cellLocation->accuracy);
});
