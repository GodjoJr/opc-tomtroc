<?php
use ReflectionMethod;
abstract class ModelEntity 
{
    // Par défaut l'id vaut -1, ce qui permet de vérifier facilement si l'entité est nouvelle ou pas. 
    protected int $id = -1;

    /**
     * Constructeur de la classe.
     * Si un tableau associatif est passé en paramètre, on hydrate l'entité.
     * 
     * @param array $data
     */
    public function __construct(array $data = []) 
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * Système d'hydratation de l'entité.
     * Permet de transformer les données d'un tableau associatif.
     * Les noms de champs de la table doivent correspondre aux noms des attributs de l'entité.
     * Les underscore sont transformés en camelCase (ex: date_creation devient setDateCreation).
     * @return void
     */
    protected function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {

            // Ajoute le prefixe
            if (strpos($key, '_') !== false) {
                $keyParts = explode('_', $key, 2);
                $key = $keyParts[1] ?? $key;
            }
    
            // Transforme le nom en camelCase et ajoute le suffixe set
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));
    
            // Gestion de DateTime pour les champs createdAt et updatedAt
            if (method_exists($this, $method)) {
                if (in_array($key, ['createdAt', 'updatedAt'], true)) {
                    $value = new \DateTime($value);
                }
    
                $this->$method($value);
            }
        }
    }
    
    

    /** 
     * Setter pour l'id.
     * @param int $id
     * @return void
     */
    public function setId(int $id) : void 
    {
        $this->id = $id;
    }

    
    /**
     * Getter pour l'id.
     * @return int
     */
    public function getId() : int 
    {
        return $this->id;
    }
}