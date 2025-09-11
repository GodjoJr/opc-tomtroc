<?php
namespace Core;
use ReflectionMethod;
abstract class ModelEntity
{
    // By default the id is set to -1, which makes it easy to check if the entity is new or not.
    protected int $id = -1;

    /**
     * Constructor of the class.
     * If an associative array is passed as a parameter, the entity is hydrated.
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
     * Entity hydration system.
     * Allows to transform data from an associative array.
     * Table field names must match the entity's attribute names.
     * Underscores are transformed into camelCase (e.g. date_creation becomes setDateCreation).
     * @return void
     */
    protected function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {

            // Add the prefix
            if (strpos($key, '_') !== false) {
                $keyParts = explode('_', $key, 2);
                $key = $keyParts[1] ?? $key;
            }

            // Transform the name into camelCase and add the set suffix
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));

            // DateTime management for createdAt and updatedAt fields
            if (method_exists($this, $method)) {
                if (in_array($key, ['createdAt', 'updatedAt'], true)) {
                    $value = new \DateTime($value);
                }

                $this->$method($value);
            }
        }
    }



    /** 
     * Setter for the id.
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * Getter for the id.
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}