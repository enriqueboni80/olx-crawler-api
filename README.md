# Web Crawler OLX-API

## Proposta

- Buscar informacoes de modelos específicos de carros na OLX e exibir resultados.
- Construir um crawler para buscar as informacoes na OLX.
- Persistir as informacoes.
- Fornecer estas informações para o frontend usando uma api (rest ou GraphQL).
- Se a mesma busca for realizada dentro de um periodo de x horas, deve-se retornar o resultado que foi persistido (cache).

## Configuracao do Ambiente

- PHP 7.4.7
- Laravel 8.10.0
- Docker [https://docs.docker.com/get-docker/] caso deseje rodar aplicacao via containers


## Configuracao Padrao do Sistema

1. Clone o repositorio
2. Abra o terminal de comandos e rode o comando:
```
composer install
```
3. Copie o arquivo [.env.example] e renomeie a copia para [.env]
4. Rode o comando:
```
php artisan key:generate
```
5. Crie o arquivo [database.sqlite] dentro da pasta [App\database]
6. Rode o comando:
```
php artisan migrate
```
7. Rode o comando:
```
php artisan serve
```
8. Acesse o Swagger através da  url: http://127.0.0.1:8000 ou http://localhost:8000/api/docs
9. Veja documentacao e faca requisicoes da API via Swagger

## Rodando em Containers (Docker)
1. Repita os passos da Configuracao padrao (acima) de 1 a 6
2. Acesse a pasta docker (cd docker)
3. Rode o comando:
```
docker-compose build
```
4. Rode o comando:
```
docker-compose up -d
```
5. Acesse o Swagger atraves da  url: http://127.0.0.1:8888 (ou http://localhost:8888/api/docs) - Atencao que nesse caso a porta é diferente da Configuracao Padrao!
6. Veja documentacaoo e faca eequisicees da API via Swagger

## Observacoes Importantes:
* Voce pode utilizar o proprio swagger ou o postman para fazer a requisicoes


## Rotas

### [GET] api/v1/carros
Rota utilizada para buscar todos os carros crawleados.

### [POST] api/v1/carros/pesquisar
Rota utilizada para buscar os carros de acordo com a pesquisa estabelecida

* veja documentacao mais detalhada atraves do swagger: [http://url/api/docs]


## Sobre o Crawler na Olx:
* A qualquer momento pode-se atualizar a base-cache de carros através do comando [php artisan crawler:carros] - Para não sobrecarregar o sistema o default do crawler é 1 pagina (ou 50 carros).
* Se quiser crawlear mais paginas aumente a variavel $lastPage no arquivo [App\Console\Commands\CarroCrawler] e tambem aumente "max_execution_time" e "memory_limit" no php.ini

## Sobre os teste
* Tres casos de testes foram configurados e podem ser rodados através do comando:
```
php artisan test
```

## Agradecimentos
A Deus e a minha familia 
