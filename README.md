# 🎬 CineCRM — Sistema de Gestão de Filmes e Estúdios

![Laravel](https://img.shields.io/badge/Laravel-11.x-red)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple)
![License](https://img.shields.io/badge/License-MIT-green)

## Sobre o Projeto

O **CineCRM** é uma aplicação web desenvolvida em Laravel para gestão e catalogação de filmes organizados por estúdios. Visitantes podem explorar o catálogo publicamente, utilizadores registados podem interagir com os conteúdos, e administradores têm controlo total sobre a plataforma.

---

## Funcionalidades

### Área Pública
- Listagem de estúdios com contagem automática de filmes associados
- Catálogo de filmes com capas, géneros e datas de lançamento
- Pesquisa por nome e filtros por género ou ordem alfabética
- Visualização de avaliações médias (1–5 estrelas) por filme

### Área de Utilizador
- Registo e login via Laravel Fortify
- Edição de perfil com upload de foto
- Edição de dados de filmes (conforme permissões do projeto)

### Painel Administrativo
- CRUD completo de Estúdios, Filmes e Utilizadores
- Dashboard com estatísticas gerais da plataforma
- Acesso protegido por Middleware (apenas utilizadores do tipo `1`)

---

## Tecnologias

| Camada | Tecnologia |
|---|---|
| Backend | Laravel 11 |
| Frontend | Bootstrap 5.3 + Bootstrap Icons |
| Base de dados | MySQL |
| Autenticação | Laravel Fortify |
| Tema | Dark mode personalizado (CSS puro) |

---

## Instalação

### Pré-requisitos
- PHP >= 8.2
- Composer
- MySQL
- Node.js (opcional, apenas se usares assets compilados)

### Passos

```bash
# 1. Clonar o repositório
git clone https://github.com/teu-utilizador/cinecrm.git
cd cinecrm

# 2. Instalar dependências PHP
composer install

# 3. Copiar e configurar o ficheiro de ambiente
cp .env.example .env
php artisan key:generate

# 4. Configurar a base de dados no .env
DB_DATABASE=cinecrm
DB_USERNAME=root
DB_PASSWORD=

# 5. Executar as migrações
php artisan migrate

# 6. (Opcional) Popular com dados de exemplo
php artisan db:seed

# 7. Criar o link para o storage
php artisan storage:link

# 8. Iniciar o servidor
php artisan serve
```

A aplicação estará disponível em `http://localhost:8000`.

---

## Estrutura de Utilizadores

| Tipo | Valor | Permissões |
|---|---|---|
| Administrador | `user_type = 1` | Acesso total ao painel admin |
| Utilizador normal | `user_type = 0` | Acesso à área pública e perfil |

---

## Licença

Distribuído sob a licença MIT. Consulta o ficheiro `LICENSE` para mais informações.
