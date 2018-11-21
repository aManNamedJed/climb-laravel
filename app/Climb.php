<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spipu\Html2Pdf\Html2Pdf;
use Endroid\QrCode\QrCode;

class Climb extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'color', 'grade', 'setter_id'
    ];

    public function createLabel()
    {
        $html2pdf = new Html2Pdf();
        $this->storeQRCode();
        $qr_url = asset("storage/climbs/$this->id/QR.png");
        $html2pdf->writeHTML("<h1>New Climb: $this->name</h1><img src='$qr_url' width='300' height='300' />");
        $pdfContent = $html2pdf->output("Label.pdf", 'S');
        Storage::put("public/climbs/$this->id/Label.pdf", $pdfContent);
    }

    public function storeQRCode()
    {
        $qrCode = new QrCode( url("/api/climbs/$this->id") );
        $qrCode->setSize(300);
        $qrCode->setWriterByName('png');
        Storage::put("public/climbs/$this->id/QR.png", $qrCode->writeString());        
    }
}
