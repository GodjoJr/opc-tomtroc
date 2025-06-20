<?php
namespace Core;
class Error
{
    /**
     * Enregistre un message d'erreur dans un fichier de log.
     * Les erreurs sont enregistrées dans le fichier error.log
     * qui se trouve dans le dossier logs.
     *
     * @param string $message
     */
    public function __construct($message)
    {
        $logMessage = '[' . date('Y-m-d H:i:s') . "] $message\n";
        file_put_contents(ROOT_URL . '/logs/error.log', $logMessage, FILE_APPEND);
    }
}