<?php

namespace App\Console\Commands;

use Goutte\Client;
use App\Models\Carro;
use Illuminate\Console\Command;
use Symfony\Component\Console\Output\ConsoleOutput;

class CarrosCrawler extends Command
{
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:carros';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * URL do Crawler.
     *
     * @var string
     */
    private $GUESTURL = "https://mg.olx.com.br/autos-e-pecas/carros-vans-e-utilitarios/";
    

    /**
     * Objeto<array> Carro.
     *
     * @var array
     */
    private $carro = array();

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        $firstPage = 1;
        $lastPage = 1;

        $output = new ConsoleOutput();
        $output->writeln('');
        $output->writeln('Realizando Crawler de ' . $lastPage . ' pagina(s). Aguarde!');
        $output->writeln('* Se quiser crawlear mais paginas aumente a variavel $lastPage no arquivo "App\Console\Commands\CarroCrawler"');
        $output->writeln('* Tambem aumente "max_execution_time" e "memory_limit" no php.ini');

        Carro::truncate();

        $client = new Client();

        for ($page = $firstPage; $page <= $lastPage; $page++) {
            $firstNivelCrawler = $client->request('GET', $this->GUESTURL . '?o=' . $page);
            
            $firstNivelCrawler->filter('[data-lurker-detail="list_id"]')->each(function ($nodePaginas) {

                if (isset($nodePaginas)) {
                    $secondNivelClient = new Client();
                    $uriEspecificaDeCadaPagina = $nodePaginas->attr('href');
                    $secondNivelCrawler = $secondNivelClient->request('GET', $uriEspecificaDeCadaPagina);
                    $this->carro['url'] = $uriEspecificaDeCadaPagina;

                    $caracteristicas = $secondNivelCrawler->filter('[class="h3us20-5 hdKTOm"]');
                    if (isset($caracteristicas)) {
                        $caracteristicas->filter('[class="sc-hmzhuo eNZSNe sc-jTzLTM iwtnNi"]')->each(function ($nodeCaracteristicas) {
                            if (isset($nodeCaracteristicas)) {
                                $tipo = strtolower(str_replace(array(" ", "â", "ã", "ê", "í", "ç"), array("_", "a", "a", "e", "i", "c"), $nodeCaracteristicas->filter('span')->text()));
                                $this->carro[$tipo] = $nodeCaracteristicas->filter('span')->siblings()->text();
                            }
                        });
                    }

                    $localizacao = $secondNivelCrawler->filter('[class="h3us20-5 keidqa"]');
                    if (isset($localizacao)) {
                        $localizacao->filter('[class="sc-hmzhuo sc-1f2ug0x-3 ONRJp sc-jTzLTM iwtnNi"]')->each(function ($nodeLocalizacao) {
                            if (isset($nodeLocalizacao)) {
                                $tipo = strtolower(str_replace(array(" ", "â", "ã", "ê", "í", "ç"), array("_", "a", "a", "e", "i", "c"), $nodeLocalizacao->filter('dt')->text()));
                                $this->carro[$tipo] = $nodeLocalizacao->filter('dd')->text();
                            }
                        });
                    }


                    $preco = $secondNivelCrawler->filter('[class="sc-1leoitd-0 cIfjkh sc-ifAKCX cmFKIN"]')->text();
                    if (isset($preco)) {
                        $this->carro['preco'] = str_replace("R$ ", "", $preco);
                    }


                    $descricao = $secondNivelCrawler->filterXpath('//meta[@property="og:description"]')->attr('content');
                    if(isset($descricao)){
                        $this->carro['descricao'] = $descricao;
                    }
                    
                    $carro = Carro::create($this->carro);
                    $carro->save();
                }

                /* print_r($this->carro); */
            });
        };
        $output->writeln('Crawler Finalizado');
    }
}
