# 🌍 Conversor de Moedas

Bem-vindo ao **Conversor de Moedas**! Este projeto é uma aplicação web simples desenvolvida em **PHP** com o framework **Laravel**. A aplicação permite que os usuários convertam valores entre diferentes moedas, utilizando uma interface amigável e seguindo princípios de programação funcional.

---

## 🎯 Funcionalidades

- **Conversão de Moedas**: Converta valores entre Dólar (USD), Euro (EUR) e Real (BRL).
- **Interface Intuitiva**: Selecione a moeda de origem e a moeda de destino, insira o valor e veja o resultado em tempo real.
- **Validação de Entrada**: Garantimos que apenas valores válidos sejam processados.
- **Aplicação de Taxas de Câmbio**: Insira a taxa de câmbio e veja a conversão corretamente aplicada.

---

## 🚀 Como Executar o Projeto

### Pré-requisitos

1. **PHP** (versão 7.3 ou superior)
2. **Composer** (gerenciador de pacotes PHP)
3. **Laravel** (versão 8 ou superior)

### Instalação

Clone o repositório com `git clone https://github.com/alinehoffmann123/ConversorDeMoedas.git`, acesse a pasta do projeto com `cd ConversorDeMoedas`, instale as dependências usando `composer install` e inicie o servidor com `php artisan serve`. Acesse a aplicação no navegador em [http://localhost:8000](http://localhost:8000).

---

## 💻 Exemplo de Uso

Para converter R$ 85,00 de Real (BRL) para Dólar (USD) com uma taxa de câmbio de 5, você deve inserir os seguintes dados: 
- **Valor**: R$ 85,00 
- **De Moeda**: Real (BRL) 
- **Para Moeda**: Dólar (USD) 
- **Taxa de Câmbio**: 5 
A saída será: **Valor Convertido**: USD 17,00.

---

## 🧩 Princípios de Programação Funcional

Todas as funções de conversão de moeda são puras, ou seja, dado um mesmo conjunto de entradas, a saída sempre será a mesma, sem causar efeitos colaterais. Os valores de entrada não são alterados durante o processo de conversão. Uma nova variável é gerada para armazenar o resultado da conversão, mantendo o valor original intacto. O código utiliza funções que aceitam outras funções como parâmetros, permitindo maior flexibilidade e reutilização de código. A validação é realizada através de funções puras, assegurando que entradas inválidas não afetem o estado da aplicação.

---

## 📞 Contato

**Desenvolvido por: Aline Fernanda Hoffmann** - [aline.hoffmann@unidavi.edu.br](mailto:aline.hoffmann@unidavi.edu.br) | **GitHub**: [alinehoffmann123](https://github.com/alinehoffmann123)

---

Agradeço por conferir meu projeto! Espero que você o ache interessante. 🚀
