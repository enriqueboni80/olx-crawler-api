# Web Crawler-API OLX

## Proposta

- Buscar informacoes de modelos específicos de carros na OLX e exibir resultados.
- Construir um crawler para buscar as informacoes na OLX.
- Persistir as informacoes.
- Fornecer estas informações para o frontend usando uma api (rest ou GraphQL).
- Se a mesma busca for realizada dentro de um periodo de x horas, deve-se retornar o resultado que foi persistido (cache).

## Configuracao do Ambiente

- PHP 7.4.7
- Nginx 1.18.0 (Nao necessario para rodar o projeto no ambinente de desenvolvimento local)
- <a href='https://docs.docker.com/get-docker/'>Docker</a>, caso deseje rodar aplicacao via containers. Veja topico 'Rodando em Containers (Docker)'
- Versao do projeto Laravel: 8.10.0


## Configuracao Padrao do Sistema

1. Clone o repositorio
2. Dentro da pasta raiz do projeto rode o comando:
```
composer install
```
3. Dentro da pasta raiz do projeto copie o arquivo [.env.example] e renomeie a copia para [.env]
4. Dentro da pasta raiz do projeto rode o comando:
```
php artisan key:generate
```
5. Crie o arquivo [database.sqlite] dentro da pasta [database/]
6. Dentro da pasta raiz do projeto rode o comando:
```
php artisan migrate
```
7. Dentro da pasta raiz do projeto rode o comando:
```
php artisan serve
```
8. Acesse a documentacao da API (Swagger) através da url: http://127.0.0.1:8000 ou http://localhost:8000/api/docs
9. Faca requisicoes na API livremente utilizando o Swagger (ou o Postman)

## Rodando em Containers (Docker)
1. Realize os mesmos passos da Configuracao padrao (acima) de 1 a 6
2. Dentro da pasta [docker/] rode o comando:
```
docker-compose build
```
3. Dentro da pasta [docker/] rode o comando:
```
docker-compose up -d
```
4. Acesse a documentacao da API (Swagger) atraves da url: http://127.0.0.1:8888 ou http://localhost:8888/api/docs --> obs: Atencao: nesse caso a porta é diferente da Configuracao Padrao!
5. Faca requisicoes na API livremente utilizando o Swagger (ou o Postman)


## Rotas

* Veja documentacao mais detalhada atraves do swagger: [api/docs]

#### [GET] api/v1/carros
Rota utilizada para buscar todos os carros crawleados.

#### [POST] api/v1/carros/pesquisar
Rota utilizada para buscar os carros de acordo com a pesquisa estabelecida

<pre>
Modelo da Requisicao:
{
  "modelo": "fiat",
  "municipio": "belo"
}
</pre>

## Sobre o Crawler na Olx:
* A qualquer momento pode-se atualizar a base-cache de carros através do comando `php artisan crawler:carros` (dentro da pasta raiz do projeto) --> obs: Para não sobrecarregar o sistema o default do crawler é 1 pagina (ou 50 carros).
* Se quiser crawlear mais paginas aumente a variavel $lastPage no arquivo [app/Console/Commands/CarroCrawler.php] e tambem aumente "max_execution_time" e "memory_limit" no php.ini

## Sobre os Testes Automatizados
* Tres casos de testes foram configurados e podem ser rodados através do comando:
```
php artisan test
```

## Agradecimentos
"Pois dele †, por ele e para ele são todas as coisas. A ele seja a glória para sempre! Amém. Romanos 11:36"
