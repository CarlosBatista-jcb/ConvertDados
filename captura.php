<?php
// Conexão com o banco de dados
$servername = "localhost"; // Altere para o seu servidor MySQL
$username = "root"; // Altere para o seu nome de usuário do MySQL
$password = ""; // Altere para a sua senha do MySQL
$dbname = "convert"; // Altere para o nome do seu banco de dados

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// Função para calcular a idade a partir da data de nascimento
function calcularIdade($dataNascimento) {
    // Converte a data de nascimento em um objeto DateTime
    $dataNascimento = new DateTime($dataNascimento);

    // Obtém a data atual como um objeto DateTime
    $dataAtual = new DateTime();

    // Calcula a diferença entre as duas datas
    $diferenca = $dataAtual->diff($dataNascimento);

    // Retorna a idade em anos
    return $diferenca->y;
}

// Captura dos dados do formulário
$nome = $_POST['nomeCompleto'];
$cpf = $_POST['cpf'];
$genero = $_POST['genero'];
$email = $_POST['email'];
$nacionalidade = $_POST['nacionalidade'];
$profissao = $_POST['profissao'];
$dataNascimento = $_POST['dataNascimento'];
$idade = calcularIdade($dataNascimento); // Chama a função calcularIdade para obter a idade

$escolaridade = $_POST['escolaridade'];

// Inserção dos dados no banco de dados
$sql = "INSERT INTO cadastros (nomeCompleto, cpf, genero, email, nacionalidade, profissao, dataNascimento, idade, escolaridade)
        VALUES (:nome, :cpf, :genero, :email, :nacionalidade, :profissao, :dataNascimento, :idade, :escolaridade)";

try {
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':genero', $genero);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':nacionalidade', $nacionalidade);
    $stmt->bindParam(':profissao', $profissao);
    $stmt->bindParam(':dataNascimento', $dataNascimento);
    $stmt->bindParam(':idade', $idade);
    $stmt->bindParam(':escolaridade', $escolaridade);
    $stmt->execute();
    echo "Dados inseridos com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao inserir dados: " . $e->getMessage();
}

// Feche a conexão com o banco de dados
$conn = null;
?>
