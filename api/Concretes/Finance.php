<?php

namespace Api\Concretes;

use Api\Abstractions\Database\Finance as FinanceAbstraction;
use Api\Utils\Session;

class Finance extends FinanceAbstraction
{
    public function __construct($amount, $finance_type_id)
    {
	$this->amount = $amount;
	$this->wallet_id = Session::get("wallet")["id"];
	$this->generated_number = rand(0,13);
	$this->finance_type_id = $finance_type_id;
	$this->_calculate_payout();
    }

    //Doing this by lack of time
    private function _mock_rtp()
    {
        return ($this->generated_number/$this->amount)*100;
    }

    private function _calculate_payout()
    {
        if ($this->finance_type_id==1) {
            //deposit
            $this->payout = $this->amount;
        } else if ($this->finance_type_id==2) {
            //withdrawal
            $this->payout = $this->amount*-1;
        } else if ($this->finance_type_id==3) {
            //bet
            $this->payout = $this->_mock_rtp() + Session::get("wallet")["balance"];
	}

	$_SESSION["wallet"]["balance"] = $this->payout;
    }
}
