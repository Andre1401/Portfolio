<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_id', 'books_id', 'qty'];

    public function book()
    {
        return $this->belongsTo('App\Models\Book', 'book_id');
    }

    public function transaction()
    {
        return $this->belongsTo('App\Models\transaction', 'transaction_id');
    }

    public function onebooks()
    {
        return $this->hasMany('App\Models\books', 'id');
    }
    
    public function transDetail()
    {
        return $this->hasMany('App\Models\transaction', 'transaction_id');
    }
}
