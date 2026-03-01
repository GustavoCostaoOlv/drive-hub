<?php
session_start();  // ← PRIMEIRA LINHA DE CÓDIGO!
include 'dbcon.php';
require_once 'verificar_login.php';  // ← PROTEÇÃO
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>DriveHub</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        /* Navbar Moderna */
        .navbar-modern {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            padding: 15px 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 24px;
            color: #667eea !important;
        }
        
        .nav-link {
            font-weight: 500;
            color: #333 !important;
            margin: 0 10px;
            transition: all 0.3s;
        }
        
        .nav-link:hover {
            color: #667eea !important;
            transform: translateY(-2px);
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 80px 0;
            color: white;
            text-align: center;
            border-radius: 0 0 50px 50px;
            margin-bottom: 50px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .hero-title {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
            animation: fadeInDown 1s;
        }
        
        .hero-subtitle {
            font-size: 18px;
            opacity: 0.9;
            margin-bottom: 30px;
            animation: fadeInUp 1s;
        }
        
        /* Cards de Estatística */
        .stats-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s;
            margin-bottom: 30px;
            animation: fadeInUp 0.5s;
        }
        
        .stats-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }
        
        .stats-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
        
        .stats-number {
            font-size: 42px;
            font-weight: 700;
            color: #333;
        }
        
        .stats-label {
            font-size: 16px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        /* Cards das Vagas */
        .parking-grid {
            padding: 20px 0 50px;
        }
        
        .vaga-card {
            background: white;
            border-radius: 20px;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.5s;
            animation-fill-mode: both;
        }
        
        .vaga-card:nth-child(1) { animation-delay: 0.1s; }
        .vaga-card:nth-child(2) { animation-delay: 0.2s; }
        .vaga-card:nth-child(3) { animation-delay: 0.3s; }
        .vaga-card:nth-child(4) { animation-delay: 0.4s; }
        .vaga-card:nth-child(5) { animation-delay: 0.5s; }
        
        .vaga-card:hover {
            transform: translateY(-10px) scale(1.02);
        }
        
        .vaga-card.livre {
            background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
        }
        
        .vaga-card.ocupada {
            background: linear-gradient(135deg, #fad0c4 0%, #ffd1ff 100%);
        }
        
        .vaga-numero {
            font-size: 48px;
            font-weight: 700;
            color: rgba(255,255,255,0.9);
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 10px;
        }
        
        .vaga-status {
            font-size: 24px;
            font-weight: 600;
            color: white;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
            margin-bottom: 15px;
        }
        
        .vaga-icone {
            font-size: 64px;
            color: white;
            margin-bottom: 15px;
            filter: drop-shadow(2px 4px 6px rgba(0,0,0,0.2));
        }
        
        .vaga-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255,255,255,0.3);
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            color: white;
            backdrop-filter: blur(5px);
        }
        
        .feature-box {
            text-align: center;
            padding: 30px;
            border-radius: 20px;
            transition: all 0.3s;
        }
        
        .feature-box:hover {
            background: #f8f9fa;
            transform: translateY(-5px);
        }
        
        .feature-icon {
            font-size: 48px;
            color: #667eea;
            margin-bottom: 20px;
        }
        
        .feature-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }
        
        .feature-text {
            color: #666;
            line-height: 1.6;
        }
        
        /* Footer */
        .footer-modern {
            background: #2c3e50;
            color: white;
            padding: 30px 0;
            text-align: center;
        }
        
        /* Loading Overlay */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.9);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            backdrop-filter: blur(5px);
        }
        
        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Timestamp */
        .timestamp {
            text-align: center;
            color: rgba(255,255,255,0.8);
            margin: 20px 0;
            font-size: 14px;
        }
        
        .timestamp i {
            margin-right: 5px;
        }
        
        /* Responsividade */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 32px;
            }
            
            .vaga-numero {
                font-size: 36px;
            }
            
            .vaga-status {
                font-size: 20px;
            }
            
            .vaga-icone {
                font-size: 48px;
            }
        }

        /* Estilo para o tempo nas vagas */
/* Estilo para o tempo nas vagas - MAIS DESTACADO */
.vaga-tempo {
    background: rgba(0, 0, 0, 0.5);
    padding: 6px 12px;
    border-radius: 25px;
    font-size: 14px;
    margin-top: 8px;
    color: white;
    font-weight: 700;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    display: inline-block;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    border: 1px solid rgba(255,255,255,0.3);
    letter-spacing: 0.5px;
}

/* Efeito de brilho para tempo */
.vaga-card.ocupada .vaga-tempo {
    animation: brilhoSuave 2s infinite;
}

@keyframes brilhoSuave {
    0% { box-shadow: 0 0 5px rgba(255,255,255,0.3); }
    50% { box-shadow: 0 0 15px rgba(255,255,255,0.8); }
    100% { box-shadow: 0 0 5px rgba(255,255,255,0.3); }
}

/* Estilo para a placa - MAIS DESTACADA */
.vaga-placa {
    background: rgba(255, 215, 0, 0.25);
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 14px;
    margin-top: 6px;
    color: white;
    font-family: 'Courier New', monospace;
    font-weight: 700;
    letter-spacing: 2px;
    display: inline-block;
    border: 1px solid rgba(255, 215, 0, 0.5);
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    text-transform: uppercase;
}

/* Efeito de brilho dourado para placa */
.vaga-placa:hover {
    background: rgba(255, 215, 0, 0.4);
    transform: scale(1.05);
    transition: all 0.3s;
}

/* Quando a vaga está ocupada há muito tempo (mais de 1 hora) */
.vaga-card.ocupada.muito-tempo .vaga-tempo {
    background: rgba(255, 0, 0, 0.6);
    animation: pulseAlerta 1.5s infinite;
    font-weight: 800;
}

@keyframes pulseAlerta {
    0% { background: rgba(255, 0, 0, 0.6); }
    50% { background: rgba(255, 0, 0, 0.9); }
    100% { background: rgba(255, 0, 0, 0.6); }
}

/* Botão de reserva */
.btn-reservar {
    background: rgba(255,255,255,0.3);
    border: 2px solid white;
    color: white;
    padding: 8px 16px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 14px;
    margin-top: 10px;
    transition: all 0.3s;
    cursor: pointer;
    width: 100%;
    backdrop-filter: blur(5px);
}

.btn-reservar:hover {
    background: rgba(255,255,255,0.5);
    transform: scale(1.05);
}

/* Badge de reservado */
.reservado-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: rgba(255, 193, 7, 0.9);
    color: #000;
    padding: 4px 8px;
    border-radius: 15px;
    font-size: 10px;
    font-weight: bold;
    backdrop-filter: blur(5px);
}

/* Modal de reserva */
.reserva-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.7);
    z-index: 10000;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: white;
    padding: 30px;
    border-radius: 20px;
    max-width: 400px;
    width: 90%;
    animation: slideIn 0.3s;
}

.modal-content h3 {
    color: #333;
    margin-bottom: 20px;
}

.modal-content input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 2px solid #ddd;
    border-radius: 10px;
    font-size: 16px;
}

.modal-content input:focus {
    border-color: #667eea;
    outline: none;
}

.modal-buttons {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.btn-confirmar {
    background: #28a745;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 10px;
    font-weight: 600;
    flex: 1;
    cursor: pointer;
}

.btn-cancelar {
    background: #dc3545;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 10px;
    font-weight: 600;
    flex: 1;
    cursor: pointer;
}

@keyframes slideIn {
    from { transform: translateY(-50px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

/* Botão de liberar */
.btn-liberar {
    background: rgba(220, 53, 69, 0.8);
    border: 2px solid white;
    color: white;
    padding: 8px 16px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 14px;
    margin-top: 10px;
    transition: all 0.3s;
    cursor: pointer;
    width: 100%;
    backdrop-filter: blur(5px);
}

.btn-liberar:hover {
    background: rgba(220, 53, 69, 1);
    transform: scale(1.05);
}
    </style>
</head>
<body>

<!-- Loading Overlay -->
<div class="loading-overlay" id="loading">
    <div class="loading-spinner"></div>
</div>

<!-- Navbar Moderna -->
<nav class="navbar navbar-expand-lg navbar-modern fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fas fa-parking"></i>DriveHub
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="quem-somos.php"><i class="fas fa-users"></i> Quem Somos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#home"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ParkingLotDisplay.php"><i class="fas fa-table"></i> Display</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mapas-reais.php"><i class="fas fa-map-marked-alt"></i> Mapa</a>
                </li>
                
                <!-- ÍTENS DO USUÁRIO -->
                <?php if (isset($_SESSION['logado']) && $_SESSION['logado'] === true): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php">
                            <i class="fas fa-user-circle"></i> <?php echo $_SESSION['usuario_nome']; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link text-white-50">
                            <small><?php echo $_SESSION['usuario_email']; ?></small>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            <i class="fas fa-sign-out-alt"></i> Sair
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">
                            <i class="fas fa-sign-in-alt"></i> Entrar
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero-section" id="home">
    <div class="container">
        <h1 class="hero-title animate__animated animate__fadeInDown">
            <i class="fas fa-parking"></i> Estacionamento Inteligente
        </h1>
        <p class="hero-subtitle animate__animated animate__fadeInUp">
            Sistema IoT de monitoramento de vagas em tempo real com sensores ultrassônicos
        </p>
        <div class="animate__animated animate__fadeInUp">
            <a href="ParkingLotDisplay.php" class="btn btn-light btn-lg me-3">
                <i class="fas fa-eye"></i> Ver Vagas
            </a>
        </div>
    </div>
</section>

<div class="container">
    <!-- Cards de Estatística -->
    <?php 
    $sql_stats = "SELECT 
                    SUM(CASE WHEN Available = 1 THEN 1 ELSE 0 END) as livres,
                    SUM(CASE WHEN Available = 0 THEN 1 ELSE 0 END) as ocupadas,
                    COUNT(*) as total
                  FROM parkinglot";
    $stats_result = $conn->query($sql_stats);
    $stats = $stats_result->fetch_assoc();
    ?>
    
    <div class="row">
        <div class="col-md-4">
            <div class="stats-card animate__animated animate__fadeInUp">
                <div class="stats-icon">
                    <i class="fas fa-parking text-primary"></i>
                </div>
                <div class="stats-number"><?php echo $stats['total']; ?></div>
                <div class="stats-label">Total de Vagas</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                <div class="stats-icon">
                    <i class="fas fa-check-circle text-success"></i>
                </div>
                <div class="stats-number" id="livres-count"><?php echo $stats['livres']; ?></div>
                <div class="stats-label">Vagas Livres</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                <div class="stats-icon">
                    <i class="fas fa-times-circle text-danger"></i>
                </div>
                <div class="stats-number" id="ocupadas-count"><?php echo $stats['ocupadas']; ?></div>
                <div class="stats-label">Vagas Ocupadas</div>
            </div>
        </div>
    </div>
    
    <!-- Grid de Vagas -->
    <div class="parking-grid">
        <h2 class="text-center text-white mb-5 animate__animated animate__fadeInUp">
            <i class="fas fa-car"></i> Status das Vagas
        </h2>
        
        <div class="row" id="vagas-container">
            <?php 
            $sql = "SELECT Position, Available FROM parkinglot ORDER BY Position";
            $result = $conn->query($sql);
            
            if($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) { 
                $classe = $row['Available'] == 1 ? 'livre' : 'ocupada';
                $icone = $row['Available'] == 1 ? 'fa-car' : 'fa-car-side';
                $texto = $row['Available'] == 1 ? 'LIVRE' : 'OCUPADA';
            ?>
            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="vaga-card <?php echo $classe; ?>" data-vaga="<?php echo $row['Position']; ?>">
                    <div class="vaga-numero"><?php echo $row['Position']; ?></div>
                    <div class="vaga-icone">
                        <i class="fas <?php echo $icone; ?>"></i>
                    </div>
                    <div class="vaga-status"><?php echo $texto; ?></div>
                </div>
            </div>
            <?php } 
            } else { 
                echo '<p style="color: white; text-align: center;">Erro ao carregar vagas</p>';
            }
            ?>
        </div>
    </div>

<?php $conn->close(); ?>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// FUNÇÃO PARA FORMATAR TEMPO
function formatarTempo(segundos) {
    if (segundos < 60) return `${segundos}s`;
    if (segundos < 3600) {
        let min = Math.floor(segundos / 60);
        return `${min}min`;
    }
    let horas = Math.floor(segundos / 3600);
    let min = Math.floor((segundos % 3600) / 60);
    return `${horas}h ${min}min`;
}

// ATUALIZAR TEMPOS DAS VAGAS
function atualizarTempos() {
    console.log('⏰ Atualizando tempos...');
    
    // Primeiro, garantir que o servidor está com dados atualizados
    fetch('incrementar_tempo.php')
        .then(() => {
            // Depois, buscar os tempos atualizados
            return fetch('get_tempos.php');
        })
        .then(response => response.json())
        .then(vagas => {
            console.log('📊 Dados de tempo:', vagas);
            
            vagas.forEach(vaga => {
                let card = document.querySelector(`.vaga-card[data-vaga="${vaga.position}"]`);
                if (!card) return;
                
                // Remover elementos antigos
                let tempoEl = card.querySelector('.vaga-tempo');
                let placaEl = card.querySelector('.vaga-placa');
                if (tempoEl) tempoEl.remove();
                if (placaEl) placaEl.remove();
                
                // Se estiver ocupada, adicionar tempo e placa
                if (vaga.available == 0) {
                    // Adicionar tempo
                    tempoEl = document.createElement('div');
                    tempoEl.className = 'vaga-tempo';
                    tempoEl.innerHTML = `⏱️ ${vaga.tempo || '0min'}`;
                    card.querySelector('.vaga-icone').after(tempoEl);
                    
                    // Adicionar placa se existir
                    if (vaga.placa) {
                        placaEl = document.createElement('div');
                        placaEl.className = 'vaga-placa';
                        placaEl.innerHTML = `🚗 ${vaga.placa}`;
                        tempoEl.after(placaEl);
                    }
                }
            });
        })
        .catch(error => console.error('Erro tempos:', error));
}

// INICIAR SISTEMA
setInterval(atualizarVagas, 3000);      // Atualizar status a cada 3 segundos
setInterval(atualizarTempos, 10000);    // Atualizar tempos a cada 10 segundos

// Primeira execução
document.addEventListener('DOMContentLoaded', () => {
    console.log('🚀 Sistema iniciado');
    atualizarVagas();
});

// Variável para controlar o modal
let vagaSelecionada = null;

// Abrir modal de reserva
function reservarVaga(vaga) {
    vagaSelecionada = vaga;
    document.getElementById('modalVaga').value = vaga;
    document.getElementById('reservaModal').style.display = 'flex';
}

// Fechar modal
function fecharModal() {
    document.getElementById('reservaModal').style.display = 'none';
    document.getElementById('modalPlaca').value = '';
    document.getElementById('modalNome').value = '';
    document.getElementById('modalTelefone').value = '';
}

// Confirmar reserva
function confirmarReserva() {
    const vaga = document.getElementById('modalVaga').value;
    const placa = document.getElementById('modalPlaca').value.toUpperCase();
    const nome = document.getElementById('modalNome').value;
    const telefone = document.getElementById('modalTelefone').value;
    
    if (!placa || !nome || !telefone) {
        alert('❌ Preencha todos os campos!');
        return;
    }
    
    // Aceita formatos: ABC-1234, ABC1234, ABC1D23, ABC-1D23
if (!placa || !placa.match(/[A-Z]{3}[-]?[0-9][A-Z0-9][0-9]{2}/)) {
    alert('❌ Placa inválida! Use formatos como: ABC-1234 ou ABC1D23');
    return;
}
    
    // Enviar para o servidor
    fetch('reservar_vaga.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
            vaga: vaga,
            placa: placa,
            nome: nome,
            telefone: telefone
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(`✅ Vaga ${vaga} reservada com sucesso!`);
            fecharModal();
            atualizarVagas(); // Atualizar a página
        } else {
            alert('❌ Erro ao reservar: ' + data.error);
        }
    })
    .catch(error => {
        alert('❌ Erro: ' + error);
    });
}

// Modificar a função atualizarVagas para adicionar botão de reserva
// ATUALIZAR VAGAS (PRINCIPAL)
function atualizarVagas() {
    console.log('🔄 Atualizando vagas...');
    
    fetch('getstatusjson.php')
        .then(response => response.json())
        .then(data => {
            let livres = 0;
            let ocupadas = 0;
            let cards = document.querySelectorAll('.vaga-card');
            
            data.forEach((vaga, index) => {
                if (cards[index]) {
                    let status = vaga.Available;
                    let card = cards[index];
                    
                    // Limpar botões antigos
                    let oldBtn = card.querySelector('.btn-reservar');
                    let oldLiberar = card.querySelector('.btn-liberar');
                    if (oldBtn) oldBtn.remove();
                    if (oldLiberar) oldLiberar.remove();
                    
                    if (status == "1") {
                        livres++;
                        card.className = 'vaga-card livre';
                        card.querySelector('.vaga-status').innerHTML = 'LIVRE';
                        card.querySelector('.vaga-icone i').className = 'fas fa-car';
                        
                        // Botão RESERVAR
                        let btn = document.createElement('button');
                        btn.className = 'btn-reservar';
                        btn.innerHTML = '📝 Reservar Vaga';
                        btn.onclick = () => reservarVaga(vaga.Position);
                        card.appendChild(btn);
                        
                    } else {
                        ocupadas++;
                        card.className = 'vaga-card ocupada';
                        card.querySelector('.vaga-status').innerHTML = 'OCUPADA';
                        card.querySelector('.vaga-icone i').className = 'fas fa-car-side';
                        
                        // Botão LIBERAR
                        let btn = document.createElement('button');
                        btn.className = 'btn-liberar';
                        btn.innerHTML = '✅ Liberar Vaga';
                        btn.onclick = () => liberarVaga(vaga.Position);
                        card.appendChild(btn);
                    }
                }
            });
            
            document.getElementById('livres-count').innerHTML = livres;
            document.getElementById('ocupadas-count').innerHTML = ocupadas;
            
            let agora = new Date();
            let timestamp = 
                agora.getHours().toString().padStart(2,'0') + ':' +
                agora.getMinutes().toString().padStart(2,'0') + ':' +
                agora.getSeconds().toString().padStart(2,'0');
            document.getElementById('timestamp').innerHTML = timestamp;
            
            console.log(`✅ Atualizado: ${livres} livres, ${ocupadas} ocupadas`);
            atualizarTempos();
        })
        .catch(erro => console.log('❌ Erro:', erro));
}

// FUNÇÃO PARA LIBERAR VAGA
function liberarVaga(vaga) {
    if (confirm(`Tem certeza que deseja liberar a Vaga ${vaga}?`)) {
        fetch('liberar_vaga.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({vaga: vaga})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`✅ Vaga ${vaga} liberada!`);
                atualizarVagas();
            } else {
                alert('❌ Erro ao liberar vaga');
            }
        })
        .catch(error => {
            alert('❌ Erro: ' + error);
        });
    }
}
</script>

<!-- Modal de Reserva -->
<div class="reserva-modal" id="reservaModal">
    <div class="modal-content">
        <h3><i class="fas fa-parking"></i> Reservar Vaga</h3>
        <input type="text" id="modalPlaca" placeholder="Placa do Veículo" 
       style="text-transform:uppercase" required>
        <input type="text" id="modalNome" placeholder="Nome do Motorista">
        <input type="text" id="modalTelefone" placeholder="Telefone para contato">
        <input type="hidden" id="modalVaga">
        
        <div class="modal-buttons">
            <button class="btn-confirmar" onclick="confirmarReserva()">✓ Confirmar</button>
            <button class="btn-cancelar" onclick="fecharModal()">✗ Cancelar</button>
        </div>
    </div>
</div>
</body>
</html>