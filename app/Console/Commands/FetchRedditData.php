<?php

namespace App\Console\Commands;

use App\Models\Reddit;
use App\Models\Subreddit;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchRedditData extends Command
{
    /**
     * Este es el nombre del comando para ejecutar desde la consola
     *
     * @var string
     */
    protected $signature = 'app:fetch-reddit-data';

    /**
     * Descripción del comando para obtener los datos del api de reddit y guardarlo en la base de datos MySql
     *
     * @var string
     */
    protected $description = 'Comando para obtener y almacenar los datos del api de reddit en una base de datos MySql';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Trayendo datos del api de Reddit...');

        try {
            
            // Obtenemos la información de la Api
            $response = Http::get('https://www.reddit.com/reddits.json');

            // Se verifica que la api devuelva los datos
            if ( $response->successful() ) {
                
                // Se decodifica la respuesta en array asociativo
                $data = $response->json();

                // Ahora se recorre el array para empezar a guardar los datos en la base de datos
                foreach ( $data['data']['children'] as $item ) {
                    // Se obtiene la data del item
                    $redditData = $item['data']; 

                    // Se procede a guardar el Reddit principal
                    $reddit = Reddit::updateOrCreate(
                        ['name' => $redditData['name']],
                        [
                            'title' => $redditData['title'],
                            'image_url' => $redditData['icon_img']
                        ]
                    );
                    
                    // Se guarda el subreddit
                    Subreddit::updateOrCreate(
                        ['reddit_id' => $reddit->id, 'display_name' => $redditData['display_name']],
                        [
                            'header_img' => $redditData['header_img'] ?? '',
                            'banner_img' => $redditData['banner_img'] ?? '',
                            'submit_text_html' => $redditData['submit_text_html'] ?? '',
                            'subscribers' => $redditData['subscribers'] ?? 0
                        ]
                    );

                }

                $this->info('Los datos fueron obtenidos y guardados con éxito. ');

            }else {
                $this->error('No se pudieron obtener los datos, la api devolvio el error: ' . $response->status());
            }

        } catch (\Exception $e) {
            $this->error('A ocurrido un error: ' . $e->getMessage() );
        }
    }
}
