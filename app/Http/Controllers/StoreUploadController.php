<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Image;
use Illuminate\Http\UploadedFile;

class StoreUploadController extends Controller
{
 
    public function storeUploadFile(Request $request) {
        try {
            $captured_formatted = now()->format("F d, Y g:i A");
    
            $filename = date("Y_m_d_") . Str::random(40) . "_" . strtotime("now") . ".png";
            $image = $request->file("file");
    
            if ($image) {
                $imgFile = Image::make($image->getRealPath());
                $width = $imgFile->width();
                $height = $imgFile->height();
    
                $imgFile->rectangle(0, $height - 25, $width, $height, function ($draw) {
                    $draw->background('#fcfcfc');
                })->text("UPLOADED AT $captured_formatted", 100, $height - 12, function ($font) {
                    $font->size(12);  // Adjust the font size
                    $font->color('#000');
                    $font->align('center');
                    $font->valign('bottom');
                    $font->angle(0);
                })->save(storage_path('/app/public/uploads'), $filename);
    
                return "/uploads/$filename";
            } else {
                return response()->json([
                    "message" => "Error: No image file provided.",
                    "status" => "error"
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Error: " . $e->getMessage(),
                "status" => "error"
            ]);
        }
    }
    


    public function fileExcel(Request $request) {

        $ext = ['xlsx', 'xlsm', 'xlsb', 'xltx', 'csv'];

        foreach ($ext as $files) {
            if($request->file->extension() != $files) 
            {
                echo json_encode(array(
                    "message" => "Uploaded valid file only ('xlsx', 'xlsm', 'xlsb', 'xltx', 'csv')",
                    "status"  => "warning"
                ));
                dd();
            } else {
                $filename = 'excel_'.time().'.'.$request->file->extension();  
   
                $request->file->move(public_path('upload'), $filename);
        
                return $filename;
            }
        }
    }   

    public function donwload($path) 
    {
        return response()->download(public_path('/upload/'.$path));
    }
}
