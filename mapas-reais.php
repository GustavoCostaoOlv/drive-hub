<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Mapa de Estacionamentos Reais - DriveHub</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <!-- Leaflet Geocoder (para busca) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    
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
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            max-width: 1400px;
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
        }
        
        #mapa-real {
            height: 600px;
            width: 100%;
            border-radius: 20px;
            border: 3px solid #f1c40f;
            margin-bottom: 20px;
            z-index: 1;
        }
        
        .controles-painel {
            background: #34495e;
            border-radius: 15px;
            padding: 20px;
            color: white;
            margin-top: 20px;
        }
        
        .stats-grid {
            display: flex;
            justify-content: space-around;
            text-align: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .stat-item {
            background: rgba(0,0,0,0.2);
            padding: 15px 25px;
            border-radius: 15px;
            min-width: 150px;
        }
        
        .stat-valor {
            font-size: 36px;
            font-weight: 700;
            color: #f1c40f;
        }
        
        .btn-buscar {
            background: #f1c40f;
            color: #2c3e50;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s;
            margin-right: 10px;
        }
        
        .btn-buscar:hover {
            background: #d4ac0d;
            transform: scale(1.05);
        }
        
        .btn-localizar {
            background: #3498db;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .btn-localizar:hover {
            background: #2980b9;
            transform: scale(1.05);
        }
        
        .local-info {
            background: rgba(255,255,255,0.1);
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
            font-size: 14px;
        }
        
        .legenda {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 20px 0;
            flex-wrap: wrap;
        }
        
        .legenda-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .legenda-cor {
            width: 20px;
            height: 20px;
            border-radius: 4px;
        }
        
        .legenda-cor.publico { background: #3498db; }
        .legenda-cor.privado { background: #e74c3c; }
        .legenda-cor.subterraneo { background: #2ecc71; }
        .legenda-cor.vaga { background: #f1c40f; }
        
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        
        .loading-spinner {
            background: white;
            padding: 30px;
            border-radius: 20px;
            text-align: center;
        }
        
        .loading-spinner i {
            font-size: 48px;
            color: #3498db;
            animation: spin 1s linear infinite;
        }
        
        .search-container {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .search-input {
            flex: 1;
            padding: 12px 20px;
            border-radius: 25px;
            border: none;
            font-size: 16px;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

<div class="loading-overlay" id="loading">
    <div class="loading-spinner">
        <i class="fas fa-spinner"></i>
        <h4 class="mt-3">Buscando estacionamentos...</h4>
    </div>
</div>

<div class="container">
    <div class="mapa-container">
        
        <div class="parking-title">
            <h2>
                <i class="fas fa-map-marked-alt"></i>
                MAPA DE ESTACIONAMENTOS REAIS
                <i class="fas fa-map-marked-alt"></i>
            </h2>
            <p><i class="fas fa-database"></i> Dados do OpenStreetMap</p>
        </div>
        
        <!-- BARRA DE PESQUISA -->
        <div class="controles-painel">
            <div class="search-container">
                <input type="text" 
                       class="search-input" 
                       id="search-input" 
                       placeholder="Digite o nome da cidade (ex: Fortaleza, Rio de Janeiro, Brasília...)"
                       value="Fortaleza">
                <button class="btn-buscar" onclick="pesquisarCidade()">
                    <i class="fas fa-search"></i> Pesquisar
                </button>
                <button class="btn-localizar" onclick="usarMinhaLocalizacao()">
                    <i class="fas fa-location-dot"></i> Minha Localização
                </button>
            </div>
            
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-valor" id="total-estacionamentos">0</div>
                    <div class="stat-label">Estacionamentos</div>
                </div>
                <div class="stat-item">
                    <div class="stat-valor" id="total-vagas-estimado">0</div>
                    <div class="stat-label">Vagas (estimado)</div>
                </div>
                <div class="stat-item">
                    <div class="stat-valor" id="cidade-atual">-</div>
                    <div class="stat-label">Cidade</div>
                </div>
            </div>
            
            <div class="local-info" id="local-info">
                <i class="fas fa-info-circle"></i>
                Digite o nome de uma cidade e clique em Pesquisar
            </div>
        </div>
        
        <!-- Mapa -->
        <div id="mapa-real"></div>
        
        <!-- Legenda -->
        <div class="legenda">
            <div class="legenda-item">
                <div class="legenda-cor publico"></div>
                <span class="text-white">Estacionamento Público</span>
            </div>
            <div class="legenda-item">
                <div class="legenda-cor privado"></div>
                <span class="text-white">Estacionamento Privado</span>
            </div>
            <div class="legenda-item">
                <div class="legenda-cor subterraneo"></div>
                <span class="text-white">Estacionamento Subterrâneo</span>
            </div>
            <div class="legenda-item">
                <div class="legenda-cor vaga"></div>
                <span class="text-white">Nossas Vagas Monitoradas</span>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>
// ============================================
// VARIÁVEIS GLOBAIS
// ============================================
let mapa;
let marcadoresEstacionamentos = [];
let nossasVagas = [];
// let geocoder = L.Control.Geocoder.nominatim();
let buscandoEstacionamentos = false;

// FUNÇÃO PARA BUSCAR COORDENADAS DA CIDADE (VERSÃO MELHORADA)
async function buscarCoordenadas(cidade, tentativa = 1) {
    const maxTentativas = 3;
    
    // LISTA DE FORMATOS PARA TENTAR
    const formatos = [
        cidade, // original
        cidade.normalize('NFD').replace(/[\u0300-\u036f]/g, ""), // sem acentos
        cidade + ', Brasil', // com país
        cidade.split(',')[0].trim() + ', Brasil', // só a cidade + Brasil
        cidade.replace(/[^a-zA-Z0-9 ]/g, ''), // remove caracteres especiais
        cidade.split(' ').join('+'), // com + no lugar de espaços
        encodeURIComponent(cidade) // codificado
    ];
    
    // TENTAR CADA FORMATO
    for (let i = 0; i < formatos.length; i++) {
        const cidadeFormatada = formatos[i];
        
        try {
            console.log(`🔍 Tentativa ${i+1}: "${cidadeFormatada}"`);
            
            // PROXIES CORS (alternando)
            const proxies = [
                'https://corsproxy.io/?',
                'https://api.allorigins.win/raw?url=',
                'https://cors-anywhere.herokuapp.com/'
            ];
            
            const proxy = proxies[(tentativa - 1) % proxies.length];
            
            const url = proxy + encodeURIComponent(
                'https://nominatim.openstreetmap.org/search?q=' + cidadeFormatada + 
                '&limit=5&format=json&accept-language=pt&addressdetails=1'
            );
            
            const controller = new AbortController();
            const timeoutId = setTimeout(() => controller.abort(), 5000);
            
            const response = await fetch(url, {
                signal: controller.signal,
                headers: {'User-Agent': 'DriveHub-Parking/1.0'}
            });
            
            clearTimeout(timeoutId);
            
            if (!response.ok) continue;
            
            const data = await response.json();
            
            if (data && data.length > 0) {
                // PEGAR O MELHOR RESULTADO
                let melhorResultado = data[0];
                
                // PROCURAR POR CIDADE NO NOME (em vez de bairro)
                for (let j = 0; j < data.length; j++) {
                    if (data[j].type === 'city' || data[j].type === 'town') {
                        melhorResultado = data[j];
                        break;
                    }
                }
                
                console.log('✅ Encontrado:', melhorResultado.display_name);
                return {
                    lat: parseFloat(melhorResultado.lat),
                    lng: parseFloat(melhorResultado.lon),
                    nome: melhorResultado.display_name
                };
            }
            
        } catch (error) {
            console.log(`❌ Tentativa ${i+1} falhou:`, error.message);
        }
    }
    
    // SE CHEGOU AQUI, NENHUMA TENTATIVA FUNCIONOU
    throw new Error(`Não foi possível encontrar "${cidade}"`);
}

// COORDENADAS DAS NOSSAS VAGAS (MONITORADAS)
const vagasMonitoradas = [
    { id: 1, nome: 'Vaga 1 - Piso Térreo', lat: -23.5505, lng: -46.6333, status: 1 },
    { id: 2, nome: 'Vaga 2 - Piso Térreo', lat: -23.5505, lng: -46.6334, status: 1 },
    { id: 3, nome: 'Vaga 3 - Piso Superior', lat: -23.5504, lng: -46.6333, status: 1 },
    { id: 4, nome: 'Vaga 4 - Piso Superior', lat: -23.5504, lng: -46.6334, status: 0 },
    { id: 5, nome: 'Vaga 5 - Área Coberta', lat: -23.5503, lng: -46.6333, status: 1 }
];
// INICIALIZAR MAPA - VERSÃO SEM LOOP
function iniciarMapa() {
    mapa = L.map('mapa-real').setView([-3.7319, -38.5267], 13); // Fortaleza como padrão
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(mapa);
    
    // ADICIONAR NOSSAS VAGAS MONITORADAS
    adicionarNossasVagas();
    
    // NÃO FAZ BUSCA AUTOMÁTICA - SÓ MOSTRA MENSAGEM
    document.getElementById('loading').style.display = 'none';
    document.getElementById('local-info').innerHTML = `
        <i class="fas fa-info-circle"></i>
        Clique em "Pesquisar" para buscar estacionamentos em Fortaleza
    `;
}
// FUNÇÃO PRINCIPAL DE PESQUISA - VERSÃO MELHORADA
async function pesquisarCidade(cidadeParametro = null) {
    let cidade;
    
    if (cidadeParametro) {
        cidade = cidadeParametro;
        document.getElementById('search-input').value = cidade;
    } else {
        cidade = document.getElementById('search-input').value.trim();
    }
    
    if (!cidade) {
        alert('Digite o nome de uma cidade');
        return;
    }
    
    if (buscandoEstacionamentos) {
        console.log('⏳ Já existe uma busca em andamento');
        return;
    }
    
    document.getElementById('loading').style.display = 'flex';
    document.getElementById('cidade-atual').textContent = cidade;
    document.getElementById('local-info').innerHTML = `
        <i class="fas fa-info-circle"></i>
        Buscando: ${cidade}...
    `;
    
    try {
        const resultado = await buscarCoordenadas(cidade);
        
        mapa.flyTo([resultado.lat, resultado.lng], 14, {
            duration: 2,
            easeLinearity: 0.5
        });
        
        document.getElementById('local-info').innerHTML = `
            <i class="fas fa-check-circle" style="color: #2ecc71;"></i>
            <strong>${resultado.nome}</strong><br>
            <small>Buscando estacionamentos...</small>
        `;
        
        setTimeout(() => {
            buscarEstacionamentosNoMapa();
        }, 2500);
        
    } catch (error) {
        console.error('Erro:', error);
        document.getElementById('loading').style.display = 'none';
        
        // MENSAGEM DE ERRO MAIS AMIGÁVEL
        document.getElementById('local-info').innerHTML = `
            <i class="fas fa-exclamation-triangle" style="color: #e74c3c;"></i>
            Não encontrei "${cidade}".<br>
            <small>Tente: "Fortaleza, CE" ou "São Paulo, SP"</small>
        `;
    }
}
// ============================================
// BUSCAR ESTACIONAMENTOS NA ÁREA ATUAL DO MAPA
// ============================================
// ============================================
// BUSCAR ESTACIONAMENTOS NA ÁREA ATUAL DO MAPA
// ============================================
async function buscarEstacionamentosNoMapa() {

    console.log('🔍 Chamada recebida em:', new Date().toLocaleTimeString(), 'já está buscando?', buscandoEstacionamentos);

    // EVITAR MÚLTIPLAS BUSCAS SIMULTÂNEAS
    if (buscandoEstacionamentos) {
        console.log('⏳ Já está buscando estacionamentos...');
        return;
    }
    
    buscandoEstacionamentos = true;
    
    try {
        // REMOVER MARCADORES ANTIGOS
        marcadoresEstacionamentos.forEach(m => mapa.removeLayer(m));
        marcadoresEstacionamentos = [];
        
        // PEGAR BOUNDS DO MAPA (visível na tela)
        const bounds = mapa.getBounds();
        const sul = bounds.getSouth();
        const norte = bounds.getNorth();
        const oeste = bounds.getWest();
        const leste = bounds.getEast();
        
        // CONSULTA OVERPASS API
        const query = `[out:json];
            (
                node["amenity"="parking"](${sul},${oeste},${norte},${leste});
                way["amenity"="parking"](${sul},${oeste},${norte},${leste});
                relation["amenity"="parking"](${sul},${oeste},${norte},${leste});
            );
            out center;`;
        
        // USAR ABORT CONTROLLER PARA TIMEOUT
        const controller = new AbortController();
        const timeoutId = setTimeout(() => controller.abort(), 10000); // 10 segundos
        
        try {
            const response = await fetch('https://overpass-api.de/api/interpreter', {
                method: 'POST',
                body: query,
                signal: controller.signal
            });
            
            clearTimeout(timeoutId); // Cancelar timeout se chegou resposta
            
            const data = await response.json();
            
            // PROCESSAR RESULTADOS
            const estacionamentos = data.elements.filter(el => 
                el.tags && el.tags.amenity === 'parking'
            );
            
            document.getElementById('total-estacionamentos').textContent = estacionamentos.length;
            document.getElementById('total-vagas-estimado').textContent = 
                estacionamentos.length * 50; // Estimativa
            
            // ADICIONAR MARCADORES
            estacionamentos.forEach((est) => {
                let lat, lng;
                
                if (est.type === 'node') {
                    lat = est.lat;
                    lng = est.lon;
                } else if (est.center) {
                    lat = est.center.lat;
                    lng = est.center.lon;
                } else {
                    return;
                }
                
                // DETERMINAR TIPO DE ESTACIONAMENTO
                let tipo = est.tags.parking || 'surface';
                let cor = '#3498db';
                let iconeTipo = 'fa-parking';
                
                if (tipo === 'underground') {
                    cor = '#2ecc71';
                    iconeTipo = 'fa-arrow-down';
                } else if (tipo === 'multi-storey') {
                    cor = '#e74c3c';
                    iconeTipo = 'fa-building';
                }
                
                const icone = L.divIcon({
                    html: `<div style="
                        background-color: ${cor};
                        width: 30px;
                        height: 30px;
                        border-radius: 8px;
                        border: 2px solid white;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: white;
                        font-size: 16px;
                    "><i class="fas ${iconeTipo}"></i></div>`,
                    className: '',
                    iconSize: [30, 30],
                    iconAnchor: [15, 15]
                });
                
                const marcador = L.marker([lat, lng], { icon: icone }).addTo(mapa);
                
                let popupContent = `
                    <div style="min-width: 200px;">
                        <h5>${est.tags.name || 'Estacionamento'}</h5>
                        <p><strong>Tipo:</strong> ${tipo}</p>
                `;
                
                if (est.tags.capacity) {
                    popupContent += `<p><strong>Capacidade:</strong> ${est.tags.capacity} vagas</p>`;
                }
                
                popupContent += `</div>`;
                
                marcador.bindPopup(popupContent);
                marcadoresEstacionamentos.push(marcador);
            });
            
            // Atualizar mensagem de sucesso
            document.getElementById('local-info').innerHTML = `
                <i class="fas fa-check-circle" style="color: #2ecc71;"></i>
                Encontrados ${estacionamentos.length} estacionamentos!
            `;
            
        } catch (fetchError) {
            if (fetchError.name === 'AbortError') {
                console.log('⏰ Timeout - API demorou demais');
                document.getElementById('local-info').innerHTML = `
                    <i class="fas fa-exclamation-triangle" style="color: #e74c3c;"></i>
                    Tempo esgotado. Tente novamente.
                `;
            } else {
                throw fetchError;
            }
        }
        
    } catch (error) {
        console.error('Erro na busca:', error);
        document.getElementById('local-info').innerHTML = `
            <i class="fas fa-exclamation-triangle" style="color: #e74c3c;"></i>
            Erro ao buscar estacionamentos.
        `;
    } finally {
        // DESLIGAR LOADING E LIBERAR FLAG
        document.getElementById('loading').style.display = 'none';
        buscandoEstacionamentos = false;
        console.log('✅ Busca finalizada, flag liberada');
    }
}

// ============================================
// USAR LOCALIZAÇÃO DO USUÁRIO
// ============================================
function usarMinhaLocalizacao() {
    if (!navigator.geolocation) {
        alert('Geolocalização não suportada pelo seu navegador');
        return;
    }
    
    document.getElementById('loading').style.display = 'flex';
    
    navigator.geolocation.getCurrentPosition(
        (position) => {
            const { latitude, longitude } = position.coords;
            
            mapa.flyTo([latitude, longitude], 15);
            
            document.getElementById('local-info').innerHTML = `
                <i class="fas fa-check-circle" style="color: #2ecc71;"></i>
                Usando sua localização atual<br>
                <small>Lat: ${latitude.toFixed(4)}, Lng: ${longitude.toFixed(4)}</small>
            `;
            
            document.getElementById('cidade-atual').textContent = 'Localização atual';
            
            // Buscar estacionamentos próximos (o loading será desligado dentro da função)
            setTimeout(() => {
                buscarEstacionamentosNoMapa();
            }, 1500);
            
        },
        (error) => {
            document.getElementById('loading').style.display = 'none';
            alert('Erro ao obter localização: ' + error.message);
        }
    );
}

// ============================================
// ADICIONAR NOSSAS VAGAS AO MAPA
// ============================================
function adicionarNossasVagas() {
    vagasMonitoradas.forEach(vaga => {
        const icone = L.divIcon({
            html: `<div style="
                background-color: ${vaga.status ? '#2ecc71' : '#e74c3c'};
                width: 25px;
                height: 25px;
                border-radius: 50%;
                border: 2px solid white;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-weight: bold;
                font-size: 12px;
            ">${vaga.id}</div>`,
            className: '',
            iconSize: [25, 25],
            iconAnchor: [12, 12]
        });
        
        const marcador = L.marker([vaga.lat, vaga.lng], { icon: icone }).addTo(mapa);
        marcador.bindPopup(`
            <div style="text-align: center;">
                <h5>${vaga.nome}</h5>
                <p style="color: ${vaga.status ? '#2ecc71' : '#e74c3c'}; font-weight: bold;">
                    ${vaga.status ? '🟢 LIVRE' : '🔴 OCUPADA'}
                </p>
                <small>Nossa vaga monitorada</small>
            </div>
        `);
        
        nossasVagas.push(marcador);
    });
}
// INICIAR QUANDO A PÁGINA CARREGAR
window.onload = function() {
    iniciarMapa(); // Só inicia o mapa, sem busca automática
    
    // Adicionar evento de Enter no input
    document.getElementById('search-input').addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            pesquisarCidade();
        }
    });
};
</script>

</body>
</html>