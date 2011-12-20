# WebService do Sistema Aula

Este WebService foi criado para permitir aos clientes do Sistema Aula 
utilizarem o serviço de integração do Sistema Aula Desktop e SAWEE com o
Moodle.

O WebService do Moodle possui diversas funções, porem nem todas atendem 
completamente os requisitos para integração com sistemas gerenciais como
Sistema Aula. Buscando atender as demandas não supridas criamos novas 
funções que estão sendo disponibilizadas neste WebService conforme vão 
sendo liberadas e testadas.

# Como Colaborar com o projeto
Como o WebService do Sistema Aula é um produto OpenSource e distribuído 
conforme a licença GPL, você pode copia-lo e fazer suas alterações conforme
sua necessidade, porem lembre-se de citar a fonte do código original.

Você também pode se juntar a nos, trazendo seu conhecimento e suas 
necessidades. o projeto é totalmente aberto a colaboração de terceiros, se
você dá suporte a qualquer tipo de instituição de ensino que usa ou 
pretende usar o MOODLE, traga suas demandas e teremos o maior prazer em 
analisa-las para que possamos implementar tanto no WebService com no 
Sistema Aula.

Este WebService pode também vir a ser usado com outros aplicativos, se você
está desenvolvendo seus Scripts de manutenção do MOODLE, traga sua demanda
para conversarmos e vamos descobrir juntos uma forma de ampliar os serviços.

# Instalação
O processo de instalação do WebService do Sistema Aula é muito simples,
antes de tudo assegure-se que seu MOODLE está bem instalado e totalmente 
configurado.

## Ativando o WebService do Moodle
Não se esqueça que para usar este WebService você precisa ativar o 
WebService do Moodle na seção administrativa de seu Moodle no menu "Opções
Avançadas", mais especificamente "enablewebservices", use a caixa de 
pesquisa para encontrar rapidamente.

Tenha certeza que o protocolo desejado esteja ativo, como por exemplo o SOAP
nosso exemplos serão sempre baseados no SOAP para o PHP e Rest para VB.

## Fazendo Download da última versão do pacote
Em seguida, faça o Download do pacote da última versão estavel do WebService
do Sistema Aula no seguinte Link: https://github.com/SistemaAula/WebService-Moodle/downloads

Descompacte o arquivo que baixou e copie a pasta "local" para dentro de seu
ambiente moodle usando uma ferramenta de FTP, se baixou diretamente no 
Servidor, basta copiar esta pasta para o diretório de instalação de seu 
MOODLE.

_ATENÇÃO:  a estrutura deve ser mantida, este WebService funciona como um 
Plugin Local, para ser instalado corretamente deve existir dentro da pasta
"local" a pasta "sistemaaulaws" integralmente._

## Instalando o pacote baixado
Agora vá no menu "Avisos" na seção "Administração do site", o Moodle irá 
identificar automaticamente as novas funções do WebService e fará a 
instalação como qualquer outro Plugin/Extensão. Não deverá haver nenhuma
mensagem de erro.

## Criando o usuário de acesso ao serviço
Pronto, agora para usar o WebService do Sistema Aula, crie um Usuário 
chamado "WebService Sistema Aula" e de uma conta de e-mail a ele para que
possa gerir as mensagens do WebService quando esta precisarem ser enviadas 
pelo sistema de E-mail.

De a este usuário o direito de administrar o Site Moodle, você poderá usar
nesta versão (20111219xx.yy os números xx e yy podem variar) um usuário com 
direito de gerenciar cursos (manager), mas fique atento, a cada nova função 
adicionada em versões futuras, poderá ser preciso um usuário com 
habilidades/capabilities mais avançadas para que o WebService do Sistema
Aula funcione integralmente.

Agora atribua este usuário como um "Usuário Autorizado" ao Serviço externo 
de nome "Sistema Aula" no grupo de serviços "Build-in services" no Menu 
"Plugins", "Serviços da Web", "Serviços Externos" da seção de 
"Administração do Site".

ATENÇÃO: você poderá criar quantos usuários quiser, e poderá atribuir 
limitações especificas a cada um deles como por exemplo de qual IP podem
acessar o serviço.

## Criando o Token de acesso externo

Pronto estamos praticamente terminado, vamos criar um token para que possa
ser usado em aplicativos externos ao Moodle, este Token deverá ser criado
conforme qualquer serviço, permitindo o acesso com restrições de IP e
limite de tempo.

Vá em "Plugins", "Serviços da Web", "Manage tokens", na seção 
"Administração do site", clique no link "Acrescentar", selecione o usuário
desejado (lembre-se que deve ser o mesmo usuário que foi atribuído ao 
Serviço Externo), selecione o serviço, se desejar restringir por IP, 
digite o IP que terá acesso, e se desejar restringir um tempo determinado
o acesso, escolha uma data limite de acesso. Clique no botão 
"Salvar Mudanças"

Pronto, agora é so ativar o "Serviço Externo"

## Ativando o Serviço Externo
ATENÇÃO: ao termino das configurações lembre-se de ativar o Serviço externo 
de nome "Sistema Aula" no grupo de serviços "Build-in services" no Menu 
"Plugins", "Serviços da Web", "Serviços Externos" da seção de 
"Administração do Site". Para isto clique em editar na última coluna da 
linha do serviço, e marque a caixa "Ativado" e depois clique no botão
"Editar serviço".

# Acessando um Serviço disponibilizado pelo WebService do Sistema Aula
Todos os exemplos de consumo deste webservice podem ser encontrados na
pasta cliente deste projeto.

Lembre para testar as funções você deverá ajustar os parâmetros existente
no arquivo config.php na pasta cliente.

Você já deverá ter o serviço configurado e um token criado.

## Consumindo as funções para obtenção de notas

Veja detalhes no Link: https://github.com/SistemaAula/WebService-Moodle/blob/master/cliente/README.md
