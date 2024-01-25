<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerateQrController extends Controller
{
    public function embedSrc()
    {
        return view('staf.generateQrForm', [
            'title' => 'Buat Kode QR',
            'back' => redirect()->back()
        ]);
    }

    public function generate(Request $request)
    {
        $validatedData = $request->validate([
            'url' => 'required',
            'image' => 'nullable|dimensions:ratio=1/1'
        ], [
            'url.required' => 'URL tidak boleh kosong!',
            'image.dimensions' => 'Dimensi gambar harus 1:1!'
        ]);

        $image = $request->file('image');
        if ($image) {
            $qrBinary = QrCode::format('png')
                        ->size(400)
                        ->errorCorrection('H')
                        ->merge($image->getRealPath(), 0.3, true)
                        ->generate($validatedData['url']);
        } else {
            $qrBinary = QrCode::format('png')
                        ->size(400)
                        ->errorCorrection('H')
                        ->generate($validatedData['url']);
        }

        return view('staf.generateQrResult', [
            'title' => 'Buat Kode QR',
            'qr' => $qrBinary,
        ]);
    }

    public function download(Request $request)
    {
        return response(
            base64_decode($request->input('qr')),
            200,
            [
                'Content-Type' => 'image/png',
                'Content-Disposition' => 'attachment; filename="KodeQR_'.now()->format('Y-m-d').'.png"',
            ]
        );
    }
}
