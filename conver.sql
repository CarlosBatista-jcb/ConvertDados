CREATE TABLE cadastros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomeCompleto VARCHAR(255) NOT NULL,
    cpf VARCHAR(11) NOT NULL,
    genero ENUM('Masculino', 'Feminino') NOT NULL,
    email VARCHAR(255) NOT NULL,
    nacionalidade VARCHAR(255) NOT NULL,
    profissao VARCHAR(255),
    dataNascimento DATE NOT NULL,
    escolaridade VARCHAR(255) NOT NULL
);