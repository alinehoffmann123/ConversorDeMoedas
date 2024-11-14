<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ConversorController extends Controller {

    // Método para exibir a página do conversor
    public function index() {
        // Definindo as moedas disponíveis
        $sMoedas = [
              'USD' => 'Dólar'
            , 'EUR' => 'Euro'
            , 'BRL' => 'Real'
        ];
        
        return view('converter', compact('sMoedas'));
    }

    // Função que verificar se os dados de entrada para a conversão de moeda estão corretos
    function validadDadosMoedas($nValores, $sDeMoedas, $sParaMoedas) {
        if (!is_numeric($nValores) || $nValores <= 0) {
          return "O valor deve ser um número positivo.";
        }
        
        $aMoedasValidas = ['USD', 'EUR', 'BRL'];
        
        if (!in_array($sDeMoedas, $aMoedasValidas)) {
          return "Moeda de origem inválida.";
        }
        
        if (!in_array($sParaMoedas, $aMoedasValidas)) {
          return "Moeda de destino inválida.";
        }
        
        return true;
    }

    // Método para processar a conversão de moeda
    public function converter(Request $request) {
        $nValor     = $request->input('valor');
        $sDeMoeda   = $request->input('de_moeda');
        $sParaMoeda = $request->input('para_moeda');
        
        $bResultadoValidacao = $this->validadDadosMoedas($nValor, $sDeMoeda, $sParaMoeda);
        
        if ($bResultadoValidacao !== true) {
        return back()->withErrors([$bResultadoValidacao]);
        }
        
        $oResposta = Http::withOptions(['verify' => false])->get("https://economia.awesomeapi.com.br/last/{$sDeMoeda}-{$sParaMoeda}");
        
        if ($oResposta->successful() && isset($oResposta->json()["{$sDeMoeda}{$sParaMoeda}"])) {
        $nTaxaCambio = $oResposta->json()["{$sDeMoeda}{$sParaMoeda}"]['bid'];
        } else {
        return back()->withErrors(['Erro ao obter a taxa de câmbio']);
        }
        
        $fConverterMoeda = fn($nValor, $nTaxaCambio) => $nValor * $nTaxaCambio;
        $nValorConvertido = $fConverterMoeda($nValor, $nTaxaCambio);
        
        $sMoedas = ['USD' => 'Dólar', 'EUR' => 'Euro', 'BRL' => 'Real'];
        
        return view('converter', compact('sMoedas', 'nValor', 'sDeMoeda', 'sParaMoeda', 'nValorConvertido', 'nTaxaCambio'));
    }
        
}
