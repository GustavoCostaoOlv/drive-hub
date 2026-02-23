<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>DriveHub</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 (mais moderno) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome para ícones -->
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
        
        /* Seção Sobre */
        .about-section {
            background: white;
            border-radius: 50px 50px 0 0;
            padding: 60px 0;
            margin-top: 50px;
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
    </style>
</head>
<body>

<?php include 'dbcon.php'; ?>

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
                    <a class="nav-link active" href="#home"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ParkingLotDisplay.php"><i class="fas fa-table"></i> Display</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="simulador.php"><i class="fas fa-gamepad"></i> Simulador</a>
                </li>
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
            <a href="simulador.php" class="btn btn-outline-light btn-lg">
                <i class="fas fa-gamepad"></i> Simulador
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
            
            while($row = $result->fetch_assoc()) { 
                $classe = $row['Available'] == 1 ? 'livre' : 'ocupada';
                $icone = $row['Available'] == 1 ? 'fa-car' : 'fa-car-side';
                $texto = $row['Available'] == 1 ? 'LIVRE' : 'OCUPADA';
            ?>
            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="vaga-card <?php echo $classe; ?>" data-vaga="<?php echo $row['Position']; ?>">
                    <div class="vaga-badge">
                        <i class="fas fa-microchip"></i> Sensor <?php echo $row['Position']; ?>
                    </div>
                    <div class="vaga-numero"><?php echo $row['Position']; ?></div>
                    <div class="vaga-icone">
                        <i class="fas <?php echo $icone; ?>"></i>
                    </div>
                    <div class="vaga-status"><?php echo $texto; ?></div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    
    <!-- Timestamp -->
    <div class="timestamp animate__animated animate__fadeInUp">
        <i class="fas fa-clock"></i> Última atualização: <span id="timestamp"><?php echo date('H:i:s'); ?></span>
    </div>
</div>

<!-- Seção Sobre -->
<section class="about-section">
    <div class="container">
        <h2 class="text-center mb-5 animate__animated animate__fadeInUp">
            <i class="fas fa-cogs"></i> Como Funciona
        </h2>
        
        <div class="row">
            <div class="col-md-4">
                <div class="feature-box animate__animated animate__fadeInUp">
                    <div class="feature-icon">
                        <i class="fas fa-microchip"></i>
                    </div>
                    <h3 class="feature-title">Sensores Ultrassônicos</h3>
                    <p class="feature-text">5 sensores monitoram a presença de veículos nas vagas em tempo real</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                    <div class="feature-icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <h3 class="feature-title">Banco de Dados</h3>
                    <p class="feature-text">Informações armazenadas e atualizadas automaticamente no MySQL</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="feature-title">Monitoramento</h3>
                    <p class="feature-text">Visualização em tempo real com atualização automática a cada 3 segundos</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer-modern">
    <div class="container">
        <p class="mb-0">
            <i class="fas fa-parking"></i> Smart Parking IoT &copy; 2024 | 
            Desenvolvido com <i class="fas fa-heart text-danger"></i> para inovação
        </p>
    </div>
</footer>

<?php $conn->close(); ?>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Função para atualizar as vagas
function atualizarVagas() {
    console.log('🔄 Atualizando vagas...');
    
    fetch('getstatusjson.php')
        .then(response => response.json())
        .then(data => {
            console.log('📊 Dados recebidos:', data);
            
            // Pegar todos os cards
            let cards = document.querySelectorAll('.vaga-card');
            
            let livres = 0;
            let ocupadas = 0;
            
            // Atualizar cada card
            data.forEach((vaga, index) => {
                if (cards[index]) {
                    let status = vaga.Available; // "1" ou "0"
                    
                    if (status == "1") {
                        livres++;
                        cards[index].className = 'vaga-card livre';
                        cards[index].querySelector('.vaga-status').innerHTML = 'LIVRE';
                        cards[index].querySelector('.vaga-icone i').className = 'fas fa-car';
                    } else {
                        ocupadas++;
                        cards[index].className = 'vaga-card ocupada';
                        cards[index].querySelector('.vaga-status').innerHTML = 'OCUPADA';
                        cards[index].querySelector('.vaga-icone i').className = 'fas fa-car-side';
                    }
                }
            });
            
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
            
            console.log(`✅ Atualizado: ${livres} livres, ${ocupadas} ocupadas`);
        })
        .catch(erro => {
            console.log('❌ Erro:', erro);
        });
}

// Iniciar atualização a cada 3 segundos
setInterval(atualizarVagas, 3000);

// Atualizar quando a página carregar
document.addEventListener('DOMContentLoaded', atualizarVagas);

console.log('🚀 Sistema de atualização automática iniciado!');
</script>

</body>
</html>