<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nrb_ben',
        'name_ben',
        'address_ben',
        'amount',
        'nrb_prin',
        'name_prin',
        'address_prin',
        'transaction_id',
        'prin_banking_account_id',
        'ben_banking_account_id'
    ];

    public function benAccount()
    {
        return $this->belongsTo(BankingAccount::class, "ben_banking_account_id");
    }

    public function prinAccount()
    {
        return $this->belongsTo(BankingAccount::class, "prin_banking_account_id");
    }

    public function transaction()
    {
        return $this->belongsTo(BankingAccount::class, "operation_id");
    }
}

//jak widzisz co napisalem to zedytuj to dziex xd test 