<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConvertorController extends Controller
{
    // Método para exibir a página do conversor
    public function index()
    {
        // Definindo as moedas disponíveis
        $moedas = [
            'USD' => 'Dólar',
            'EUR' => 'Euro',
            'BRL' => 'Real'
        ];
        
        return view('converter', compact('moedas'));
    }

    // Método para processar a conversão de moeda
    public function convert(Request $request)
    {
        // Validação dos dados
        $dadosValidados = $request->validate([
            'valor'       => 'required|numeric|min:0',
            'de_moeda'    => 'required|in:USD,EUR,BRL',
            'para_moeda'  => 'required|in:USD,EUR,BRL',
            'taxa_cambio' => 'required|numeric|min:0',
        ]);

        // Extraindo os dados validados
        $vValor = $dadosValidados['valor'];
        $sDeMoeda = $dadosValidados['de_moeda'];
        $sParaMoeda = $dadosValidados['para_moeda'];
        $fTaxaCambio = $dadosValidados['taxa_cambio'];

        // Função pura para converter moeda
        $fConverterMoeda = function($vValor, $fTaxaCambio, $sDeMoeda, $sParaMoeda) {
            // Verifica se está convertendo de uma moeda para outra
            if ($sDeMoeda === 'BRL' && $sParaMoeda === 'USD') {
                return $vValor / $fTaxaCambio; // Real para Dólar
            } elseif ($sDeMoeda === 'BRL' && $sParaMoeda === 'EUR') {
                return $vValor / $fTaxaCambio; // Real para Euro
            } elseif ($sDeMoeda === 'USD' && $sParaMoeda === 'BRL') {
                return $vValor * $fTaxaCambio; // Dólar para Real
            } elseif ($sDeMoeda === 'USD' && $sParaMoeda === 'EUR') {
                return $vValor * $fTaxaCambio; // Dólar para Euro
            } elseif ($sDeMoeda === 'EUR' && $sParaMoeda === 'BRL') {
                return $vValor * $fTaxaCambio; // Euro para Real
            } elseif ($sDeMoeda === 'EUR' && $sParaMoeda === 'USD') {
                return $vValor * $fTaxaCambio; // Euro para Dólar
            }
            // Caso de moedas iguais, não há conversão
            return $vValor;
        };

        // Aplicando a função pura
        $vValorConvertido = $fConverterMoeda($vValor, $fTaxaCambio, $sDeMoeda, $sParaMoeda);

        // Definindo as moedas disponíveis para a exibição
        $moedas = [
            'USD' => 'Dólar',
            'EUR' => 'Euro',
            'BRL' => 'Real'
        ];

        return view('converter', compact('moedas', 'vValor', 'sDeMoeda', 'sParaMoeda', 'vValorConvertido', 'fTaxaCambio'));
    }
}
