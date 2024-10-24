<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Moedas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <style>
        /* Adicione seu estilo aqui */
    </style>
</head>
<body>
    <h1>Conversor de Moedas</h1>
    <div class="container">
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('converter.convert') }}" method="POST">
            @csrf
            <label for="valor">Valor:</label>
            <input type="text" id="valor" name="valor" value="{{ old('valor') }}" required placeholder="Digite o valor">
            
            <label for="de_moeda">De:</label>
            <select id="de_moeda" name="de_moeda" required>
                @foreach ($moedas as $codigo => $nome)
                    <option value="{{ $codigo }}" {{ old('de_moeda') == $codigo ? 'selected' : '' }}>{{ $nome }}</option>
                @endforeach
            </select>

            <label for="para_moeda">Para:</label>
            <select id="para_moeda" name="para_moeda" required>
                @foreach ($moedas as $codigo => $nome)
                    <option value="{{ $codigo }}" {{ old('para_moeda') == $codigo ? 'selected' : '' }}>{{ $nome }}</option>
                @endforeach
            </select>

            <label for="taxa_cambio">Taxa de Câmbio:</label>
            <input type="text" id="taxa_cambio" name="taxa_cambio" value="{{ old('taxa_cambio') }}" required placeholder="Digite a taxa de câmbio">
            
            <button type="submit"><i class="fas fa-exchange-alt"></i> Converter</button>
        </form>

        @if (isset($vValorConvertido))
            <div class="result">
                <h2>Resultado da Conversão:</h2>
                <p>{{ $vValor }} {{ $sDeMoeda }} = {{ number_format($vValorConvertido, 2) }} {{ $sParaMoeda }}</p>
                <p>Taxa de Câmbio: {{ number_format($fTaxaCambio, 2) }}</p>
            </div>
        @endif
    </div>
</body>
</html>
