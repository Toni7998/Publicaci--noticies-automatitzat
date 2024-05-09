<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WordPressController extends Controller
{
    /**
     * Crea una entrada de blog en WordPress a través de la API REST.
     *
     * @param string $titol El título de la entrada del blog.
     * @param string $contingut El contenido de la entrada del blog.
     * @return string Un mensaje indicando si la entrada del blog se creó con éxito o si hubo un error.
     */
    public function crearEntradaBlog($titol, $contingut)
    {
        try {

            // Crea un nuevo cliente Guzzle con la URL base de la API REST de WordPress
            $client = new Client(['base_uri' => 'https://exemple.com/wp-json/wp/v2/']);

            // Utiliza la biblioteca Guzzle para hacer una petición POST a la API REST de WordPress para crear una entrada de blog
            $response = $client->post('posts', [

                // Autenticación básica de WordPress: usuario y contraseña
                'auth' => ['usuari', 'contrasenya'], 
                'form_params' => [
                    'title' => $titol, // El título de la entrada del blog
                    'content' => $contingut, // El contenido de la entrada del blog
                    'status' => 'publish' // Publica la entrada inmediatamente
                ]
            ]);

            // Si la petición fue exitosa, devuelve un mensaje de éxito
            return "Entrada de blog creada con éxito.";
        } catch (\Exception $e) {
            // Si hubo un error, captura la excepción y devuelve un mensaje de error
            return "Error al crear la entrada de blog: " . $e->getMessage();
        }
    }
    
}