## Considerações Iniciais
Este CRUD foi feito com base na estrutura MVC, sem framework PHP

Ao descompactar, é necessário rodar o **composer** pra instalar as dependências e gerar o *autoload*.

Vá até a pasta do projeto, pelo *prompt/terminal* e execute:
> composer install

Depois é só aguardar.

## Configuração
Todos os arquivos de **configuração** e aplicação estão dentro da pasta *src*.

As configurações de Banco de Dados e URL estão no arquivo *src/Config.php*

É importante configurar corretamente a constante *BASE_DIR* seguido da pasta public, no exemplo de *localhost* a constante ficará assim:
> const BASE_DIR = '/localhost/public'; 

**NÃO SE ESQUECER DA PASTA PUBLIC**
> const BASE_DIR = '/**PastaDoProjeto**/public';

## Uso
Você deve acessar a pasta *public* do projeto.

O ideal é criar um ***alias*** específico no servidor que direcione diretamente para a pasta *public*.

OBS: Declado o nome da classe na Model com o mesmo nome da tabela, porém no *singular*
A Função **getTableName** na classe pai faz a associação à tabela no plural (acrescenta o 's' no final)
É recomendável alterar a variável na classe cujo plural não seja somente acrescentar um 's'. Ex: *jogadores*, ficaria assim:

```php
class Jogador extends Model {
    public function __construct() {
        parent::__construct();
        $this->tableName = 'jogadores';
    }
}
```

## CONTROLLER

Inicio um controller chamando sua Model específica no construtor da classe...

```php
<?php
namespace src\controllers;
use \core\Controller;
use \src\models\Classe;

class ClasseController extends Controller
{
    public $classe;

    public function __construct() {
        $this->classe = new Classe();
    }
}
?>
```

## SOBRE O PROJETO

Este projeto contém Bootstrap e jQuery, da qual utilizo AJAX para manipulação dos dados.

O Back-end foi feito como webservices, enviando para o front-end dados em json, da qual faço a manipulação via javascript.


## BANCO DE DADOS

O banco utilizado nesse projeto é um MySQL, o backup dele está contido no arquivo db.sql, que está na raiz do projeto.
O nome do banco é: "**TEST**", em caso de utilização de outro nome, o arquivo de alteração é "*src/Config.php*"

## ENVIO DE EMAILS

É possível enviar um relatório com dados específicos por email, de duas formas:
PHPMailer e mail().

Para alterar as configurações de envio do email através do PHPMailer basta ir para */src/controller/EmailController* e colocar as informações de envio de acordo com o servidor de email específico (Este está configurado para a hostgator em um email de teste).