<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class QrController extends Controller
{
    public function qr_scan()
    {
        return view('product.qr-scan');
    }

    public function submit_qr_scan(Request $request)
    {
        // melakukan validasi data
        $request->validate([
            'data' => 'required|max:500'
        ],
        [
            'data.required' => 'data wajib diisi'
        ]);
        
        
        
        return redirect()->route('index.index')
                ->with('success','Data berhasil di submit' );
    }

    public function generate_qr(Request $request)
    {
        $this->validate($request, [
            'link' => 'required|url',
        ]);
        
        // untuk usecase ku sendiri tidak menyimpan ke database
        // jadi aku akalin dengan nge-generate unique code yang
        // ku ambil dari waktu saat ini (saat mengenerate image QR)
        // lalu itu yang ku jadikan identifier untuk image yang di generate 
        $code = time();

        // untuk format, temen-temen bisa sesuaiin 
        // (format yang tersedia: png, eps, dan svg)
        // lalu temen-temen bisa menyesuaikan ukuran image QR-nya
        // dengan menambahkan ->size(ukuranDalamPixel, contoh: 100);
        // QrCode::format('png')->size(100)->generate($request->link);  
        $qr = QrCode::format('png')->generate($request->link);
        $qrImageName = $code . '.png';

        // simpan ke local storage
        Storage::put('public/qr/' . $qrImageName, $qr);

        //layoutnya bisa temen-temen sesuaiin sama kebutuhannya temen-temen
        return view('index.index', compact('code'));
    }
}