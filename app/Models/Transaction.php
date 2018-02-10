<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    public $incrementing = false;

    const NEW_ORDER = 1; // pesanan belum diverifikasi
    const WAITING_VERIFIED = 2; // pesanan menunggu verifikasi
    const VERIFIED = 3; // pesanan sudah diverifikasi dan sedang diproses
    const SHIPPED = 4; //pesanan sudah dikirim
    const FINISH = 5; //pesanan selesai
    const CANCEL = 0; // pesanan dibatalkan

    public function getStatus($index)
    {
        $status = [
            '0'=>'Canceled',
            '1'=>'Menunggu Pembayaran',
            '2'=>'Sedang Diverifikasi',
            '3'=>'Pesanan Sedang Diproses',
            '4'=>'Pesanan Sudah Dikirim',
            '5'=>'Transaksi Selesai'
        ];
        return $status[$index];
    }
    public function createId()
    {
        $date = date('ym');
        $lastRecord = Transaction::orderBy('created_at', 'DESC')->first();
        if($lastRecord->count()>0){
            $lastId = substr($lastRecord->id,6)+1;
        }else{
            $lastId = "001";
        }
        $newId = "TR".$date.substr("00000".$lastId,-4);
        return $newId;
    }
    public function transaction_detail()
    {
        return $this->hasMany('App\Models\TransactionDetail', 'transaction_id');
    }
    public function payment()
    {
        return $this->hasMany('App\Models\Payment', 'transaction_id');
    }
}
