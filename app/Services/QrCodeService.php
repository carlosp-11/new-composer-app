<?php

namespace App\Services;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\SvgWriter;

class QrCodeService
{
    public function svg(string $data, int $size = 300): string
    {
        $builder = new Builder(
            writer: new SvgWriter(),
            data: $data,
            size: $size,
            margin: 10,
            errorCorrectionLevel: ErrorCorrectionLevel::Medium,
            foregroundColor: new Color(11, 15, 20),
            backgroundColor: new Color(255, 255, 255),
        );

        return $builder->build()->getString();
    }

    public function png(string $data, int $size = 600): string
    {
        $builder = new Builder(
            writer: new PngWriter(),
            data: $data,
            size: $size,
            margin: 10,
            errorCorrectionLevel: ErrorCorrectionLevel::Medium,
            foregroundColor: new Color(11, 15, 20),
            backgroundColor: new Color(255, 255, 255),
        );

        return $builder->build()->getString();
    }
}
