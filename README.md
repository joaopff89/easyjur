## Objetivos

- Esta aplicação visa disponibilizar um web site onde os usuários possam fazer o cadastro/login e inserir dicas específicas de veículos por tipo (Moto, Carro ou Caminhão) e incluir marca, modelo e versão. Informar a versão do veículo é **opcional**.

- Disponibilizar também uma api onde seja possível um usuário já cadastrado realizar as seguintes ações:
	- Obter registros de dicas cadastradas.
	- Obter um registro de dica pelo Id.
	- Realizar o registro de uma nova dica.
	- Atualizar um registro de dica já cadastrada.
	- Deletar um registro de dica cadastrada.
<br/><br/>

#### Telas

- **Cadastro de usuário**
- **Login**

- ** index** - será listado um grid com as dicas cadastradas com possibilidade de filtro por tipo, marca, modelo e versão. Trazendo as dicas de **todos os usuários**.
- **home** - será listado um grid com as dicas cadastradas **pelo usuário logado** com possibilidade de filtro por tipo, marca, modelo e versão.  E os Botões para **criar, editar e excluir** uma dica.
<br/><br/>

#### API

Foi Utilizado o Postman para documentar a api, e o json para recuperar a collection pode ser acessada através deste link -> **[collection](https://www.getpostman.com/collections/f12b34a5b5a5fd79aa09")**
<br/><br/>

#### Considerações gerais

Para o desenvolvimento do projeto foi utilizado como principais tecnologias:
- PHP 7.4
- Laravel 8.75
- Vue.js 2.6.12
- Bootstrap 5.1.3
<br/><br/>

#### O que foi feito

- As tabelas do banco de dados foram definidas utilizando 'Migration'.
- Utilizado 'seeders' para popular o banco de dados e 'Factory' para gerar os dados aleatoriamente.
- Utilizado o conceito de 'Repository Pattern' para criar mais uma camada de abstração entre os 'controlers' e os 'Models', encapsulando toda a lógica de acesso a dados.
- Utilizado o recurso 'Form Request Validation' do laravel que encapsula toda a lógica de validação e autorização de solicitações HTTP com formulários.
- Utilizado o pacote 'tymon/jwt-auth' para fazer o gerenciamento de autenticação das APIs via Token.
- Utilizado o pacote 'laravel/ui' para instalação das dependências vue e bootstrap para a construção do frontend.