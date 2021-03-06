<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BalanceSumasSaldos extends CI_CONTROLLER
{
    function __construct() {
        parent::__construct(); 
        $this->load->library('session');
        $this->load->model('BalanceSumasSaldosModel');
    }

    public function index()
    {
        $accounts = $this->BalanceSumasSaldosModel->getAllAccounts();
        $balances = array();
        $totalBalanceSumaDebe = 0;
        $totalBalanceSumaHaber = 0;
        $totalBalanceSaldoDeudor = 0;
        $totalBalanceSaldoAcreedor = 0;

        foreach ($accounts as $account) {
            $debit = $this->BalanceSumasSaldosModel->getDebit($account->id);
            $credit = $this->BalanceSumasSaldosModel->getCredit($account->id);
            
            $totalDebit = 0;
            $totalCredit = 0;
            $saldoDebit = 0;
            $saldoCredit = 0;

            if ($debit != false) {
                foreach ($debit as $transaction) {
                    $totalDebit += $transaction->payrate;
                }
            }
            
            if ($credit != false) {
                foreach ($credit as $transaction) {
                    $totalCredit += $transaction->payrate;
                }
            }
            
            if ($totalDebit > $totalCredit) {
                $saldoDebit = $totalDebit - $totalCredit;
            } else if ($totalCredit > $totalDebit) {
                $saldoCredit = $totalCredit - $totalDebit;
            }

            $balance = new stdClass();
            $balance->name = $account->name;
            $balance->totalDebit = $totalDebit;
            $balance->totalCredit = $totalCredit;
            $balance->saldoDebit = $saldoDebit;
            $balance->saldoCredit = $saldoCredit;
            $balances[] = $balance;

            $totalBalanceSumaDebe += $totalDebit;
            $totalBalanceSumaHaber += $totalCredit;
            $totalBalanceSaldoDeudor += $saldoDebit;
            $totalBalanceSaldoAcreedor += $saldoCredit;
        }
        
        

        $data['balances'] = $balances;
        $data['totalBalanceSumaDebe'] = $totalBalanceSumaDebe;
        $data['totalBalanceSumaHaber'] = $totalBalanceSumaHaber;
        $data['totalBalanceSaldoDeudor'] = $totalBalanceSaldoDeudor;
        $data['totalBalanceSaldoAcreedor'] = $totalBalanceSaldoAcreedor;

        if ($totalBalanceSumaDebe == $totalBalanceSumaHaber) {
            $data['comprobacionSumas'] = 'iguales';
        } else {
            $data['comprobacionSumas'] = 'distintos';
        }
        if ($totalBalanceSaldoDeudor == $totalBalanceSaldoAcreedor) {
            $data['comprobacionSaldos'] = 'iguales';
        } else {
            $data['comprobacionSaldos'] = 'distintos';
        }

        $this->load->view('templates/header');
        $this->load->view('balance-sumas-saldos/index', $data);
        $this->load->view('templates/footer');
    }
}
?>