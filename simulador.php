<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Simulador - Smart Parking</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
        }
        
        body {
            background: #f8f9fc;
            min-height: 100vh;
            padding: 16px;
        }
        
        .app-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        
        .app-header h1 {
            font-size: 24px;
            font-weight: 600;
            color: #1e293b;
        }
        
        .app-header h1 i {
            color: #4361ee;
            margin-right: 8px;
        }
        
        .btn-back {
            background: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            color: #4361ee;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        
        .stats-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-around;
            text-align: center;
        }
        
        .stat-item {
            flex: 1;
        }
        
        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
        }
        
        .stat-label {
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .vagas-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }
        
        .vaga-card {
            background: white;
            border-radius: 20px;
            padding: 20px 12px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: all 0.2s;
        }
        
        .vaga-card.livre { background: #e8f5e9; }
        .vaga-card.ocupada { background: #ffebee; }
        
        .vaga-numero {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
        }
        
        .vaga-status {
            font-size: 20px;
            font-weight: 700;
            margin: 8px 0;
        }
        
        .vaga-status.livre { color: #2e7d32; }
        .vaga-status.ocupada { color: #c62828; }
        
        .vaga-icone {
            font-size: 32px;
            margin: 8px 0;
        }
        
        .btn-controle {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }
        
        .btn-livre, .btn-ocupada {
            flex: 1;
            border: none;
            padding: 10px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
        }
        
        .btn-livre {
            background: #2e7d32;
            color: white;
        }
        
        .btn-ocupada {
            background: #c62828;
            color: white;
        }
        
        .btn-livre:hover, .btn-ocupada:hover {
            transform: scale(0.95);
            opacity: 0.9;
        }
        
        .btn-acao {
            background: #4361ee;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 14px;
            font-weight: 600;
            width: 100%;
            margin: 8px 0;
            transition: all 0.2s;
        }
        
        .btn-acao:hover {
            background: #3046c0;
            transform: scale(0.98);
        }
        
        .btn-acao.secondary {
            background: white;
            color: #4361ee;
            border: 1px solid #4361ee;
        }
        
        .log-area {
            background: #1e293b;
            color: #e2e8f0;
            border-radius: 16px;
            padding: 16px;
            margin-top: 20px;
            max-height: 200px;
            overflow-y: auto;
            font-size: 12px;
        }
        
        .log-item {
            padding: 6px 0;
            border-bottom: 1px solid #334155;
            animation: fadeIn 0.3s;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<?php include 'dbcon.php'; ?>

<!-- Header -->
<div class="app-header">
    <a href="smtprk.php" class="btn-back">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h1><i class="fas fa-gamepad"></i> Simulador</h1>
    <div style="width: 40px;"></div>
</div>

<?php
// BUSCAR NÚMERO REAL DE VAGAS DO BANCO
$sql_count = "SELECT COUNT(*) as total FROM parkinglot";
$result_count = $conn->query($sql_count);
$total_vagas = $result_count->fetch_assoc()['total'];

// BUSCAR STATUS DE CADA VAGA
$sql = "SELECT Position, Available FROM parkinglot ORDER BY Position";
$result = $conn->query($sql);

// CRIAR ARRAY COM STATUS
$status_vagas = [];
while($row = $result->fetch_assoc()) {
    $status_vagas[$row['Position']] = $row['Available'];
}
?>

<!-- Stats Card -->
<div class="stats-card">
    <div class="stat-item">
        <div class="stat-value"><?php echo $total_vagas; ?></div>
        <div class="stat-label">Total</div>
    </div>
    <div class="stat-item">
        <div class="stat-value" id="livres-count">0</div>
        <div class="stat-label">Livres</div>
    </div>
    <div class="stat-item">
        <div class="stat-value" id="ocupadas-count">0</div>
        <div class="stat-label">Ocupadas</div>
    </div>
</div>

<!-- Grid de Vagas -->
<div class="vagas-grid" id="vagas-container">
    <?php 
    foreach($status_vagas as $posicao => $status) { 
        $classe = $status ? 'livre' : 'ocupada';
        $icone = $status ? 'fa-car' : 'fa-car-side';
        $texto = $status ? 'LIVRE' : 'OCUPADA';
    ?>
    <div class="vaga-card <?php echo $classe; ?>" data-vaga="<?php echo $posicao; ?>">
        <div class="vaga-numero">VAGA <?php echo $posicao; ?></div>
        <div class="vaga-icone">
            <i class="fas <?php echo $icone; ?>"></i>
        </div>
        <div class="vaga-status <?php echo $classe; ?>"><?php echo $texto; ?></div>
        
        <div class="btn-controle">
            <button class="btn-livre" onclick="enviarDado(<?php echo $posicao; ?>, 1)">
                <i class="fas fa-check"></i> Livre
            </button>
            <button class="btn-ocupada" onclick="enviarDado(<?php echo $posicao; ?>, 0)">
                <i class="fas fa-times"></i> Ocupada
            </button>
        </div>
    </div>
    <?php } ?>
</div>

<!-- Botões de Ação -->
<button class="btn-acao" onclick="testarTodasVagas()">
    <i class="fas fa-random"></i> Testar Todas Vagas
</button>

<button class="btn-acao secondary" onclick="limparLog()">
    <i class="fas fa-trash"></i> Limpar Log
</button>

<!-- Log Area -->
<div class="log-area" id="log">
    <div style="margin-bottom: 8px;">
        <i class="fas fa-history"></i> Log de Eventos
    </div>
    <div id="mensagens"></div>
</div>

<?php $conn->close(); ?>

<script>
const BASE_PATH = '/index/Smart-Parking-System-master/';

function enviarDado(vaga, status) {
    // Atualizar interface
    let card = document.querySelector(`[data-vaga="${vaga}"]`);
    if (card) {
        card.className = `vaga-card ${status ? 'livre' : 'ocupada'}`;
        card.querySelector('.vaga-status').innerHTML = status ? 'LIVRE' : 'OCUPADA';
        card.querySelector('.vaga-status').className = `vaga-status ${status ? 'livre' : 'ocupada'}`;
        card.querySelector('.vaga-icone i').className = `fas ${status ? 'fa-car' : 'fa-car-side'}`;
    }
    
    let url = BASE_PATH + `UpdateAvailability.php?Position=${vaga}&Available=${status}`;
    
    adicionarLog(`📤 Enviando: Vaga ${vaga} = ${status ? 'LIVRE' : 'OCUPADA'}...`, 'info');
    
    fetch(url)
        .then(response => response.text())
        .then(data => {
            adicionarLog(`✅ Vaga ${vaga} alterada`, 'success');
            atualizarContadores();
        })
        .catch(error => {
            adicionarLog(`❌ Erro: ${error}`, 'danger');
        });
}

function atualizarContadores() {
    let cards = document.querySelectorAll('.vaga-card');
    let livres = 0;
    let ocupadas = 0;
    
    cards.forEach(card => {
        if (card.classList.contains('livre')) livres++;
        else ocupadas++;
    });
    
    document.getElementById('livres-count').innerHTML = livres;
    document.getElementById('ocupadas-count').innerHTML = ocupadas;
}

function adicionarLog(mensagem, tipo) {
    let log = document.getElementById('mensagens');
    let hora = new Date().toLocaleTimeString();
    let icone = tipo == 'success' ? '✅' : (tipo == 'danger' ? '❌' : '📌');
    
    log.innerHTML = `<div class="log-item">${icone} [${hora}] ${mensagem}</div>` + log.innerHTML;
}

function testarTodasVagas() {
    adicionarLog('🔄 Testando todas as vagas...', 'info');
    
    let vagas = document.querySelectorAll('.vaga-card');
    vagas.forEach((vaga, index) => {
        let posicao = vaga.dataset.vaga;
        let status = Math.random() > 0.5 ? 1 : 0;
        
        setTimeout(() => {
            enviarDado(posicao, status);
        }, (index + 1) * 500);
    });
}

function limparLog() {
    document.getElementById('mensagens').innerHTML = '';
    adicionarLog('📋 Log limpo', 'info');
}

// Inicializar contadores
window.onload = function() {
    atualizarContadores();
    adicionarLog('🚀 Simulador pronto', 'info');
};
</script>
</body>
</html>