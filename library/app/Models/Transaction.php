<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'date_start', 'date_end'];

    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'member_id');
    }

    public function transaction_details()
    {
        return $this->hasMany('App\Models\TransactionDetail', 'transaction_id');
    }

    public function firstMembers()
    {
        return $this->hasMany('App\Models\Members', 'id');
    }
    public function id_detail()
    {
        return $this->hasOne('App\Models\transactionDetail', 'id');
    }
}
