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

    // Método para processar a conversão de moeda
    public function converter(Request $request){
        // Validação dos dados
        $aDados = $request->validate([
              'valor'      => 'required|numeric|min:0'
            , 'de_moeda'   => 'required|in:USD,EUR,BRL'
            , 'para_moeda' => 'required|in:USD,EUR,BRL'
        ]);

        // Extraindo os dados validados de forma imutável
        $nValor     = $aDados['valor'];
        $sDeMoeda   = $aDados['de_moeda'];
        $sParaMoeda = $aDados['para_moeda'];

        // Obtendo a taxa de câmbio da API
        $oResposta = Http::withOptions(['verify' => false])->get("https://economia.awesomeapi.com.br/last/{$sDeMoeda}-{$sParaMoeda}");

        // Verificando a resposta da API e definindo a taxa de câmbio
        if ($oResposta->successful() && isset($oResposta->json()["{$sDeMoeda}{$sParaMoeda}"])) {
            $nTaxaCambio = $oResposta->json()["{$sDeMoeda}{$sParaMoeda}"]['bid'];
        } else {
            return back()->withErrors(['Erro ao obter a taxa de câmbio']);
        }

        $fConverterMoeda = function($nValor, $nTaxaCambio) {
            return array_map(fn($valor) => $valor * $nTaxaCambio, [$nValor])[0];
        };

        // Aplicando a função pura para obter o valor convertido
        $nValorConvertido = $fConverterMoeda($nValor, $nTaxaCambio);

        // Definindo as moedas disponíveis para exibição
        $sMoedas = [
              'USD' => 'Dólar'
            , 'EUR' => 'Euro'
            , 'BRL' => 'Real'
        ];

        return view('converter', compact('sMoedas', 'nValor', 'sDeMoeda', 'sParaMoeda', 'nValorConvertido', 'nTaxaCambio'));
    }
}
