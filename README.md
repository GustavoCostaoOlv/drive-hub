# 🅿️ DriveHub - Smart Parking System

### 📋 Sobre o Projeto

Este sistema foi desenvolvido para resolver um problema comum: a dificuldade de encontrar vagas em estacionamentos lotados. O que começou como uma frustração pessoal em um estacionamento de supermercado se transformou em uma solução completa de monitoramento de vagas em tempo real.

### 🎯 Problema

Minha família e eu estávamos indo ao shopping, apenas para sermos surpreendidos pela indisponibilidade de vagas no estacionamento. Rodamos por cerca de meia hora antes de conseguir estacionar. Além disso, essa peregrinação em estacionamentos pode contribuir para acidentes, já que dados estatísticos mostram que estacionamentos são locais frequentes de colisões entre veículos.

### 💡 Solução

O sistema detecta as vagas ocupadas e livres, atualizando essas informações em tempo real em uma interface web para os usuários consultarem.

### 🚗 Como Funciona

**Hardware (versão original com Arduino):**
- Sensores ultrassônicos conectados a um Arduino Mega detectam a presença de veículos
- Cada vaga possui um sensor que mede a distância até o carro
- Os dados são enviados via requisições HTTP para atualizar o banco de dados SQL

**Software (sistema web atual):**
- Interface moderna e responsiva
- Visualização em tempo real das vagas
- Sistema de reserva de vagas com placa do veículo
- Temporizador de ocupação
- Mapa interativo com localização das vagas
- Painel administrativo simples

### ✨ Funcionalidades Atuais

- ✅ **Visualização em tempo real** - Vagas com cores (verde/vermelho)
- ✅ **Tempo de ocupação** - Mostra há quanto tempo a vaga está ocupada
- ✅ **Reserva de vagas** - Ocupar vaga informando placa, nome e telefone
- ✅ **Liberar vaga** - Botão para desocupar a vaga
- ✅ **Mapa interativo** - Localização exata de cada vaga
- ✅ **Consulta de veículo** - Cliente descobre onde estacionou pela placa
- ✅ **Histórico simples** - Últimas movimentações
- ✅ **Design responsivo** - Funciona em celulares e tablets

### 🛠️ Tecnologias Utilizadas

- **Frontend:** HTML5, CSS3, JavaScript, Bootstrap 5
- **Backend:** PHP
- **Banco de Dados:** MySQL
- **Mapas:** Leaflet.js com OpenStreetMap
- **Ícones:** Font Awesome
- **Animações:** Animate.css

### 📁 Estrutura do Banco de Dados

```sql
-- Tabela principal de vagas
CREATE TABLE `parkinglot` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Position` int(11) NOT NULL,
  `Available` int(11) NOT NULL DEFAULT 1,
  `SensorId` int(11) DEFAULT NULL,
  `ocupado_desde` timestamp NULL DEFAULT NULL,
  `placa` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Position` (`Position`)
);

-- Tabela de clientes
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `placa` varchar(10) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `placa` (`placa`)
);