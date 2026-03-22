<p align="center">
    <h1 align="center">🎬 CineCRM - Sistema de Gestão de Filmes e Estúdios</h1>
</p>

<p align="center">
    <img src="https://img.shields.io/badge/Laravel-11.x-red" alt="Laravel Version">
    <img src="https://img.shields.io/badge/Bootstrap-5.3-purple" alt="Bootstrap Version">
    <img src="https://img.shields.io/badge/License-MIT-green" alt="License">
</p>

## 📝 Sobre o Projeto

O **CineCRM** é uma aplicação web desenvolvida em Laravel para a gestão e catalogação de filmes organizados por estúdios. O sistema permite que visitantes explorem o catálogo, enquanto utilizadores registados podem interagir com os conteúdos e administradores gerem toda a plataforma.

---

## 🚀 Funcionalidades Principais

### 🌐 Área Pública
- **Listagem de Estúdios:** Visualização de todos os estúdios registados com contagem automática de filmes.
- **Listagem de Filmes:** Catálogo completo com capas, géneros e datas de lançamento.
- **Filtros Avançados:** Pesquisa por nome e filtragem por género ou ordem alfabética.
- **Sistema de Reviews:** Visualização de médias de avaliação (1-5 estrelas) em cada filme.

### 🔐 Área de Utilizador (Autenticação Fortify)
- **Registo e Login:** Sistema seguro de acesso.
- **Gestão de Perfil:** Alteração de dados pessoais e upload de foto de perfil.
- **Edição de Conteúdo:** Utilizadores comuns podem editar dados de filmes (conforme requisitos do projeto).

### ⚡ Painel Administrativo (Backoffice)
- **Gestão CRUD:** Controlo total sobre Estúdios, Filmes e Utilizadores.
- **Estatísticas:** Dashboard com contagem total de registos.
- **Segurança:** Proteção por Middleware para garantir que apenas administradores (Tipo 1) acedem à gestão.

---

## 🛠️ Tecnologias Utilizadas

- **Backend:** [Laravel](https://laravel.com)
- **Frontend:** [Bootstrap 5](https://getbootstrap.com) (Substituindo o Tailwind padrão para maior agilidade no design UI)
- **Ícones:** [Bootstrap Icons](https://icons.getbootstrap.com)
- **Base de Dados:** MySQL
- **Autenticação:** Laravel Fortify

