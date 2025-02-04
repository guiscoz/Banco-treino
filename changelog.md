# Changelog

Este arquivo é responsável por registrar cada alteração do projeto Banco Treino

## 14/06/2022

Foi dado seu primeiro commit contando uma migration para contas bancárias, um modelo, um controller e suas views para realizar o cadastro dessas contas.

## 27/06/2022

Foi criada uma nova view para realizar upload de arquivos. Um seeder para gerar um usuário no banco de dados e um factory para gerar 5 contas bancárias. Um arquivo de componente para o header.
Além disso, a função de cadastro do BankController impede que um usuário crie mais de uma conta no mesmo banco.

## 08/07/2022

Foi aplicado o sistema de permissões do Spatie onde somente usuários de determinado perfis podem fazer algo. 
Novos controllers foram adicionados para que cada um deles sirva de gerencimento de cada item: arquivos, contas bancárias, usuários, perfis, permissões e um HomeController que apenas armazena a rota da página inicial e dashboard.

## 13/07/2022

Foi criado dois arquivos de request para validar os dados das conta bancárias e arquivos antes de enviar para o banco de dados.

## 21/07/2022

Foi criado o arquivo LimitRequest que permite definir o limite de usuários que irão aparecer na página index de usuários. Na mesma view foi adicionada uma div para lista expor cada erro que ocorre durante as requisições.
Na página inicial recebeu um espaço onde o usuário pode digitar um CEP válido e verá seu endereço completo.

## 27/07/2022

Foram feitos alguns ajustes na função de mostrar o endereço de um CEP para melhorar a parte visual

## 15/08/2022

Foi criado a logo do projeto que será usado no header e está armazenado na pasta resource. Depos foi feito ajustes dos códigos já existente para deixa-los mais organizados.

## 19/08/2022

Foi adicionado o AccountDisplayController para exibir todos os usuários junto com suas contas bancárias. Com isso foi necessário criar uma view para esta exibição e uma nova permissão de gerenciar usuários. Houve a tentativa de usuar o jquery para mostrar os usuários junto com suas contas, mas não funcionou.

## 22/08/2022

Houve a descisão de usar javascript puro para realizar a exibição de usuários e suas conta bancárias em vez do jquery.

## 26/08/2022

Foi criado uma tabela de geolocalização no banco de dados para que o usuário puder ver detalhes de onde se localiza como sua altitude e longitude. Houve a necessidade um LocationController junto com sua model e um arquivo de view para realizar a consulta.
O AccountDisplayController recebeu uma função para remover a conta bancária de qualquer usuário do banco de dados. Outros arquivos sofreram alguns ajustes no seu código por questão de organização.

## 29/08/2022

Nos códigos de upload de arquivos foi alterado o diretório de onde eles serão armazenados.

## 06/09/2022

Foi aplicado a paginação na página index de usuários.

## 15/05/2024

Agora o arquivo README.md explica o que é o projeto Banco Treino e como excuta-lo. 

## 20/05/2024

Teve uma correção no arquivo README.md e uns ajustes na view de location e da páginial para deixar o código mais organizado.

## 22/01/2025

Agora é possível executar o projeto usando o Docker e também foi gerado este arquivo de changelog para registrar cada atualização do projeto.

## 04/02/2025

O ambiente Docker passou a ser definido pelo recurso Sail do Laravel devido aos problemas de conexão do container de php com o do MySQL que haviam anteriormente.