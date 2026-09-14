<?php

namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;


class QrCodeService
{

    public function generate($data)
    {

        return base64_encode(
            QrCode::format('svg')
                ->size(300)
                ->generate($data)
        );

    }

}