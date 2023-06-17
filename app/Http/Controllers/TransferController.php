<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public static function generateIdTransaksi()
    {
        $date = Carbon::now()->format('ymd');
        
        $latestTransfer = Transfer::latest()->first();
        $counter = 1;
        
        if ($latestTransfer) {
            $latestIdTransaksi = $latestTransfer->id_transaksi;
            $latestCounter = intval(substr($latestIdTransaksi, -5));
            $counter = $latestCounter + 1;
        }
        
        $counterFormatted = str_pad($counter, 5, '0', STR_PAD_LEFT);
        
        return "TF{$date}{$counterFormatted}";
    }


    public function transfer(Request $request)
    {
        try {
            $this->validate($request, [
                'nilai_transfer' => 'required',
                'bank_tujuan' => 'required',
                'rekening_tujuan' => 'required',
                'atasnama_tujuan' => 'required',
                'bank_pengirim' => 'required',
            ]);
    
            $data = New Transfer();
            $data->nilai_transfer = $request->nilai_transfer;
            $data->bank_tujuan = $request->bank_tujuan;
            $data->rekening_tujuan = $request->rekening_tujuan;
            $data->atasnama_tujuan = $request->atasnama_tujuan;
            $data->bank_pengirim = $request->bank_pengirim;
            $data->bank_perantara = $request->bank_tujuan;
            $data->rekening_perantara = random_int(10000000000, 99999999999);
            $data->biaya_admin = 0;
            $data->total_transfer = $request->nilai_transfer + $data->biaya_admin;
            $data->kode_unik = random_int(100, 999);
            $data->id_transaksi = $this->generateIdTransaksi();

            // set berlaku hingga 
            $date = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
            $daysToAdd = 1;
            $date = $date->addDays($daysToAdd);
            $data->berlaku_hingga = $date->format('Y-m-d H:i:s');

            $data->save();


            return response()->json([
                'id_transaksi' => $data->id_transaksi,
                'kode_unik' => $data->kode_unik,
                'biaya_admin' => $data->biaya_admin,
                'total_transfer' => $data->total_transfer,
                'bank_perantara' => $data->bank_perantara,
                'rekening_perantara' => $data->rekening_perantara,
                'berlaku_hingga' => $data->berlaku_hingga,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Gagal Transfer',
                'eror' =>  $th->getMessage(),
            ]);
        }
    }

}
