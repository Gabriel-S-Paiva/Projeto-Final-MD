# Komudu — Modular Furniture Simulator & Store

> **Projeto Final** desenvolvido para o curso "Avançado em Desenho de Websites" da **MasterD**

**Komudu** é uma plataforma moderna de e-commerce especializada na venda e simulação de **móveis modulares**. A plataforma combina um catálogo de produtos com um simulador interativo que permite aos utilizadores visualizar e organizar móveis em espaços virtuais.

![Komudu Logo](Assets/Imgs/Logo.svg)

---

## 🧩 Funcionalidades Principais

### 🏠 **Homepage**
- Hero section com apresentação da marca
- Produtos em destaque carregados dinamicamente
- Seções sobre a empresa e filosofia modular
- Design responsivo mobile-first

### 📦 **Catálogo de Produtos**
- Sistema de filtros avançado (dimensões, tipos, cores, compatibilidade)
- Grelha responsiva de produtos
- Integração com sistema de favoritos
- Navegação por categorias e tags

### 🔍 **Página de Produto**
- Detalhes completos do produto
- Sistema de variantes (cores, dimensões, preços)
- Funcionalidade "Adicionar ao Carrinho"
- Botão de favoritos (requer login)
- Informações de compatibilidade modular

### 🛒 **Carrinho de Compras**
- Gestão de produtos e quantidades
- Cálculo automático de preços (incluindo variantes)
- Interface intuitiva para edição
- Persistência entre sessões

### 🧩 **Simulador de Espaços**
- Canvas interativo para arrastar e soltar módulos
- Controlos por teclado (R - rodar, D - duplicar, +/- - escalar, Delete - remover)
- Salvamento de simulações personalizadas
- Carregamento de simulações salvas
- Exportação para PNG
- **Recomendado para desktop** para melhor experiência

### 👤 **Sistema de Utilizadores**
- Registo e login seguros
- Perfil pessoal editável
- Gestão de favoritos
- Histórico de simulações salvas

### ⚙️ **Painel de Administração**
- Gestão completa de produtos (CRUD)
- Upload de imagens
- Gestão de variantes e stock
- Interface administrativa dedicada

---

## 📦 Tecnologias Utilizadas

### **Frontend**
- **HTML5** semântico
- **CSS3** com design system personalizado
- **TailwindCSS** (via CDN) para styling responsivo
- **JavaScript Vanilla** para interatividade
- **Canvas API** para o simulador

### **Backend**
- **PHP 7.3+** para lógica servidor
- **MySQL 8.0+** para base de dados
- **API REST** personalizada

### **Design**
- **Tipografia**: Unispace (display) + Switzer (corpo)
- **Paleta de Cores**: `#000000`, `#2E2E2E`, `#3A4A5A`, `#A5B5C0`, `#E5DCCA`, `#FFFFFF`
- **Icons**: Material Symbols Outlined

---

## 🚀 Setup e Instalação

### **Pré-requisitos**
- **XAMPP/WAMP/MAMP** ou servidor Apache
- **PHP 7.3** ou superior
- **MySQL 8.0** ou superior
- **phpMyAdmin** (recomendado)

### **1. Clonagem do Projeto**
```bash
git clone https://github.com/Gabriel-S-Paiva/Projeto-Final-MD.git
cd Projeto-Final-MD
```

### **2. Configuração do Servidor**
1. Copie a pasta do projeto para a pasta `htdocs` (XAMPP) ou `www` (WAMP)
2. O caminho deve ser: `C:\xampp\htdocs\Projeto-Final-MD\`
3. Inicie os serviços **Apache** e **MySQL**

### **3. Configuração da Base de Dados**
1. Aceda ao **phpMyAdmin** (`http://localhost/phpmyadmin`)
2. Crie uma nova base de dados chamada `komodu`
3. Importe o ficheiro SQL fornecido (`komodu.sql`)
4. Configure a ligação em `includes/connect.php`:

```php
<?php
$servername = "localhost";
$username = "root";
$password = ""; // Deixar vazio para XAMPP padrão
$dbname = "komodu";
```

### **4. Estrutura de Ficheiros**
```
Projeto-Final-MD/
├── index.php                 # Homepage
├── api/                      # APIs REST
│   ├── modules.php          # Gestão de produtos
│   ├── cart.php             # Carrinho de compras
│   ├── simulation.php       # Simulador
│   ├── session.php          # Autenticação
│   └── ...
├── pages/                    # Páginas principais
│   ├── catalog.php          # Catálogo
│   ├── product.php          # Produto individual
│   ├── simulator.php        # Simulador
│   ├── cart.php             # Carrinho
│   └── ...
├── Js/                       # JavaScript
├── Assets/                   # Recursos estáticos
└── includes/                 # Componentes partilhados
```


### **5. Acesso ao Site e Login**
- **URL Base**: `http://localhost/Projeto-Final-MD/`
- **Admin Dashboard**: `http://localhost/Projeto-Final-MD/pages/admin.php`

#### **Login de Utilizador**
- Registe-se ou faça login na área de cliente para aceder a funcionalidades como favoritos, simulações e histórico de compras.

#### **Login de Administrador**
- Para aceder ao painel administrativo faça login como:
   - **Utilizador:** `admin`
   - **Password:** `admin`
- Após login, terá acesso à gestão de produtos, utilizadores e histórico de entregas.

---

## 🎯 Como Utilizar

### **Para Utilizadores Finais**

1. **Explorar Produtos**
   - Aceda ao catálogo através do menu
   - Use filtros para encontrar produtos específicos
   - Clique em produtos para ver detalhes

2. **Gerir Carrinho**
   - Adicione produtos ao carrinho
   - Ajuste quantidades conforme necessário
   - Proceda ao checkout quando pronto

3. **Usar o Simulador**
   - Aceda ao simulador no menu
   - Arraste módulos da biblioteca para o canvas
   - Use teclas de atalho para manipular objetos:
     - **R**: Rodar módulo
     - **D**: Duplicar módulo
     - **+/-**: Aumentar/diminuir escala
     - **Delete**: Remover módulo
   - Salve simulações com nome personalizado

4. **Conta Pessoal**
   - Registe-se para acesso completo
   - Gerir favoritos e simulações salvas
   - Aceder histórico pessoal

### **Para Administradores**

1. **Gestão de Produtos**
   - Aceda ao painel admin
   - Adicione novos produtos com imagens
   - Configure variantes e preços
   - Gerir stock e disponibilidade

2. **Upload de Imagens**
   - Use a funcionalidade de upload integrada
   - Imagens são automaticamente otimizadas
   - Suporte para múltiplos formatos

---

## 🗃️ Estrutura da Base de Dados

### **Tabelas Principais**

- **`users`**: Dados dos utilizadores registados
- **`modules`**: Catálogo de produtos modulares
- **`module_variants`**: Variações de produtos (cores, tamanhos)
- **`cart`** / **`cart_items`**: Sistema de carrinho
- **`favorites`**: Produtos favoritos por utilizador
- **`simulations`** / **`simulation_items`**: Simulações salvas

### **Exemplo de Dados**
A base de dados inclui produtos de exemplo como:
- Sofás modulares (€499.99)
- Estantes e bibliotecas (€129.99)
- Mesas de café (€89.99)
- Cadeiras empilháveis (€39.99)
- E muito mais...

---

## 🎨 Design System

### **Cores Principais**
- **Preto**: `#000000` - Texto principal
- **Cinza Escuro**: `#2E2E2E` - Elementos destacados
- **Azul Acinzentado**: `#3A4A5A` - Cor primária
- **Cinza Médio**: `#A5B5C0` - Elementos secundários
- **Bege**: `#E5DCCA` - Fundo de secções
- **Branco**: `#FFFFFF` - Fundo principal

### **Tipografia**
- **Unispace**: Títulos e elementos de destaque
- **Switzer**: Texto corrido e navegação

---

## 📱 Compatibilidade

- **Mobile-first**: Optimizado prioritariamente para dispositivos móveis
- **Responsive**: Adapta-se perfeitamente a tablets e desktop
- **Navegadores**: Chrome, Firefox, Safari, Edge (versões modernas)
- **Simulador**: Melhor experiência em desktop/laptop

---

## 🔧 APIs Disponíveis

### **Módulos** (`/api/modules.php`)
- `GET`: Listar produtos com filtros
- `POST`: Adicionar novo produto (admin)
- `PUT`: Atualizar produto (admin)
- `DELETE`: Remover produto (admin)

### **Carrinho** (`/api/cart.php`)
- `GET`: Obter itens do carrinho
- `POST`: Adicionar item ao carrinho
- `PUT`: Atualizar quantidade
- `DELETE`: Remover item

### **Simulações** (`/api/simulation.php`)
- `GET`: Carregar simulação por ID
- `POST`: Salvar nova simulação
- `PUT`: Atualizar simulação existente
- `DELETE`: Remover simulação

---

## 📋 Estado do Projeto

### ✅ **Funcionalidades Completas**
- Sistema de utilizadores com autenticação
- Catálogo responsivo com filtros
- Carrinho funcional com cálculo de preços
- Simulador interativo com drag & drop
- Painel administrativo
- APIs REST funcionais

### 🔄 **Melhorias Futuras**
- Sistema de checkout completo
- Integração de pagamentos
- Notificações por email
- Modo escuro
- PWA (Progressive Web App)

---

## 👨‍💻 Desenvolvimento

**Desenvolvido por**: Gabriel S. Paiva  
**Curso**: Avançado em Desenho de Websites - MasterD  
**Ano**: 2025

---

## 📞 Suporte

Para questões técnicas ou dúvidas sobre o projeto:
- Verifique os comentários no código fonte
- Analise a estrutura da base de dados fornecida

---

## 📄 Licença

Este projeto foi desenvolvido para fins educacionais como projeto final de curso.

---

*"Tudo se encaixa" - Soluções modulares que se adaptam ao seu espaço, ao seu ritmo e à sua rotina.*