# Relatório de Utilização de IA

## 1. Ferramenta ou agente de IA utilizado

| Ferramenta | Uso |
|---|---|---|
| Claude (Anthropic) | Geração e revisão de código e explicação de conceitos. |

---

## 2. Objetivo de cada utilização

1. Criar a consulta de endereço pelo CEP usando a API ViaCEP.
2. Obter latitude e longitude da cidade pela API de geocodificação do Open-Meteo.
3. Consultar o clima atual e a previsão das próximas 3 horas.
4. Traduzir os códigos de clima em textos simples (céu limpo, chuva, etc.).
5. Montar o card "Monitoramento Climático" na página `home.php`.
6. Revisar o código e apontar problemas.
7. Organizar este relatório de uso de IA.

---

## 3. Principais instruções (prompts) fornecidos

**Prompt 1 – Busca de CEP**
```text
Crie uma função em JavaScript que leia o CEP de um input, valide se tem 8 números
e consulte a API ViaCEP, tratando o caso de CEP não encontrado.
```
Resumo da resposta: função `buscarCep` com `fetch`, limpeza do CEP com regex e alerta para CEP inválido ou inexistente.

**Prompt 2 – Clima pela cidade**
```text
Com a cidade e o estado retornados pelo CEP, busque as coordenadas na API de
geocodificação do Open-Meteo e depois consulte a temperatura atual e a previsão
por hora (temperatura, chance de chuva e chuva em mm).
```
Resumo da resposta: três requisições encadeadas, uso de `URLSearchParams` e escolha da cidade pelo nome nos resultados.

**Prompt 3 – Exibição**
```text
Mostre a temperatura atual, a condição do tempo (dia ou noite) e os cards das
próximas 3 horas. Converta o weather_code em texto em português.
```
Resumo da resposta: função `interpretarClima` e geração dos cards com `innerHTML`.

**Prompt 4 – Revisão**
```text
Revise o código do home.php e do JavaScript e aponte erros ou pontos de melhoria.
```
Resumo da resposta: lista de problemas como textos de teste esquecidos, mensagem inicial incorreta e falta de tratamento visual de erro.

---

## 4. Trechos, arquivos e funcionalidades produzidos com auxílio da IA

| Trecho / funcionalidade | Arquivo | Ajuda da IA |
|---|---|---|
| Função `buscarCep` (validação, ViaCEP, tratamento de erro) | JS da home | Sugeriu o código-base |
| Geocodificação e consulta de clima | JS da home | Sugeriu o código-base |
| `interpretarClima` | JS da home | Sugeriu o código-base |
| Cards de previsão das próximas 3 horas | JS da home | Sugeriu o código-base |
| Formulário de CEP e seção `#consultaClima` | `home.php` | Apoio na estrutura |
| Relatório de uso de IA | `docs/relatorio-uso-ia.md` | Gerou o modelo inicial |

---

## 5. Alterações realizadas pela equipe no conteúdo gerado

- Ajuste dos IDs (`cep`, `buscar`, `resultadoClima`) para os do nosso HTML.
- Inclusão da guarda `window.location.pathname.includes("public/home.php")` para o script rodar só na home.
- Adaptação do layout aos cards do Bootstrap do dashboard.
- Tradução de textos e mensagens para o português.
- Remoção dos textos de teste e correção de mensagens (ver seção 7).

---

## 6. Testes executados

| # | Cenário | Entrada | Resultado esperado | Resultado |
|---|---|---|---|---|
| 1 | CEP válido | CEP de Joinville | Mostra cidade, UF, temperatura e 3 cards | Funcionou |
| 2 | CEP incompleto | `1234` | Alerta pedindo 8 números | Funcionou |
| 3 | CEP com hífen | `89200-000` | Hífen removido e consulta normal | Funcionou |
| 4 | CEP inexistente | `99999999` | Alerta "CEP não encontrado." | Funcionou |
| 5 | Sem internet | Rede desligada | Erro tratado e alerta na tela | Alerta aparece; mensagem "Buscando..." permanecia (corrigido, ver seção 7) |
| 6 | Layout | Desktop e celular | Cards sem quebrar | Funcionou |

Os testes foram feitos no navegador, com o console (F12) e a aba Network abertos para conferir as requisições.

---

## 7. Problemas identificados e como foram corrigidos

| # | Problema | Correção |
|---|---|---|
| 1 | Texto `aaaa...` e `????` esquecidos no `home.php` | Substituídos por conteúdo real |
| 2 | Mensagem inicial dizia "Informe as coordenadas", mas o campo pede CEP | Trocada por "Informe o CEP para consultar o clima." |
| 3 | Em erro de API, "Buscando..." continuava na tela | `catch` passou a restaurar a mensagem inicial |
| 4 | Formulário de CEP dentro do card do ícone de velocímetro | Card reorganizado |
| 5 | Dados inseridos com `innerHTML` e nome do usuário sem escape | Uso de `textContent` e `htmlspecialchars()` |
| 6 | Comentário `ERRO` esquecido no HTML | Removido |

---

## 8. Reflexão sobre contribuições e limitações da ferramenta

**Contribuições:** a IA acelerou a integração de três APIs encadeadas, ajudou a entender `async/await`, `fetch` e `URLSearchParams` e apontou erros que passariam despercebidos.

**Limitações:** a IA não conhece a estrutura do nosso projeto, então IDs, classes e caminhos precisaram ser adaptados. O código gerado precisou ser testado e não substitui revisão de segurança nem de qualidade.

**Aprendizado:** cada integrante explicou uma parte do código para o grupo, garantindo que entendemos o que foi entregue.

**O que faríamos diferente:** testar cada trecho logo após recebê-lo e guardar prints dos prompts desde o início.

