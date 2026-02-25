<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Mapa do Estacionamento</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            min-height: 100vh;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .mapa-container {
            background: #2c3e50;
            border-radius: 30px;
            padding: 40px 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .parking-title {
            text-align: center;
            color: white;
            margin-bottom: 30px;
        }
        
        .parking-title h2 {
            font-size: 32px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .parking-title h2 i {
            color: #f1c40f;
            margin: 0 10px;
        }
        
        .parking-area {
            background: #34495e;
            border-radius: 20px;
            padding: 30px;
            border: 3px solid #f1c40f;
            position: relative;
        }
        
        .entrada-saida {
            background: #f1c40f;
            color: #2c3e50;
            padding: 10px 20px;
            border-radius: 10px;
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            z-index: 10;
        }
        
        .corredor {
            background: #7f8c8d;
            height: 60px;
            margin: 20px 0;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            box-shadow: inset 0 2px 5px rgba(0,0,0,0.2);
        }
        
        .fileira {
            display: flex;
            justify-content: space-around;
            margin: 30px 0;
            position: relative;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .vaga-mapa {
            width: 120px;
            height: 160px;
            background: #ecf0f1;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
            transition: all 0.3s;
            border: 3px solid #bdc3c7;
            cursor: pointer;
        }
        
        .vaga-mapa:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        }
        
        .vaga-mapa.livre {
            background: #2ecc71;
            border-color: #27ae60;
        }
        
        .vaga-mapa.ocupada {
            background: #e74c3c;
            border-color: #c0392b;
        }
        
        .vaga-mapa.inexistente {
            background: #95a5a6;
            border-color: #7f8c8d;
            opacity: 0.5;
        }
        
        .vaga-numero {
            font-size: 32px;
            font-weight: 700;
            color: white;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }
        
        .vaga-icone {
            font-size: 40px;
            color: white;
            margin: 10px 0;
        }
        
        .vaga-status {
            font-size: 14px;
            font-weight: 600;
            color: white;
            background: rgba(0,0,0,0.2);
            padding: 4px 12px;
            border-radius: 20px;
        }
        
        .legenda {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 30px;
            padding: 20px;
            background: #34495e;
            border-radius: 15px;
            flex-wrap: wrap;
        }
        
        .legenda-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
        }
        
        .legenda-cor {
            width: 30px;
            height: 30px;
            border-radius: 8px;
        }
        
        .legenda-cor.livre { background: #2ecc71; }
        .legenda-cor.ocupada { background: #e74c3c; }
        .legenda-cor.inexistente { background: #95a5a6; }
        
        .stats-overlay {
            background: rgba(0,0,0,0.2);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        
        .stats-grid {
            display: flex;
            justify-content: space-around;
            color: white;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .stats-item {
            text-align: center;
            min-width: 100px;
        }
        
        .stats-valor {
            font-size: 36px;
            font-weight: 700;
        }
        
        .timestamp {
            text-align: center;
            color: white;
            margin-top: 20px;
            opacity: 0.8;
        }
        
        .mensagem-erro {
            background: #e74c3c;
            color: white;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            margin: 10px 0;
        }
        
        @media (max-width: 768px) {
            .fileira {
                justify-content: center;
            }
            
            .vaga-mapa {
                width: 100%;
                max-width: 200px;
            }
        }
    </style>
</head>
<body>

<?php include 'dbcon.php'; ?>

<div class="container">
    <div class="mapa-container">
        
        <div class="parking-title">
            <h2>
                <i class="fas fa-parking"></i>
                DRIVE HUB - MAPA DO ESTACIONAMENTO
                <i class="fas fa-parking"></i>
            </h2>
        </div>
        
        <?php
        // Verificar quantas vagas existem no banco
        $sql_check = "SELECT COUNT(*) as total FROM parkinglot";
        $check_result = $conn->query($sql_check);
        $total_existente = $check_result->fetch_assoc()['total'];
        
        if ($total_existente < 5) {
            echo "<div class='mensagem-erro'>";
            echo "<i class='fas fa-exclamation-triangle'></i> ";
            echo "Atenção: Existem apenas $total_existente vaga(s) no banco. ";
            echo "O mapa mostra 5 vagas, mas algumas podem aparecer em cinza.";
            echo "</div>";
        }
        
        // Buscar TODAS as vagas existentes
        $sql_vagas = "SELECT Position, Available FROM parkinglot ORDER BY Position";
        $result_vagas = $conn->query($sql_vagas);
        
        // Criar array com status das vagas
        $status_vagas = [];
        while($row = $result_vagas->fetch_assoc()) {
            $status_vagas[$row['Position']] = $row['Available'];
        }
        
        // Calcular estatísticas
        $livres = 0;
        $ocupadas = 0;
        foreach($status_vagas as $status) {
            if ($status == 1) $livres++;
            else $ocupadas++;
        }
        $total = count($status_vagas);
        ?>
        
        <div class="stats-overlay">
            <div class="stats-grid">
                <div class="stats-item">
                    <div class="stats-valor"><?php echo $total; ?></div>
                    <div class="stats-label">Total no Banco</div>
                </div>
                <div class="stats-item">
                    <div class="stats-valor" id="livres-count"><?php echo $livres; ?></div>
                    <div class="stats-label">Vagas Livres</div>
                </div>
                <div class="stats-item">
                    <div class="stats-valor" id="ocupadas-count"><?php echo $ocupadas; ?></div>
                    <div class="stats-label">Vagas Ocupadas</div>
                </div>
            </div>
        </div>
        
        <div class="parking-area">
            
            <div class="entrada-saida">
                <i class="fas fa-arrow-left"></i>
                ENTRADA / SAÍDA
                <i class="fas fa-arrow-right"></i>
            </div>
            
            <div class="corredor">
                <i class="fas fa-road"></i>
                CORREDOR PRINCIPAL
                <i class="fas fa-road"></i>
            </div>
            
            <!-- FILEIRA 1 (Vagas 1-3) -->
            <div class="fileira">
                <?php 
                for($vaga_num = 1; $vaga_num <= 3; $vaga_num++): 
                    if (isset($status_vagas[$vaga_num])) {
                        $status = $status_vagas[$vaga_num];
                        $classe = $status ? 'livre' : 'ocupada';
                        $icone = $status ? 'fa-car' : 'fa-car-side';
                        $texto = $status ? 'LIVRE' : 'OCUPADA';
                    } else {
                        $classe = 'inexistente';
                        $icone = 'fa-question-circle';
                        $texto = 'NÃO EXISTE';
                    }
                ?>
                <div class="vaga-mapa <?php echo $classe; ?>" data-vaga="<?php echo $vaga_num; ?>">
                    <div class="vaga-numero"><?php echo $vaga_num; ?></div>
                    <div class="vaga-icone">
                        <i class="fas <?php echo $icone; ?>"></i>
                    </div>
                    <div class="vaga-status"><?php echo $texto; ?></div>
                </div>
                <?php endfor; ?>
            </div>
            
            <div class="corredor">
                <i class="fas fa-arrows-alt-h"></i>
                CORREDOR CENTRAL
                <i class="fas fa-arrows-alt-h"></i>
            </div>
            
            <!-- FILEIRA 2 (Vagas 4-5) -->
            <div class="fileira">
                <?php 
                for($vaga_num = 4; $vaga_num <= 5; $vaga_num++): 
                    if (isset($status_vagas[$vaga_num])) {
                        $status = $status_vagas[$vaga_num];
                        $classe = $status ? 'livre' : 'ocupada';
                        $icone = $status ? 'fa-car' : 'fa-car-side';
                        $texto = $status ? 'LIVRE' : 'OCUPADA';
                    } else {
                        $classe = 'inexistente';
                        $icone = 'fa-question-circle';
                        $texto = 'NÃO EXISTE';
                    }
                ?>
                <div class="vaga-mapa <?php echo $classe; ?>" data-vaga="<?php echo $vaga_num; ?>">
                    <div class="vaga-numero"><?php echo $vaga_num; ?></div>
                    <div class="vaga-icone">
                        <i class="fas <?php echo $icone; ?>"></i>
                    </div>
                    <div class="vaga-status"><?php echo $texto; ?></div>
                </div>
                <?php endfor; ?>
            </div>
        </div>
        
        <div class="legenda">
            <div class="legenda-item">
                <div class="legenda-cor livre"></div>
                <span>Vaga Livre</span>
            </div>
            <div class="legenda-item">
                <div class="legenda-cor ocupada"></div>
                <span>Vaga Ocupada</span>
            </div>
            <div class="legenda-item">
                <div class="legenda-cor inexistente"></div>
                <span>Vaga não cadastrada</span>
            </div>
        </div>
        
        <div class="timestamp">
            <i class="fas fa-clock"></i>
            Última atualização: <span id="timestamp"><?php echo date('H:i:s'); ?></span>
        </div>
    </div>
</div>

<?php $conn->close(); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
function atualizarMapa() {
    fetch('getstatusjson.php')
        .then(response => response.json())
        .then(data => {
            // Criar mapa de status
            let statusMap = {};
            data.forEach(vaga => {
                statusMap[vaga.Position] = vaga.Available;
            });
            
            let livres = 0;
            let ocupadas = 0;
            
            // Atualizar cada vaga de 1 a 5
            for(let vagaNum = 1; vagaNum <= 5; vagaNum++) {
                let vagaElement = document.querySelector(`[data-vaga="${vagaNum}"]`);
                if (vagaElement) {
                    if (statusMap[vagaNum] !== undefined) {
                        if (statusMap[vagaNum] == 1) {
                            livres++;
                            vagaElement.className = 'vaga-mapa livre';
                            vagaElement.querySelector('.vaga-icone i').className = 'fas fa-car';
                            vagaElement.querySelector('.vaga-status').innerHTML = 'LIVRE';
                        } else {
                            ocupadas++;
                            vagaElement.className = 'vaga-mapa ocupada';
                            vagaElement.querySelector('.vaga-icone i').className = 'fas fa-car-side';
                            vagaElement.querySelector('.vaga-status').innerHTML = 'OCUPADA';
                        }
                    } else {
                        vagaElement.className = 'vaga-mapa inexistente';
                        vagaElement.querySelector('.vaga-icone i').className = 'fas fa-question-circle';
                        vagaElement.querySelector('.vaga-status').innerHTML = 'NÃO EXISTE';
                    }
                }
            }
            
            // Atualizar contadores
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
        .catch(error => {
            console.log('Erro ao atualizar mapa:', error);
        });
}

// Atualizar a cada 3 segundos
setInterval(atualizarMapa, 3000);
atualizarMapa();
</script>

</body>
</html>