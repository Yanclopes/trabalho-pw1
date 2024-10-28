# Projeto PHP com Estrutura MVC

Este projeto é uma aplicação web desenvolvida em PHP usando a estrutura MVC (Model-View-Controller). Ele roda em um ambiente Docker configurado com `docker-compose` para facilitar a inicialização e o gerenciamento das dependências. 

## Iniciando o Projeto

### Pré-requisitos
- Docker
- Docker Compose

### Passo a Passo para Inicialização
1. Inicie o ambiente Docker:
    ```bash
    docker-compose up -d
    ```

2. Rode as migrations usando o comando abaixo:
    ```bash
    docker-compose exec php php ./src/Migrations/runner/runner.php {nome da migration} {metodo}
    ```
    - **nome da migration**: Nome da migration a ser executada.
    - **metodo**: Método da migration a ser utilizado (exemplo: `up` para aplicar a migration ou `down` para revertê-la).

> **Nota**: Certifique-se de rodar o comando para cada migration necessária.

## Estrutura de Rotas

- **Usuário**: Acesse `http://localhost/question` para a seção de perguntas.
- **Admin**: Acesse `http://localhost/login` para a área administrativa.

> **Atenção**: É necessário configurar um usuário administrador no banco de dados, com a senha armazenada como um hash gerado pelo PHP. 

## Configuração de Usuário Administrador

1. Acesse o banco de dados da aplicação no container.
2. Crie um registro na tabela de usuários, definindo uma senha hash gerada pelo PHP. Exemplo:
    ```php
    password_hash('sua_senha', PASSWORD_DEFAULT);
    ```

    Utilize este valor como o hash da senha no banco de dados para o usuário admin.
