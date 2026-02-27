<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quem Somos - DriveHub Estacionamento Inteligente</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            overflow-x: hidden;
        }
        
        /* ===== NAVBAR ===== */
        .navbar-modern {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            padding: 15px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 24px;
            color: #667eea !important;
        }
        
        .navbar-brand i {
            margin-right: 8px;
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
        
        .nav-link.active {
            color: #667eea !important;
            font-weight: 600;
        }
        
        /* ===== SEÇÃO DO VÍDEO ===== */
        .video-section {
            padding: 120px 0 60px;
            text-align: center;
        }
        
        .video-section h1 {
            color: white;
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        
        .video-section h1 i {
            margin-right: 15px;
        }
        
        .video-section .subtitle {
            color: rgba(255,255,255,0.9);
            font-size: 18px;
            margin-bottom: 40px;
        }
        
        .video-wrapper {
            max-width: 1000px;
            margin: 0 auto;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0,0,0,0.4);
            border: 4px solid white;
            background: black;
            transition: all 0.3s;
        }
        
        .video-wrapper:hover {
            transform: scale(1.02);
            box-shadow: 0 40px 80px rgba(102, 126, 234, 0.5);
        }
        
        .video-wrapper video {
            width: 100%;
            height: auto;
            display: block;
        }
        
        /* ===== SEÇÃO QUEM SOMOS ===== */
        .about-section {
            background: white;
            padding: 80px 0;
            margin: 40px 0;
            border-radius: 50px 50px 0 0;
        }
        
        .about-container {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }
        
        .about-container h2 {
            color: #333;
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 30px;
        }
        
        .about-container h2 i {
            color: #667eea;
            margin-right: 10px;
        }
        
        .about-container p {
            color: #666;
            font-size: 18px;
            line-height: 1.8;
            margin-bottom: 30px;
        }
        
        .about-stats {
            display: flex;
            justify-content: center;
            gap: 50px;
            margin-top: 40px;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 48px;
            font-weight: 800;
            color: #667eea;
        }
        
        .stat-label {
            color: #666;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        /* ===== SEÇÃO BENEFÍCIOS ===== */
        .benefits-section {
            padding: 80px 0;
            background: transparent;
        }
        
        .benefits-section h2 {
            color: white;
            font-size: 42px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 60px;
        }
        
        .benefits-section h2 i {
            margin-right: 10px;
        }
        
        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .benefit-card {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            transition: all 0.4s;
            animation: fadeInUp 0.6s;
            animation-fill-mode: both;
        }
        
        .benefit-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 30px 60px rgba(102, 126, 234, 0.3);
        }
        
        .benefit-card:nth-child(1) { animation-delay: 0.1s; }
        .benefit-card:nth-child(2) { animation-delay: 0.2s; }
        .benefit-card:nth-child(3) { animation-delay: 0.3s; }
        .benefit-card:nth-child(4) { animation-delay: 0.4s; }
        .benefit-card:nth-child(5) { animation-delay: 0.5s; }
        .benefit-card:nth-child(6) { animation-delay: 0.6s; }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .benefit-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
        }
        
        .benefit-icon i {
            font-size: 48px;
            color: white;
        }
        
        .benefit-card h3 {
            color: #333;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .benefit-card p {
            color: #666;
            font-size: 15px;
            line-height: 1.6;
        }
        
        /* ===== SEÇÃO CTA ===== */
        .cta-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 100px 0;
            text-align: center;
            border-radius: 50px 50px 0 0;
            margin-top: 40px;
        }
        
        .cta-section h2 {
            color: white;
            font-size: 52px;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        
        .cta-section .subtitle {
            color: rgba(255,255,255,0.9);
            font-size: 20px;
            margin-bottom: 40px;
        }
        
        .btn-cta {
            background: white;
            color: #667eea;
            border: none;
            padding: 20px 60px;
            border-radius: 60px;
            font-size: 28px;
            font-weight: 700;
            margin: 30px 0;
            transition: all 0.4s;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            display: inline-block;
            text-decoration: none;
        }
        
        .btn-cta:hover {
            transform: scale(1.1) translateY(-5px);
            box-shadow: 0 30px 60px rgba(0,0,0,0.3);
            color: #764ba2;
        }
        
        .btn-cta i {
            margin-right: 10px;
        }
        
        .store-badges {
            display: flex;
            gap: 30px;
            justify-content: center;
            margin: 40px 0 20px;
            flex-wrap: wrap;
        }
        
        .store-badge {
            background: rgba(255,255,255,0.15);
            padding: 15px 40px;
            border-radius: 60px;
            font-size: 20px;
            font-weight: 600;
            color: white;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255,255,255,0.3);
            transition: all 0.3s;
        }
        
        .store-badge:hover {
            background: rgba(255,255,255,0.25);
            transform: scale(1.05);
        }
        
        .store-badge i {
            margin-right: 10px;
            font-size: 24px;
        }
        
        .availability {
            color: rgba(255,255,255,0.8);
            font-size: 16px;
            margin-top: 20px;
        }
        
        /* ===== FOOTER ===== */
        .footer {
            background: #2c3e50;
            color: white;
            padding: 30px 0;
            text-align: center;
        }
        
        .footer i {
            color: #667eea;
        }
        
        /* ===== RESPONSIVIDADE ===== */
        @media (max-width: 992px) {
            .benefits-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .video-section h1 {
                font-size: 36px;
            }
            
            .about-container h2,
            .benefits-section h2 {
                font-size: 32px;
            }
            
            .benefits-grid {
                grid-template-columns: 1fr;
            }
            
            .about-stats {
                flex-direction: column;
                gap: 20px;
            }
            
            .btn-cta {
                font-size: 20px;
                padding: 15px 30px;
            }
            
            .store-badge {
                padding: 10px 20px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg navbar-modern fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="fas fa-parking"></i>DriveHub
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="quem-somos.php"><i class="fas fa-users"></i> Quem Somos</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- ===== SEÇÃO DO VÍDEO ===== -->
<section class="video-section">
    <div class="container">
        <h1 class="animate__animated animate__fadeInDown">
            <i class="fas fa-play-circle"></i> Conheça o DriveHub
        </h1>
        <p class="subtitle animate__animated animate__fadeInUp">
            Veja como nosso sistema pode revolucionar seu estacionamento
        </p>
        
        <div class="video-wrapper animate__animated animate__zoomIn">
            <video controls autoplay muted loop>
                <source src="videos/drivehub-promo.mp4" type="video/mp4">
                Seu navegador não suporta vídeo. 
                <a href="videos/drivehub-promo.mp4">Clique aqui para baixar</a>
            </video>
        </div>
    </div>
</section>

<!-- ===== SEÇÃO QUEM SOMOS ===== -->
<section class="about-section">
    <div class="container">
        <div class="about-container">
            <h2 class="animate__animated animate__fadeInUp">
                <i class="fas fa-users"></i> Quem Somos
            </h2>
            <p class="animate__animated animate__fadeInUp">
                O <strong>DriveHub</strong> nasceu de uma frustração comum: perder tempo precioso procurando vaga em estacionamentos lotados. Nossa equipe de engenheiros e desenvolvedores uniu forças para criar uma solução inteligente que utiliza tecnologia IoT de ponta para monitorar vagas em tempo real.
            </p>
            <p class="animate__animated animate__fadeInUp">
                Com mais de 5 anos de experiência no mercado, já ajudamos centenas de estacionamentos a otimizar seus espaços e milhares de motoristas a economizar tempo e combustível. Nossa missão é tornar a experiência de estacionar simples, rápida e sem estresse.
            </p>
            </div>
        </div>
    </div>
</section>

<!-- ===== SEÇÃO BENEFÍCIOS ===== -->
<section class="benefits-section">
    <div class="container">
        <h2 class="animate__animated animate__fadeInUp">
            <i class="fas fa-star"></i> Por que escolher o DriveHub?
        </h2>
        
        <div class="benefits-grid">
            <!-- Benefício 1 -->
            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3>Economia de Tempo</h3>
                <p>Nunca mais rode procurando vaga. Veja em tempo real onde estacionar e vá direto ao ponto.</p>
            </div>
            
            <!-- Benefício 2 -->
            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <h3>Mapa Interativo</h3>
                <p>Localize seu carro facilmente com nosso mapa detalhado. Nunca mais esqueça onde estacionou.</p>
            </div>
            
            <!-- Benefício 3 -->
            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3>Reserva Antecipada</h3>
                <p>Garanta sua vaga antes mesmo de chegar ao estacionamento. Chegue e estacione direto.</p>
            </div>
            
            <!-- Benefício 4 -->
            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Segurança 24/7</h3>
                <p>Monitoramento constante das vagas e veículos estacionados. Sua segurança em primeiro lugar.</p>
            </div>
            
            <!-- Benefício 5 -->
            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>Relatórios Detalhados</h3>
                <p>Acompanhe estatísticas de ocupação, horários de pico e movimentação do seu estacionamento.</p>
            </div>
            
            <!-- Benefício 6 -->
            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fas fa-wifi"></i>
                </div>
                <h3>Tecnologia IoT</h3>
                <p>Sensores inteligentes de alta precisão garantem informações em tempo real sem falhas.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== SEÇÃO CTA (CHAMADA PARA AÇÃO) ===== -->
<section class="cta-section">
    <div class="container">
        <h2 class="animate__animated animate__fadeInUp">
            Pronto para revolucionar seu estacionamento?
        </h2>
        <p class="subtitle animate__animated animate__fadeInUp">
            Junte-se a centenas de estacionamentos que já otimizaram suas vagas
        </p>
        
        <a href="index.php" class="btn-cta animate__animated animate__pulse animate__infinite">
            <i class="fas fa-rocket"></i> CONHEÇA O DRIVEHUB!
        </a>
        
        <div class="store-badges animate__animated animate__fadeInUp">
            <div class="store-badge">
                <i class="fab fa-google-play"></i> Google Play
            </div>
            <div class="store-badge">
                <i class="fab fa-apple"></i> App Store
            </div>
        </div>
        
        <p class="availability">
            <i class="fas fa-check-circle"></i> Disponível para Android e iOS
        </p>
    </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="footer">
    <div class="container">
        <p>
            <i class="fas fa-parking"></i> DriveHub - Estacionamento Inteligente &copy; 2024 | 
            Todos os direitos reservados
        </p>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Garantir que o vídeo tenha os controles corretos
    document.addEventListener('DOMContentLoaded', function() {
        const video = document.querySelector('video');
        if (video) {
            video.controls = true;
        }
    });
</script>

</body>
</html>