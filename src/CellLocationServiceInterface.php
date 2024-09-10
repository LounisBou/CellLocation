<?php

declare(strict_types=1);

namespace Lounisbou\CellLocation;

use RuntimeException;

/**
 * Interface for cell location services.
 */
interface CellLocationServiceInterface {
    /**
     * Get the location (latitude and longitude) based on MCC, MNC, LAC, and CellID.
     *
     * @param int $mcc
     * @param int $mnc
     * @param int $lac
     * @param int $cellId
     * @param RadioType $radioType Radio type (GSM, CDMA, WCDMA, LTE)
     * @return array|null
     * @throws RuntimeException If an error occurs during the request.
     */
    public function getLocation(int $mcc, int $mnc, int $lac, int $cellId, RadioType $radioType = RadioType::GSM): ?array;
}
