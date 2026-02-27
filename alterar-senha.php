<?php
session_start();
include 'dbcon.php';
require_once 'verificar_login.php';

$mensagem = '';
$erro = '';

// Buscar dados do usuário (só para mostrar nome)
$id = $_SESSION['usuario_id'];
$sql = "SELECT nome FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Processar alteração de senha
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senha_atual = $_POST['senha_atual'] ?? '';
    $nova_senha = $_POST['nova_senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';
    
    // Validações
    if (empty($senha_atual) || empty($nova_senha) || empty($confirmar_senha)) {
        $erro = "Todos os campos são obrigatórios!";
    } elseif ($nova_senha !== $confirmar_senha) {
        $erro = "A nova senha e a confirmação não coincidem!";
    } elseif (strlen($nova_senha) < 4) {
        $erro = "A nova senha deve ter pelo menos 4 caracteres!";
    } else {
        // Verificar se a senha atual está correta
        $check = $conn->prepare("SELECT id FROM usuarios WHERE id = ? AND senha = MD5(?)");
        $check->bind_param("is", $id, $senha_atual);
        $check->execute();
        $check->store_result();
        
        if ($check->num_rows === 0) {
            $erro = "Senha atual incorreta!";
        } else {
            // Atualizar para a nova senha
            $update = $conn->prepare("UPDATE usuarios SET senha = MD5(?) WHERE id = ?");
            $update->bind_param("si", $nova_senha, $id);
            
            if ($update->execute()) {
                $mensagem = "Senha alterada com sucesso!";
            } else {
                $erro = "Erro ao alterar senha. Tente novamente.";
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
    <title>Alterar Senha - DriveHub</title>
    
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
        
        .password-container {
            max-width: 500px;
            margin: 50px auto;
        }
        
        .password-card {
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
        
        .password-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .password-header h2 {
            color: #333;
            font-weight: 700;
            font-size: 28px;
        }
        
        .password-header h2 i {
            color: #667eea;
            margin-right: 10px;
        }
        
        .password-header p {
            color: #666;
            font-size: 14px;
            margin-top: 5px;
        }
        
        .user-info {
            background: #f0f4ff;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 25px;
            text-align: center;
            border-left: 4px solid #667eea;
        }
        
        .user-info i {
            color: #667eea;
            margin-right: 8px;
        }
        
        .user-info strong {
            color: #333;
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
        
        .requirements {
            font-size: 12px;
            color: #666;
            margin-top: -10px;
            margin-bottom: 15px;
            padding-left: 5px;
        }
        
        .requirements i {
            color: #667eea;
            margin-right: 5px;
        }
        
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        
        .button-group a {
            flex: 1;
        }
        
        .password-strength {
            height: 5px;
            background: #e0e0e0;
            border-radius: 5px;
            margin-top: -10px;
            margin-bottom: 15px;
            overflow: hidden;
        }
        
        .strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.3s;
        }
    </style>
</head>
<body>
    <div class="password-container">
        <div class="password-card">
            
            <!-- Header -->
            <div class="password-header">
                <h2>
                    <i class="fas fa-key"></i> Alterar Senha
                </h2>
                <p>Mantenha sua conta segura</p>
            </div>
            
            <!-- Informação do usuário -->
            <div class="user-info">
                <i class="fas fa-user-circle"></i>
                <strong><?php echo htmlspecialchars($user['nome']); ?></strong>
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
            
            <!-- Formulário de alteração de senha -->
            <form method="POST" id="formSenha">
                <div class="mb-3">
                    <label class="form-label">Senha atual</label>
                    <input type="password" name="senha_atual" class="form-control" 
                           placeholder="Digite sua senha atual" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Nova senha</label>
                    <input type="password" name="nova_senha" class="form-control" 
                           id="novaSenha" placeholder="Digite a nova senha" required>
                </div>
                
                <!-- Indicador de força da senha -->
                <div class="password-strength">
                    <div class="strength-bar" id="strengthBar"></div>
                </div>
                
                <div class="requirements">
                    <i class="fas fa-info-circle"></i> Mínimo de 4 caracteres
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Confirmar nova senha</label>
                    <input type="password" name="confirmar_senha" class="form-control" 
                           id="confirmarSenha" placeholder="Confirme a nova senha" required>
                </div>
                
                <!-- Indicador de confirmação -->
                <div id="matchIndicator" style="font-size: 12px; margin-bottom: 10px;"></div>
                
                <button type="submit" class="btn btn-primary" id="btnSubmit">
                    <i class="fas fa-save"></i> Alterar senha
                </button>
            </form>
            
            <!-- Botões de ação -->
            <div class="button-group">
                <a href="perfil.php" class="btn-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar ao perfil
                </a>
                <a href="index.php" class="btn-secondary">
                    <i class="fas fa-home"></i> Página inicial
                </a>
            </div>
        </div>
    </div>
    
    <script>
        // Verificar força da senha
        document.getElementById('novaSenha').addEventListener('input', function(e) {
            const senha = e.target.value;
            const bar = document.getElementById('strengthBar');
            let forca = 0;
            let cor = '#ff4444';
            
            if (senha.length >= 4) forca += 25;
            if (senha.length >= 6) forca += 25;
            if (/[A-Z]/.test(senha)) forca += 25;
            if (/[0-9]/.test(senha)) forca += 25;
            
            if (forca <= 25) cor = '#ff4444';
            else if (forca <= 50) cor = '#ffaa00';
            else if (forca <= 75) cor = '#00cc00';
            else cor = '#009900';
            
            bar.style.width = forca + '%';
            bar.style.backgroundColor = cor;
        });
        
        // Verificar se as senhas coincidem
        function verificarSenhas() {
            const nova = document.getElementById('novaSenha').value;
            const confirmar = document.getElementById('confirmarSenha').value;
            const indicator = document.getElementById('matchIndicator');
            const btn = document.getElementById('btnSubmit');
            
            if (confirmar.length > 0) {
                if (nova === confirmar) {
                    indicator.innerHTML = '✅ As senhas coincidem';
                    indicator.style.color = '#28a745';
                } else {
                    indicator.innerHTML = '❌ As senhas não coincidem';
                    indicator.style.color = '#dc3545';
                }
            } else {
                indicator.innerHTML = '';
            }
        }
        
        document.getElementById('novaSenha').addEventListener('keyup', verificarSenhas);
        document.getElementById('confirmarSenha').addEventListener('keyup', verificarSenhas);
    </script>
</body>
</html>