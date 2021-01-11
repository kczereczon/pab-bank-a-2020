<?php

namespace App\Services;

use App\Exceptions\BankNotInitializedException;
use App\Models\Transaction;
use App\Models\Operation;
use App\Models\BankingAccount;
use App\Models\User;
use Exception;

class OperationService
{
    public function createOperationForClient(Transaction $transaction)
    {
        if($transaction->ben_banking_account_id != "null"){
        $operation = Operation::create([

            "transaction_id" => $transaction->id,
            "nrb_ben" => $transaction->nrb_ben,
            "name_ben" => $transaction->name_ben,
            "address_ben" => $transaction->address_ben,
            "amount" => $transaction->amount,
            "nrb_prin" => $transaction->nrb_prin,
            "address_prin" => $transaction->address_prin,
            "name_prin" => $transaction->name_prin,
            "prin_banking_account_id" => $transaction->prin_banking_account_id,
            "ben_banking_account_id" => $transaction->ben_banking_account_id

            ]);
        $moneySent = $transaction->amount;
        $prinBankingAccount = BankingAccount::find($transaction->prin_banking_account_id);
        $prinBankingAccount ->balance -= $moneySent;
        
        $prinBankingAccount ->save();

        $benBankingAccount = BankingAccount::find($transaction->ben_banking_account_id);
        $benBankingAccount ->balance += $moneySent;

        $benBankingAccount->save();

        return $operation;
        }
        else {
            $operation = Operation::create([

                "transaction_id" => $transaction->id,
                "nrb_ben" => $transaction->nrb_ben,
                "name_ben" => $transaction->name_ben,
                "address_ben" => $transaction->address_ben,
                "amount" => $transaction->amount,
                "posting_date" => "null",
                "nrb_prin" => $transaction->nrb_prin,
                "address_prin" => $transaction->address_prin,
                "name_prin" => $transaction->name_prin,                
                "prin_banking_account_id" => $transaction->prin_banking_account_id               
                ]);
                
        $moneySent = $transaction->amount;
        $prinBankingAccount = BankingAccount::find($transaction->prin_banking_account_id);
        $prinBankingAccount ->balance -= $moneySent;
        
        $prinBankingAccount ->save();

        return $operation;
        }   


     }
     
}
