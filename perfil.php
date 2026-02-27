<?php
session_start();
include 'dbcon.php';
require_once 'verificar_login.php';

$mensagem = '';
$erro = '';

// Buscar dados atuais do usuário
$id = $_SESSION['usuario_id'];
$sql = "SELECT nome, email FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Processar atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novo_nome = $_POST['nome'] ?? '';
    $novo_email = $_POST['email'] ?? '';
    
    if (empty($novo_nome) || empty($novo_email)) {
        $erro = "Todos os campos são obrigatórios!";
    } elseif (!filter_var($novo_email, FILTER_VALIDATE_EMAIL)) {
        $erro = "E-mail inválido!";
    } else {
        // Verificar se o email já existe para outro usuário
        $check = $conn->prepare("SELECT id FROM usuarios WHERE email = ? AND id != ?");
        $check->bind_param("si", $novo_email, $id);
        $check->execute();
        $check->store_result();
        
        if ($check->num_rows > 0) {
            $erro = "Este e-mail já está sendo usado por outro usuário!";
        } else {
            // Atualizar dados
            $update = $conn->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
            $update->bind_param("ssi", $novo_nome, $novo_email, $id);
            
            if ($update->execute()) {
                // Atualizar a sessão
                $_SESSION['usuario_nome'] = $novo_nome;
                $_SESSION['usuario_email'] = $novo_email;
                $mensagem = "Dados atualizados com sucesso!";
                
                // Recarregar dados
                $user['nome'] = $novo_nome;
                $user['email'] = $novo_email;
            } else {
                $erro = "Erro ao atualizar. Tente novamente.";
            }
            $update->close();
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
    <title>Meu Perfil - DriveHub</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .profile-container {
            max-width: 600px;
            margin: 50px auto;
        }
        
        .profile-card {
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
        
        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .profile-header h2 {
            color: #333;
            font-weight: 700;
            font-size: 28px;
        }
        
        .profile-header h2 i {
            color: #667eea;
            margin-right: 10px;
        }
        
        .profile-header p {
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
        
        .btn-secondary {
            background: #6c757d;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
            margin-top: 10px;
            color: white;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
            color: white;
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
        
        .info-box {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
        }
        
        .info-box p {
            margin: 5px 0;
            color: #333;
        }
        
        .info-box i {
            color: #667eea;
            width: 25px;
        }
        
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        
        .button-group a {
            flex: 1;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-card">
            
            <!-- Header -->
            <div class="profile-header">
                <h2>
                    <i class="fas fa-user-circle"></i> Meu Perfil
                </h2>
                <p>Edite suas informações pessoais</p>
            </div>
            
            <!-- Informações atuais -->
            <div class="info-box">
                <p><i class="fas fa-user"></i> <strong>Nome atual:</strong> <?php echo htmlspecialchars($user['nome']); ?></p>
                <p><i class="fas fa-envelope"></i> <strong>Email atual:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            </div>
            
            <!-- Mensagens -->
            <?php if ($mensagem): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <?php echo $mensagem; ?>
                </div>
            <?php endif; ?>
            
            <?php if ($erro): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $erro; ?>
                </div>
            <?php endif; ?>
            
            <!-- Formulário de edição -->
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nome completo</label>
                    <input type="text" name="nome" class="form-control" 
                           value="<?php echo htmlspecialchars($user['nome']); ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" 
                           value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Salvar alterações
                </button>
            </form>
            
            <!-- Botões de ação -->
            <div class="button-group">
                <a href="index.php" class="btn-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
                <a href="alterar-senha.php" class="btn-secondary">
                    <i class="fas fa-key"></i> Alterar senha
                </a>
            </div>
        </div>
    </div>
</body>
</html>