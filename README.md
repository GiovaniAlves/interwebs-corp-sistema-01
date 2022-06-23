## <p align="center"> <i>Interwebs Corp - Sistema 01</i> </p>

### Passo a passo
#### Clone o Repositório
```
git clone https://github.com/GiovaniAlves/interwebs-corp-sistema-01.git
```
```
cd interwebs-corp-sistema-01/
```

#### Crie o Arquivo .env
```
cp .env.example .env
```

#### Atualize e adicione as duas últimas variáveis de ambiente no arquivo .env
```
APP_NAME=nome_da_aplicacao
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=nome_que_desejar_db
DB_USERNAME=root
DB_PASSWORD=root

URL_SYSTEM_02=url_da_segunda_aplicação

VUE_APP_SYSTEM_02_URL=url_da_segunda_aplicação
```

#### Instalar as dependências do projeto
```
composer install
```

#### Gerar a key do projeto Laravel
```
php artisan key:generate
```

#### Subir o servidor
```
php artisan serve
```

#### Compilar para desenvolvimento
```
npm run dev
```

#### Acesse o projeto em http://localhost:8000
