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
        // Create the QR Code and store it in public folder
        $this->storeQRCode();
        
        // Create the PDF content from template
        $html2pdf = new Html2Pdf();

        ob_start();
        include( resource_path('views/pdf/pdf-template.php') );
        $pdf = ob_get_clean();

        $html2pdf->writeHTML($pdf);
        $pdfContent = $html2pdf->output("Label.pdf", 'S');

        // Store the new PDF
        Storage::put("public/climbs/$this->id/Label.pdf", $pdfContent);
    }

    public function storeQRCode()
    {
        $qrCode = new QrCode( url("/api/climbs/$this->id") );
        $qrCode->setSize(300);
        $qrCode->setWriterByName('png');
        Storage::put("public/climbs/$this->id/QR.png", $qrCode->writeString());        
    }

    public function getQRCodeURL()
    {
        return asset("storage/climbs/$this->id/QR.png");
    }
}
