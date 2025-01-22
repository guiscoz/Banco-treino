# Projeto

Banco Treino é o meu primeiro projeto criado no Laravel. Esta é uma plataforma que permite o usuário gerenciar suas contas bancárias e realizar as seguintes:


- Cadastrar suas contas bancárias
- Realizar saque ou depósito
- Apagar suas contas bancárias
- Fazer upload de um arquivo txt ou png
- Gravar sua localização


Sua autenticação é realizada pelo pacote JetStream do Composer. Há um sistema de permissões gerado pelo Spatie que permite somente usuários de um perfil específico à realizar determinadas ações. Ao executar o projeto na sua máquina, será gerado um Super Admin cujos os dados serão definidos nas variáveis de ambiente. Este usuário vai ter todas as permissões, inclusive quais perfis cada usuário vai ter e qual permissão cada perfil vai ter.
Na página inicial, qualquer usuário pode obter um endereço. Caso você estiver logado com a conta do Super Admin, será possível alterar dados de outros usuários.


# Ao clonar o repositório

Agora será dados as instruções do que deve ser feito para esta plataforma rodar na sua máquina após clonar o repositório

## Instalações

Será necessário ter instalar o php, MySQL, composer, apache e o ngnix. Você também pode instalar o Laragon que vai instalar o apache e o nginx para você e executará eles quando o Laragon for ativado.

## Variáveis de ambiente

Agora deve criar o arquivo '.env' usando o '.env.example' como base para armazenar as variáveis de ambientes. Ambos os arquivos ficarão na mesma pasta. Pode todo o conteúdo do exemplo para o arquivo final, só será necessário alterar essas linhas:


```
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=SUA_SENHA_MYSQL

ADMIN_EMAIL=EMAIL_DO_ADMINISTRADOR
ADMIN_PASSWORD=SENHA_DO_ADMINISTRADOR
```


No DB_DATABASE vai ser inserido o nome do banco de dados do MySQL que será utilizado.
DB_USERNAME é o seu nome de usuário do MySQL que por padrão é root, mas o seu caso pode ser diferente.
DB_PASSWORD vai receber sua senha do MySQL. Caso não tiver uma, pode deixar vazio.


ADMIN_EMAIL contém o email do Super Admin que terá todas as permissões e todos os perfis do sistema
ADMIN_PASSWORD vai receber sua senha
Os demais campos do '.env' você altera se quiser.


## Comandos do terminal

Primeiramente é preciso instalar o pacote do composer e do npm, já que seus arquivos não vem junto com o repositório e podem estar sempre precisando de atualizações. Para instalar os pacotes, basta executar estes comandos:

```
composer install
npm install
```


Agora preciso gerar as tabelas de dados em seu banco. Aqui também será gerado o usuário Super Admin, para isso use o comando:
```
php artisan migrate
```


Depois disso será necessários gerar os dados dentro do arquivo de seeders, dentro dele está uma lista de perfis e permissões que será necessário para a plataforma. Basta user o comando:
```
php artisan db:seed
```


Talvez seja necessário uma chave de aplicação (Application Key). Para resolver o problema basta utilizar este comando no terminal:
```
php artisan key:generate
```


## Docker


Caso você tenha apenas o Docker instalado na sua máquina, isso é o suficiente para executar o projeto. Basta executar os seguintes comandos no terminal:


Construção de ambiente que irá gerar dois containers. Um para o laravel e outro do mysql.
```
docker-compose build
```


Subir os containers.
```
docker-compose up -d
```


Entrar no container da aplicação:
```
docker exec -it banco_treino-app bash
```


Depois disso você pode começar a usar os comandos do php e artisan mencionados neste arquivo anteriormente para executar o projeto.