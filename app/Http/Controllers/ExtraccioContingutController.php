<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ExtraccioContingutController extends Controller
{
    /**
     * Executa l'arxiu Python d'extracció de contingut addicional.
     *
     * @return \Illuminate\Http\Response
     */
    public function executarScript()
    {
        // Executa l'arxiu Python utilitzant Symfony Process
        $process = new Process(['python', base_path('scripts/extraccio_contingut.py')]);

        try {
            $process->mustRun();

            // Obté la sortida del procés
            $output = $process->getOutput();

            return response()->json([
                'success' => true,
                'message' => 'L\'arxiu Python s\'ha executat correctament.',
                'output' => $output,
            ]);
        } catch (ProcessFailedException $exception) {
            // En cas d'error, obté el missatge d'error
            $error = $exception->getMessage();

            return response()->json([
                'success' => false,
                'message' => 'Hi ha hagut un error en executar l\'arxiu Python.',
                'error' => $error,
            ], 500);
        }
    }
}
