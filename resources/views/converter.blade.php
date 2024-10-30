<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Moedas 🌍💰</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <style>
        /* Adicione seu estilo aqui */
    </style>
</head>
<body>
    <h1>Conversor de Moedas 🌍💰</h1>
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

        <form action="{{ route('converter.converter') }}" method="POST">
            @csrf
            <label for="valor">Valor:</label>
            <input type="number" step="0.01" min="0.01" id="valor" name="valor" value="{{ old('valor') }}" placeholder="Digite o valor">
            
            <label for="de_moeda">De:</label>
            <select id="de_moeda" name="de_moeda" required>
                @foreach ($sMoedas as $iKey => $sNome)
                    <option value="{{ $iKey }}" {{ old('de_moeda') == $iKey ? 'selected' : '' }}>{{ $sNome }}</option>
                @endforeach
            </select>

            <label for="para_moeda">Para:</label>
            <select id="para_moeda" name="para_moeda" required>
                @foreach ($sMoedas as $iKey => $sNome)
                    <option value="{{ $iKey }}" {{ old('para_moeda') == $iKey ? 'selected' : '' }}>{{ $sNome }}</option>
                @endforeach
            </select>

            <button type="submit" id="btnConverter" disabled><i class="fas fa-exchange-alt"></i> Converter</button>
        </form>

        @if (isset($nValorConvertido))
            <div class="result">
                <h2>Resultado da Conversão:</h2>
                <p>{{ $nValor }} {{ $sDeMoeda }} = {{ number_format($nValorConvertido, 2) }} {{ $sParaMoeda }}</p>
            </div>
        @endif
    </div>

    <script>
        const sMoedaDe      = document.getElementById('de_moeda');
        const sMoedaPara    = document.getElementById('para_moeda');
        const nValorImput   = document.getElementById('valor');
        const sBtnConverter = document.getElementById('btnConverter');

        // Função para desabilitar o botão se as moedas forem iguais ou se o valor for inválido
        function jVereficarCondicoes() {
            const sMoedasDiferentes = sMoedaDe.value !== sMoedaPara.value;
            const nValorValido      = parseFloat(nValorImput.value) > 0;

            // Habilita o botão se ambas as condições forem verdadeiras
            sBtnConverter.disabled = !(sMoedasDiferentes && nValorValido);
        }

        // Adicionando eventos para verificar sempre que houver mudanças nos selects e no input de valor
        sMoedaDe.addEventListener('change', jVereficarCondicoes);
        sMoedaPara.addEventListener('change', jVereficarCondicoes);
        nValorImput.addEventListener('input', jVereficarCondicoes);

        jVereficarCondicoes();
    </script>
</body>
</html>
