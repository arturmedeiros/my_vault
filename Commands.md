# Desenvolvendo Localmente
### Backend Laravel

---

#### Se não tiver as dependências locais instaladas

```shell
cd vault_backend
composer install
cp .env.example .env
```

#### Editar variáveis de ambiente ```.env```
```
# DATABASE
DB_DATABASE=<TABLE_NAME>
DB_USERNAME=<USER_NAME>
DB_PASSWORD=<USER_PASSWORD>
```

#### Se quiser criar um Super Usuário Inicialmente
````shell
php artisan migrate --seed
````

#### Rodando o Backend Localmente
```shell
cd vault_backend
php artisan serve
```


# Ambiente Docker

---

#### Buildar Containers
```shell
docker-compose build
```

#### Ativar Containers
```shell
docker-compose up
```

#### Ativar Containers [Modo Daemon]
```shell
docker-compose up -d
```

#### Buildar e Ativar Containers [Modo Daemon]
```shell
docker-compose up --build -d
```

#### Desativar Containers
```shell
docker-compose down 
```

#### Abrir Console do Container PHP
```shell
docker exec -it vault_backend sh
```

#### Baixar dependencias do Composer
```shell
docker exec vault_backend composer install
```

#### Key Generate e JWT Secret
```shell
docker exec vault_backend php artisan key:generate
docker exec vault_backend php artisan jwt:secret
```

#### Cria tabela de Jobs
```shell
docker exec vault_backend php artisan queue:table
docker exec vault_backend php artisan migrate --force
```

#### Cria do Link Simbólico para o Storage do Laravel
```shell
docker exec vault_backend php artisan storage:link
```

#### Ativar Supervisor (Queues do Laravel)
```shell
docker exec vault_backend supervisord -c /etc/supervisord.conf
```

#### Reiniciar Processos do Supervisor (Queues do Laravel)
```shell
docker exec vault_backend supervisorctl restart all
```

#### Reiniciar Grupo de Processos do Supervisor `(laravel-worker:*)`
```shell
docker exec vault_backend supervisorctl restart laravel-worker:*
```

#### Verificar Status dos Processos do Supervisor (Queues do Laravel)
```shell
docker exec vault_backend supervisorctl status
```

#### Rodando as Migrations no novo projeto
```shell
docker exec vault_backend php artisan migration
```

#### Rodando as Migrations com Seed de Super Usuário
```shell
docker exec vault_backend php artisan migration --seed
```

#### Iniciar tarefas Cron
```shell
docker exec vault_backend /usr/sbin/crond -l10
```
