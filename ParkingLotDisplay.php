<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Display - Smart Parking</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .display-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .header-display {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            color: white;
        }
        
        .header-display h1 {
            font-size: 28px;
            font-weight: 600;
        }
        
        .header-display h1 i {
            margin-right: 10px;
        }
        
        .btn-voltar {
            background: rgba(255,255,255,0.2);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 18px;
            backdrop-filter: blur(10px);
            transition: all 0.3s;
        }
        
        .btn-voltar:hover {
            background: rgba(255,255,255,0.3);
            transform: translateX(-5px);
            color: white;
        }
        
        .stats-display {
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 30px;
            color: white;
            display: flex;
            justify-content: space-around;
            text-align: center;
        }
        
        .stat-item {
            flex: 1;
        }
        
        .stat-valor {
            font-size: 32px;
            font-weight: 700;
        }
        
        .stat-label {
            font-size: 14px;
            opacity: 0.8;
        }
        
        .vagas-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .vaga-display-card {
            background: white;
            border-radius: 20px;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            transition: all 0.3s;
            animation: fadeIn 0.5s;
        }
        
        .vaga-display-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }
        
        .vaga-display-card.livre {
            background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
        }
        
        .vaga-display-card.ocupada {
            background: linear-gradient(135deg, #fad0c4 0%, #ffd1ff 100%);
        }
        
        .vaga-numero-display {
            font-size: 36px;
            font-weight: 700;
            color: rgba(255,255,255,0.9);
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 15px;
        }
        
        .vaga-icone-display {
            font-size: 48px;
            color: white;
            margin-bottom: 15px;
            filter: drop-shadow(2px 4px 6px rgba(0,0,0,0.2));
        }
        
        .vaga-status-display {
            font-size: 20px;
            font-weight: 600;
            color: white;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }
        
        .timestamp-display {
            text-align: center;
            color: rgba(255,255,255,0.8);
            margin-top: 20px;
            font-size: 14px;
        }
        
        .loading-display {
            text-align: center;
            color: white;
            padding: 20px;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @media (max-width: 768px) {
            .vagas-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .vaga-numero-display {
                font-size: 28px;
            }
            
            .vaga-icone-display {
                font-size: 36px;
            }
        }
    </style>
</head>
<body>

<?php include 'dbcon.php'; 

// Buscar dados iniciais
$sql = "SELECT Position, Available FROM parkinglot ORDER BY Position";
$result = $conn->query($sql);

$stats_sql = "SELECT 
                SUM(CASE WHEN Available = 1 THEN 1 ELSE 0 END) as livres,
                SUM(CASE WHEN Available = 0 THEN 1 ELSE 0 END) as ocupadas,
                COUNT(*) as total
              FROM parkinglot";
$stats_result = $conn->query($stats_sql);
$stats = $stats_result->fetch_assoc();
?>

<div class="display-container">
    <!-- Header -->
    <div class="header-display">
        <a href="smtprk.php" class="btn-voltar">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1><i class="fas fa-parking"></i> Vagas</h1>
        <div style="width:40px;"></div>
    </div>
    
    <!-- Stats -->
    <div class="stats-display" id="stats-container">
        <div class="stat-item">
            <div class="stat-valor"><?php echo $stats['total']; ?></div>
            <div class="stat-label">Total</div>
        </div>
        <div class="stat-item">
            <div class="stat-valor" id="livres-count"><?php echo $stats['livres']; ?></div>
            <div class="stat-label">Livres</div>
        </div>
        <div class="stat-item">
            <div class="stat-valor" id="ocupadas-count"><?php echo $stats['ocupadas']; ?></div>
            <div class="stat-label">Ocupadas</div>
        </div>
    </div>
    
    <!-- Grid de Vagas -->
    <div class="vagas-grid" id="vagas-container">
        <?php while($row = $result->fetch_assoc()) { 
            $classe = $row['Available'] == 1 ? 'livre' : 'ocupada';
            $icone = $row['Available'] == 1 ? 'fa-car' : 'fa-car-side';
            $texto = $row['Available'] == 1 ? 'LIVRE' : 'OCUPADA';
        ?>
        <div class="vaga-display-card <?php echo $classe; ?>" data-vaga="<?php echo $row['Position']; ?>">
            <div class="vaga-numero-display"><?php echo $row['Position']; ?></div>
            <div class="vaga-icone-display">
                <i class="fas <?php echo $icone; ?>"></i>
            </div>
            <div class="vaga-status-display"><?php echo $texto; ?></div>
        </div>
        <?php } ?>
    </div>
    
    <!-- Timestamp -->
    <div class="timestamp-display">
        <i class="fas fa-clock"></i> Atualizado: <span id="timestamp"><?php echo date('H:i:s'); ?></span>
    </div>
</div>

<?php $conn->close(); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Função para atualizar o display
function atualizarDisplay() {
    fetch('getstatusjson.php')
        .then(response => response.json())
        .then(data => {
            console.log('📊 Display atualizado:', data);
            
            let cards = document.querySelectorAll('.vaga-display-card');
            let livres = 0;
            let ocupadas = 0;
            
            data.forEach((vaga, index) => {
                if (cards[index]) {
                    let status = vaga.Available;
                    
                    if (status == "1") {
                        livres++;
                        cards[index].className = 'vaga-display-card livre';
                        cards[index].querySelector('.vaga-status-display').innerHTML = 'LIVRE';
                        cards[index].querySelector('.vaga-icone-display i').className = 'fas fa-car';
                    } else {
                        ocupadas++;
                        cards[index].className = 'vaga-display-card ocupada';
                        cards[index].querySelector('.vaga-status-display').innerHTML = 'OCUPADA';
                        cards[index].querySelector('.vaga-icone-display i').className = 'fas fa-car-side';
                    }
                }
            });
            
            // Atualizar stats
            document.getElementById('livres-count').innerHTML = livres;
            document.getElementById('ocupadas-count').innerHTML = ocupadas;
            
            // Atualizar timestamp
            let agora = new Date();
            let timestamp = 
                agora.getHours().toString().padStart(2,'0') + ':' +
                agora.getMinutes().toString().padStart(2,'0') + ':' +
                agora.getSeconds().toString().padStart(2,'0');
            document.getElementById('timestamp').innerHTML = timestamp;
        })
        .catch(erro => {
            console.log('❌ Erro:', erro);
        });
}

// Remover qualquer meta refresh que exista
document.querySelector('meta[http-equiv="refresh"]')?.remove();

// Iniciar atualização a cada 3 segundos
setInterval(atualizarDisplay, 3000);

// Atualizar quando carregar
document.addEventListener('DOMContentLoaded', atualizarDisplay);

console.log('🚀 Display automático iniciado!');
</script>

</body>
</html>