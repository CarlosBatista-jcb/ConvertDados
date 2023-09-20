<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">      
    <title>Converte Dados</title>

    <!-- Adicione os links para o Bootstrap e Chart.js -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Cabeçalho estilizado -->
    <header>
        <center><img src="images/header.png" alt="Header Image"></center>
        <center><h1>Converte Dados</h1></center>
    </header>
    
    <!-- Formulário de pesquisa -->
    <form id="formulario" action="captura.php" method="post">
        <div class="form-group">
            <label for="nomeCompleto">Nome Completo <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nomeCompleto" name="nome" required placeholder="Nome Completo">
        </div>
        <div class="form-group">
            <label for="cpf">CPF <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="cpf" name="cpf" pattern="\d{11}" required placeholder="CPF (11 dígitos)">
            <span id="cpfError" style="color: red;"></span>
        </div>
      
        <div class="form-group">
            <label>Gênero <span class="text-danger">*</span></label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="genero" id="masculino" value="Masculino" required>
                <label class="form-check-label" for="masculino">Masculino</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="genero" id="feminino" value="Feminino" required>
                <label class="form-check-label" for="feminino">Feminino</label>
            </div>
        </div>
      
        <div class="form-group">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" name="email" required placeholder="Email">
        </div>
      
        <div class="form-group">
            <label for="nacionalidade">Nacionalidade <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nacionalidade" name="nacionalidade" required placeholder="Nacionalidade">
        </div>
      
        <div class="form-group">
            <label for="profissao">Profissão</label>
            <input type="text" class="form-control" id="profissao" name="profissao" placeholder="Profissão">
        </div>
      
        <div class="form-group">
            <label for="dataNascimento">Data de Nascimento <span class="text-danger">*</span></label>
            <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" required placeholder="Data de Nascimento">
        </div>
      
        <div class="form-group">
            <label for="escolaridade">Escolaridade <span class="text-danger">*</span></label>
            <select class="form-control" id="escolaridade" name="escolaridade" required>
                <option value="" disabled selected hidden>Selecione a Escolaridade</option>
                <option value="Ensino Fundamental">Ensino Fundamental</option>
                <option value="Ensino Médio Incompleto">Ensino Médio Incompleto</option>
                <option value="Ensino Médio Completo">Ensino Médio Completo</option>
                <option value="Superior Incompleto">Superior Incompleto</option>
                <option value="Superior Completo">Superior Completo</option>
                <option value="Mestrado">Mestrado</option>
                <option value="Doutorado">Doutorado</option>
            </select>
        </div>
      
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <script>
        function validarCPF(cpf) {
            cpf = cpf.replace(/\D/g, '');

            if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
                return false;
            }

            let soma = 0;
            for (let i = 0; i < 9; i++) {
                soma += parseInt(cpf.charAt(i)) * (10 - i);
            }
            let resto = 11 - (soma % 11);
            let dv1 = (resto >= 10) ? 0 : resto;

            soma = 0;
            for (let i = 0; i < 10; i++) {
                soma += parseInt(cpf.charAt(i)) * (11 - i);
            }
            resto = 11 - (soma % 11);
            let dv2 = (resto >= 10) ? 0 : resto;

            if (dv1 === parseInt(cpf.charAt(9)) && dv2 === parseInt(cpf.charAt(10))) {
                return true;
            }

            return false;
        }

        document.getElementById('formulario').addEventListener('submit', function (e) {
            e.preventDefault();
            const cpfInput = document.getElementById('cpf');
            const cpf = cpfInput.value;

            if (!validarCPF(cpf)) {
                // Exibe uma mensagem de erro para o usuário
                const errorElement = document.getElementById('cpfError');
                errorElement.textContent = 'CPF inválido. Por favor, insira um CPF válido.';
                errorElement.style.color = 'red';
                return;
            } else {
                // Limpa a mensagem de erro, caso o CPF seja válido
                const errorElement = document.getElementById('cpfError');
                errorElement.textContent = '';
            }
        });

        // Função para calcular a idade
        function calcularIdade(dataNascimento) {
            // Converte a data de nascimento em um objeto Date
            const dataNasc = new Date(dataNascimento);
            const hoje = new Date();

            // Calcula a diferença entre as datas em milissegundos
            const diffMilissegundos = hoje - dataNasc;

            // Converte a diferença de milissegundos para anos
            const idade = Math.floor(diffMilissegundos / 31536000000);

            return idade;
        }
    </script>

    <!-- Botões para acessar a planilha e visualizar gráficos -->
    <!-- Adicione o botão no seu arquivo HTML -->
    <button class="btn btn-success" id="btnPlanilha">Acessar Planilha</button>

    <!-- Adicione o script JavaScript abaixo ao final do seu arquivo HTML ou em um arquivo JavaScript separado -->
    <script>
        // Seleciona o botão pelo ID
        var btnPlanilha = document.getElementById('btnPlanilha');

        // Adiciona um evento de clique ao botão
        btnPlanilha.addEventListener('click', function () {
            // Redireciona o usuário para o arquivo gerar_planilha.php
            window.location.href = 'gerar_planilha.php';
        });
    </script>

    <button class="btn btn-info" id="btnGraficos">Visualizar Gráficos</button>

    <!-- Rodapé animado -->
    <footer>
        <img src="images/footer.png" alt="Footer Image">
    </footer>
</body>
</html>
