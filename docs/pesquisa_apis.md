
# Pesquisa: APIs e integração entre sistemas

## 1. O que são APIs?

**O que é e para que serve?**

API é uma ferramenta que permite que dois sistemas se comuniquem e troquem informações. Por exemplo, um aplicativo pode usar uma API para consultar a previsão do tempo.

**Como funciona a comunicação?**

Um sistema faz um pedido para outro sistema, e ele responde com as informações solicitadas. Assim, eles conseguem trocar dados sem precisar acessar a tela um do outro.

**Diferença entre sistema web e API**

- **Sistema Web**
É usado por pessoas no navegador.
Mostra páginas e imagens.
tem foco na parte visual.

- **APIs**
É usado por outros sistemas.
Envia e receba dados.
Tem foco na troca de informações.

## 2. REST e HTTP

**O que é uma API REST?**

REST é um modelo usado para organizar APIs que se comunicam pela internet. Ele ajuda os sistemas a trocar informações de forma organizada.

**Métodos HTTP**

- GET: Buscar informações. 
- POST: Cadastrar informações. 
- PUT: Atualizar todas as informações de um registro. 
- PATCH: Atualizar apenas algumas informações. 
- DELETE: Excluir informações. 

**Requisições e respostas**

A requisição é o pedido que um sistema envia. A resposta é o retorno do outro sistema.

Existem códigos que mostram se algo deu certo ou errado:

- **200:** deu certo.
- **201:** algo foi criado.
- **400:** pedido incorreto.
- **404:** informação não encontrada.
- **500:** erro no servidor.

**O que são endpoints?**

São os endereços usados para acessar as funções de uma API.

Por exemplo, `GET /produtos` mostra os produtos cadastrados, enquanto `GET /produtos/15` mostra apenas o produto de número 15.

**O que é JSON?**

JSON é um formato usado para organizar e enviar informações entre sistemas.

Exemplo:

```json
{
  "id": 15,
  "nome": "Notebook",
  "preco": 3499.9
}
```

## 3. Como usar APIs com PHP

**Como usar uma API no PHP?**

O PHP pode acessar uma API para buscar informações de outro sistema. Para isso, pode usar ferramentas como cURL.

Quando recebe os dados, o PHP pode usar `json_decode()` para transformar o JSON em informações que consegue trabalhar.

Também é possível usar `json_encode()` para transformar dados em JSON e enviá-los para outro sistema.

**Como criar uma API com PHP?**

Também podemos criar uma API usando PHP. Ela recebe pedidos, consulta o banco de dados e devolve as informações solicitadas.

Por exemplo, uma API de uma loja pode mostrar os produtos cadastrados no banco de dados para outros sistemas.

É importante organizar os endereços da API e cuidar da segurança das informações.

---

## 4. Segurança das APIs

As APIs precisam de segurança para evitar que pessoas sem permissão acessem informações.

**Autenticação:** verifica quem está tentando acessar o sistema.

**Autorização:** verifica o que essa pessoa pode fazer dentro do sistema.

Alguns cuidados importantes são:

- Usar HTTPS para proteger a comunicação.
- Conferir os dados recebidos.
- Permitir que cada usuário acesse apenas o que tem autorização.
- Limitar o número de acessos em pouco tempo.
- Não deixar senhas e chaves de acesso expostas no código.

Esses cuidados ajudam a evitar invasões e o vazamento de informações.

---

## 5. Exemplos de APIs nas empresas

As APIs são usadas em várias áreas. Alguns exemplos são:

- **Lojas virtuais:** para atualizar produtos e estoques.
- **Pagamentos:** para realizar pagamentos por Pix e cartão.
- **Logística:** para acompanhar entregas e calcular fretes.
- **Notas fiscais:** para ajudar na emissão de notas fiscais eletrônicas.
- **Redes sociais e marketing:** para compartilhar informações entre sistemas.
- **Login:** para entrar em um site usando uma conta Google.
- **Consultas:** para buscar CEP, CNPJ e cotação de moedas.
- **Aplicativos:** para buscar informações de um sistema e mostrá-las no celular.

---

## Fontes

- Amazon Web Services – O que é uma API? https://aws.amazon.com/pt/what-is/api/
- SAP – O que é API? https://www.sap.com/brazil/resources/what-is-api
- IBM – O que é uma API REST? https://www.ibm.com/br-pt/think/topics/rest-apis
- Snowflake – O que é JSON? https://www.snowflake.com/pt_br/fundamentals/what-is-json/
- MDN Web Docs – Métodos HTTP: https://developer.mozilla.org/pt-BR/docs/Web/HTTP/Methods
- DEV Community – REST API: conceito e fundamentos: https://dev.to/marianacaetanocosta/rest-api-conceito-e-fundamentos-2kpd
