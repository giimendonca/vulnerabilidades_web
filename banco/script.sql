CREATE DATABASE IF NOT EXISTS voteSafe;
USE voteSafe;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM ('usuario', 'admin') NOT NULL DEFAULT 'usuario',
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS enquetes (
	id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    imagem VARCHAR(255) DEFAULT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS opcoes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    enquete_id INT NOT NULL,
    texto VARCHAR(255) NOT NULL,
    
    FOREIGN KEY (enquete_id) REFERENCES enquetes(id) ON DELETE CASCADE
);

CREATE TABLE votos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    opcao_id INT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id)
        ON DELETE CASCADE,

    FOREIGN KEY (opcao_id)
        REFERENCES opcoes(id)
        ON DELETE CASCADE
);

-- INSERTS INICIAIS PARA TESTES 

INSERT INTO enquetes (titulo, descricao) VALUES (
    'Qual linguagem você prefere?',
    'Escolha a linguagem de programação que você mais gosta.'
),
(
    'Qual área da tecnologia você prefere?',
    'Escolha a área que mais desperta seu interesse.'
);

INSERT INTO opcoes (enquete_id, texto) VALUES
(1, 'PHP'),
(1, 'JavaScript'),
(1, 'Python'),
(2, 'Desenvolvimento Web'),
(2, 'Banco de Dados'),
(2, 'Segurança da Informação');

INSERT INTO usuarios (nome, email, senha, tipo) VALUES ('Admin vulnerável', 'adminV@gmail.com', '123456', 'admin');