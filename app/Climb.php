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
        'name', 'description', 'color', 'grade', 'rating', 'setter_id'
    ];

    /**
     * Get the attempts for the climb.
     */
    public function attempts()
    {
        return $this->hasMany('App\Attempt');
    }

    public function setter()
    {
        return $this->belongsTo('App\User', 'setter_id');
    }

    public function createLabel()
    {
        // Create the QR Code and store it in public folder
        $this->storeQRCode();
        
        // Create the PDF content from template
        $html2pdf = new Html2Pdf();
        ob_start();
        include( resource_path('views/pdf/label.blade.php') );
        $pdf = ob_get_clean();
        $html2pdf->writeHTML($pdf);
        $pdfContent = $html2pdf->output("Label.pdf", 'S');

        // Store the new PDF
        Storage::put("public/climbs/$this->id/Label.pdf", $pdfContent);
    }

    public function storeQRCode()
    {
        $qrCode = new QrCode( $this->id );
        $qrCode->setSize(300);
        $qrCode->setWriterByName('png');
        Storage::put("public/climbs/$this->id/QR.png", $qrCode->writeString());        
    }

    public function getQRCodeURL()
    {
        return asset("storage/climbs/$this->id/QR.png");
    }

    /**
     * Convert the grade of a climb to the standard grade system
     * 
     * @return string The converted grade
     */
    public static function convertGrade($grade)
    {
        $conversions = [
            "5.05" => "5.5",
            "5.06" => "5.6",
            "5.07" => "5.7",
            "5.08" => "5.8",
            "5.09" => "5.9",
            "5.10" => "5.10a",
            "5.11" => "5.10b",
            "5.12" => "5.10c",
            "5.13" => "5.10d",
            "5.14" => "5.11a",
            "5.15" => "5.11b",
            "5.16" => "5.11c",
            "5.17" => "5.11d",
            "5.18" => "5.12a",
            "5.19" => "5.12b",
            "5.20" => "5.12c",
            "5.21" => "5.12d",
            "5.22" => "5.13a",
            "5.23" => "5.13b",
            "5.24" => "5.13c",
            "5.25" => "5.13d"
        ];
        
        return $conversions[$grade];
    }

    /**
     * Returns a random grade without conversion
     * 
     * @return string The random grade
     */
    public static function getRandomGrade() {
        $grades = [
            "5.05",
            "5.06",
            "5.07",
            "5.08",
            "5.09",
            "5.10",
            "5.11",
            "5.12",
            "5.13",
            "5.14",
            "5.15",
            "5.16",
            "5.17",
            "5.18",
            "5.19",
            "5.20",
            "5.21",
            "5.22",
            "5.23",
            "5.24",
            "5.25"
        ];
    
        $random_grade = array_rand($grades);
        return $grades[$random_grade];
    }
}
