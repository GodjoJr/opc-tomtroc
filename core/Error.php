<?php
namespace Core;
class Error
{
    /**
     * Logs an error message into a file.
     * Errors are logged into the error.log file
     * which is located in the logs directory.
     *
     * @param string $message
     */
    public function __construct($message)
    {
        $logMessage = '[' . date('Y-m-d H:i:s') . "] $message\n";
        file_put_contents(ROOT_URL . '/logs/error.log', $logMessage, FILE_APPEND);
    }
}