<?php
session_start();
include 'dbcon.php';

// Se já estiver logado, vai para o sistema
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    header('Location: index.php');
    exit;
}

$erro = '';
$sucesso = '';

// Processar cadastro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';
    
    // Validações
    if (empty($nome) || empty($email) || empty($senha)) {
        $erro = "Todos os campos são obrigatórios!";
    } elseif ($senha !== $confirmar_senha) {
        $erro = "As senhas não coincidem!";
    } elseif (strlen($senha) < 4) {
        $erro = "A senha deve ter pelo menos 4 caracteres!";
    } else {
        // Verificar se email já existe
        $check = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();
        
        if ($check->num_rows > 0) {
            $erro = "Este e-mail já está cadastrado!";
        } else {
            // Inserir novo usuário
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, MD5(?))";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $nome, $email, $senha);
            
            if ($stmt->execute()) {
                $sucesso = "Cadastro realizado com sucesso! Faça o login.";
            } else {
                $erro = "Erro ao cadastrar. Tente novamente.";
            }
            $stmt->close();
        }
        $check->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - DriveHub</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }
        
        .register-container {
            width: 100%;
            max-width: 500px;
        }
        
        .register-card {
            background: white;
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
            animation: fadeIn 0.5s;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .register-header h2 {
            color: #333;
            font-weight: 700;
            font-size: 28px;
        }
        
        .register-header h2 i {
            color: #667eea;
            margin-right: 10px;
        }
        
        .register-header p {
            color: #666;
            font-size: 14px;
            margin-top: 5px;
        }
        
        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            margin-bottom: 15px;
            font-size: 15px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
            margin-top: 10px;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .alert {
            border-radius: 12px;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: none;
            animation: slideIn 0.3s;
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-10px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
        }
        
        .alert-danger {
            background: #f8d7da;
            color: #721c24;
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
        
        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        .password-requirements {
            font-size: 12px;
            color: #666;
            margin-top: -10px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            
            <!-- Header -->
            <div class="register-header">
                <h2>
                    <i class="fas fa-user-plus"></i> Criar Conta
                </h2>
                <p>Cadastre-se para acessar o estacionamento</p>
            </div>
            
            <!-- Mensagens -->
            <?php if ($erro): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $erro; ?>
                </div>
            <?php endif; ?>
            
            <?php if ($sucesso): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <?php echo $sucesso; ?>
                </div>
            <?php endif; ?>
            
            <!-- Formulário de Cadastro -->
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nome completo</label>
                    <input type="text" name="nome" class="form-control" 
                           placeholder="Digite seu nome" required 
                           value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : ''; ?>">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" 
                           placeholder="seu@email.com" required
                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-control" 
                           placeholder="******" required>
                </div>
                
                <div class="password-requirements">
                    <i class="fas fa-info-circle"></i> Mínimo de 4 caracteres
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Confirmar senha</label>
                    <input type="password" name="confirmar_senha" class="form-control" 
                           placeholder="******" required>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-user-check"></i> Cadastrar
                </button>
            </form>
            
            <!-- Link para login -->
            <div class="login-link">
                Já tem uma conta? <a href="login.php">Faça o login</a>
            </div>
        </div>
    </div>
</body>
</html>