# Sistema SIPAT - CIPA

Sistema web para cadastro de participantes e sorteio de prêmios da Semana Interna de Prevenção de Acidentes do Trabalho (SIPAT).

## 📋 Visão Geral

O sistema é composto por três componentes principais:
- **Cadastro de participantes** (sipat.php)
- **Sorteio de prêmios** (sorteador.php)  
- **Estrutura do banco de dados** (database_fix.sql)

## 🗂️ Estrutura dos Arquivos

```
CIPA/
├── sipat.php           # Formulário de cadastro
├── sorteador.php       # Sistema de sorteio
├── database_fix.sql    # Script do banco de dados
├── index.php           # Arquivo de teste de imagem
└── images/             # Pasta de imagens
    ├── logo_da_uri(oficial).png
    └── cipaImagem(oficial).png
```

## 🎯 Funcionalidades

### 1. Cadastro de Participantes (sipat.php)
- Interface web com formulário para cadastro de nomes
- Validação de campos obrigatórios
- Inserção automática nas tabelas `participantes` e `primeiro_dia`
- Design responsivo com tema azul marinho

### 2. Sistema de Sorteio (sorteador.php)
- Sorteio sequencial de 8 posições (8º ao 1º lugar)
- Critério de elegibilidade: mínimo 3 palestras assistidas
- Controle de sessão para evitar duplicatas
- Interface visual com logos institucionais (URI e CIPA)
- Botão "Próximo Sorteio" para revelação gradual dos ganhadores
- Exibição dos ganhadores anteriores durante o processo

### 3. Banco de Dados (database_fix.sql)
Estrutura com 6 tabelas:
- `participantes` - Dados principais dos participantes
- `primeiro_dia` - Presença no primeiro dia
- `palestra_inclusao` - Presença na palestra de inclusão
- `epi` - Presença na palestra de EPI
- `meio_ambiente` - Presença na palestra de meio ambiente
- `saude_da_voz` - Presença na palestra de saúde da voz

## ⚙️ Configuração

### Pré-requisitos
- XAMPP ou servidor web com PHP e MySQL
- PHP 7.0 ou superior
- MySQL 5.7 ou superior

### Configuração do Banco
1. Execute o script `database_fix.sql` no MySQL

### Instalação
1. Coloque os arquivos na pasta `htdocs/CIPA/`
2. Crie a pasta `images/` e adicione as imagens:
   - `logo_da_uri(oficial).png`
   - `cipaImagem(oficial).png`
3. Acesse `http://localhost/CIPA/sipat.php` para cadastros
4. Acesse `http://localhost/CIPA/sorteador.php` para sorteios

## 🎲 Como Funciona o Sorteio

1. **Critério de Elegibilidade**: Participantes com 3+ palestras
2. **Processo**: Sorteio sequencial do 8º ao 1º lugar
3. **Controle**: Sessão PHP evita repetições
4. **Finalização**: Automática após 8 sorteios

## 🎨 Interface

- **Tema**: Azul marinho com detalhes em branco
- **Layout**: Centralizado e responsivo
- **Elementos**: Formulários estilizados, botões interativos
- **Logos**: Exibição das imagens da URI e CIPA no sorteador
- **Responsivo**: Adaptável a diferentes tamanhos de tela

## 📊 Fluxo de Dados
```
Cadastro → participantes → primeiro_dia
                ↓
Outras palestras → tabelas específicas
                ↓
Contagem ≥ 3 → Elegível para sorteio
```

## 🔧 Manutenção

- Verificar conexão com banco regularmente
- Backup das tabelas antes de eventos
- Limpar sessões após sorteios finalizados
- Atualizar credenciais conforme necessário
