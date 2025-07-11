<?php

namespace Core;

use Core\Database;

/**
 * Classe abstraite qui représente un modèle. Elle récupère automatiquement le gestionnaire de base de données. 
 */
abstract class ModelManager
{
    protected Database $db;

        /**
     * Constructeur de la classe.
     * Il récupère automatiquement l'instance de la classe Database. 
     */
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
}
