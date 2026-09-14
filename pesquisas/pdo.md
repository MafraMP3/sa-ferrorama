Pesquisa PDO 

1. Oque é PDO 
    PDO é uma extensão do PHP chamada PHP Data Objects. Ele define uma interface leve e consistente para acessar bancos de dados no PHP. É totalmente orientado a objetos e possui diversos recursos importantes, além de oferecer suporte a diferentes sistemas de banco de dados.

    Com o PDO podemos fazer aplicação PHP se conecte a um banco de dados e realize operações como inserir, consultar, alterar e excluir dados. Ele também possui recursos que ajudam no desenvolvimento de aplicações mais seguras e organizadas, como Prepared Statements e tratamento de erros.

    Uma das principais características do PDO é que ele pode trabalhar com diferentes bancos de dados por meio de drivers específicos. Dessa forma, o desenvolvedor não fica limitado somente ao MySQL.

2. Para que o PDO é utilizado no PHP

    O PDO é utilizado no PHP para realizar a comunicação entre uma aplicação e um banco de dados. Ele permite conectar a aplicação a diferentes sistemas de banco de dados e executar comandos SQL para inserir, consultar, alterar e excluir dados.

    Além disso, o PDO oferece recursos para tornar o desenvolvimento mais seguro e organizado, como Prepared Statements, que ajudam a proteger as consultas contra SQL Injection, transações, que permitem controlar várias operações como uma única ação, e tratamento de erros por meio de exceções.

3. Como funciona uma conexão utilizando PDO

    Para criar uma conexão com um banco de dados utilizando PDO, primeiro é necessário criar um objeto da classe PDO. Nele são informados os dados necessários para acessar o banco, como o tipo de banco, o endereço do servidor, o nome do banco, o usuário e a senha.

    Um exemplo de conexão com MySQL utilizando PDO seria:

    <?php

    $host = "localhost";
    $dbname = "meu_banco";
    $user = "root";
    $password = "";

    try {
        $pdo = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
            $user,
            $password
        );

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "Conectado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao conectar ao banco de dados.";
    }
    ?>

    Nesse exemplo, os dados do banco são armazenados em variáveis e utilizados para criar a conexão. O try tenta realizar a conexão e o catch é utilizado para tratar possíveis erros.

    A conexão fica disponível através da variável $pdo, que pode ser utilizada posteriormente para executar comandos SQL, consultar dados e realizar outras operações no banco de dados.

4. Quais são suas principais características
    O PDO possui algumas características que facilitam o desenvolvimento de aplicações PHP que utilizam bancos de dados. Entre as principais estão:

    .Suporte a diferentes bancos de dados: o PDO pode trabalhar com diferentes sistemas de banco de dados, como MySQL, PostgreSQL e SQLite, utilizando drivers específicos.
    .Orientação a objetos: o PDO utiliza objetos e classes para realizar operações como conexão, execução de comandos e tratamento de erros.
    .Prepared Statements: possui suporte a consultas preparadas, que ajudam a proteger a aplicação contra ataques de SQL Injection.
    .Suporte a transações: permite agrupar várias operações e confirmar todas de uma vez ou desfazer as alterações caso aconteça algum  erro.
    .Tratamento de erros: possui recursos para identificar e tratar problemas durante a conexão ou execução dos comandos.
    Portabilidade: como possui uma interface padronizada, facilita a adaptação da aplicação quando é necessário trabalhar com outro banco de dados.

5. Diferenças entre PDO e MySQLi
    PDO e MySQLi são duas formas de trabalhar com bancos de dados no PHP, porém possuem algumas diferenças importantes.

    A principal diferença é que o PDO suporta vários sistemas de banco de dados, como MySQL, PostgreSQL e SQLite, enquanto o MySQLi é utilizado exclusivamente com o MySQL.

    Outra diferença é que o PDO trabalha somente com orientação a objetos, enquanto o MySQLi permite utilizar tanto orientação a objetos quanto programação procedural.

    Os dois possuem suporte a Prepared Statements, que ajudam a proteger as aplicações contra SQL Injection. Ambos também possuem recursos para tratamento de erros e transações.

    O PDO possui maior portabilidade, pois pode ser utilizado com diferentes bancos de dados. Já o MySQLi é mais específico para projetos que utilizam o MySQL.

    Em relação à escolha, o PDO pode ser uma boa opção quando existe a possibilidade de trocar o banco de dados no futuro. Já o MySQLi pode ser utilizado tranquilamente quando o projeto será desenvolvido exclusivamente com MySQL.

6. Vantagens e desvantagens de utilizar PDO
    Vantagens

    O PDO possui várias vantagens para o desenvolvimento de aplicações PHP que utilizam bancos de dados.

    .Portabilidade: pode trabalhar com diferentes sistemas de banco de dados, facilitando uma possível mudança de banco no futuro.
    .Segurança: possui suporte a Prepared Statements, que ajudam a proteger a aplicação contra ataques de SQL Injection.
    .Organização: utiliza orientação a objetos, deixando a conexão e as operações com o banco mais organizadas.
    .Transações: permite controlar várias operações no banco e desfazê-las caso aconteça algum erro.
    .Tratamento de erros: possui recursos para identificar e tratar erros durante a conexão ou execução dos comandos.

    Desvantagens

    Apesar das vantagens, o PDO também possui algumas desvantagens.

    .Curva de aprendizado: para quem está começando, alguns métodos e recursos do PDO podem parecer mais complicados.
    .Não elimina as diferenças entre bancos: mesmo podendo trabalhar com vários bancos, algumas consultas SQL específicas precisam ser adaptadas quando se troca de SGBD.
    .Pode exigir mais configuração: dependendo do projeto, é necessário configurar corretamente os drivers e as opções de conexão.

    De forma geral, as vantagens do PDO estão principalmente na segurança, organização e flexibilidade, enquanto suas desvantagens estão mais relacionadas ao aprendizado e às diferenças entre os sistemas de banco de dados.

7. O que são Prepared Statements e por que são importantes
    Prepared Statements, ou instruções preparadas, são uma forma mais segura de executar comandos SQL. Em vez de colocar diretamente os valores recebidos pelo usuário dentro da consulta, são utilizados marcadores, como :nome ou ?, para representar esses valores.

    No PDO, primeiro a consulta é preparada utilizando o método prepare() e depois os valores são enviados através do método execute().

    Por exemplo:

    $sql = "INSERT INTO usuarios (nome, email) VALUES (:nome, :email)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":nome" => $nome,
        ":email" => $email
    ]);

    Nesse exemplo, :nome e :email são os marcadores que recebem os valores somente na hora da execução.

    Os Prepared Statements são importantes principalmente por ajudarem a proteger a aplicação contra SQL Injection. Como os dados do usuário são tratados separadamente da estrutura do comando SQL, fica mais difícil que um valor inserido pelo usuário seja interpretado como um comando SQL.

    Além da segurança, eles também deixam o código mais organizado e facilitam a reutilização de uma mesma consulta com valores diferentes.

8. Em quais situações o PDO pode ser uma boa escolha?

    O PDO pode ser uma boa escolha em projetos PHP que precisam trabalhar com bancos de dados de forma segura, organizada e flexível.

    Ele é especialmente útil quando existe a possibilidade de trocar o sistema de banco de dados no futuro, pois suporta diferentes bancos através de drivers. Também é uma boa opção em aplicações que recebem dados dos usuários e precisam utilizar Prepared Statements para aumentar a segurança contra SQL Injection.

    Além disso, o PDO pode ser utilizado em projetos que precisam realizar transações, trabalhar com orientação a objetos ou executar várias operações no banco de dados de forma organizada.

    De forma geral, o PDO é uma boa escolha quando o projeto busca segurança, organização, flexibilidade e facilidade para trabalhar com diferentes bancos de dados.

9. Referencias 
    PHP. PDO: Conexões e gerenciamento de conexões. Disponível em: https://www.php.net/manual/pt_BR/pdo.connections.php. Acesso em: 9 set. 2026.

    PHP. PDO: Erros e manipulação de erros. Disponível em: https://www.php.net/manual/pt_BR/pdo.error-handling.php. Acesso em: 9 set. 2026.

    PHP. PHP Data Objects (PDO). Disponível em: https://www.php.net/manual/pt_BR/book.pdo.php. Acesso em: 9 set. 2026.

    TRYBE. PDO PHP: o que é e como utilizar. Disponível em: https://blog.betrybe.com/php/pdo-php/. Acesso em: 9 set. 2026.

    YOUTUBE. PDO PHP. Disponível em: https://www.youtube.com/watch?v=i6xnGe_pcOQ. Acesso em: 9 set. 2026.