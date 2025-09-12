<?php
class Collection
{
    private array $collection; // Le tableau de la collection
    private string $type;

    /* Constructeur */
    public function __construct(string $type)
    {
        $this->type = $type;
        $this->collection = [];
    }

    public function getCollection()
    {
        return $this->collection;
    }

    /* Renvoie la taille de la liste */
    public function size()
    {
        return count($this->collection);
    }

    /* Vérifie si un objet existe */
    public function exist($object)
    {
        foreach($this->collection as $s) {
            if($s == $object)
            {
                return true;
            }
        }
        return false;
    }

    /* Retourne l'index correspondant à l'objet */
    public function getId($object)
    {
        for($i = 0; $i < count($this->collection); $i++)
        {
            if($this->collection[$i] == $object)
            {
                return $i;
            }
        }
        return 0;
    }

    /* Retourne l'objet correspondant à l'index */
    public function getObject(int $index)
    {
        return $this->collection[$index] ?? null;
    }

    /* Remplace un élément de la collection */
    public function replace(int $index, $object)
    {
        $this->collection[$index] = $object;
    }

    /* Ajoute un élément à la collection */
    public function add($object)
    {
        $this->collection[] = $object;
    }

    /* Deplace un élément 
    * ex: je veut placer un chiffre 2 à un emplacement ou il y avait un 60
    * alors je vais prendre le 60 et le mettre dans une variable intermédiaire pour le
    * déplacer à gauche ça donne : [2,60]
    */
    public function deplace(int $index, $object)
    {
        $aux = null;
        if($this->exist($this->collection[$index]))
        {
            for($i= 0;$i<count($this->collection); $i++)
            {
                if($aux != null)
                {
                    $this->collection[$i] = $aux;
                    $aux = $this->collection[$i];
                }

                if($i == $index)
                {
                    $aux = $this->collection[$i];
                    $this->collection[$i] = $object;
                }
            }
        }
    }


    /* Supprime un élément de la collection */
    public function remove(int $index)
    {
        if($this->exist($this->collection[$index]))
        {
            for($i= 0;$i<count($this->collection); $i++)
            {
                if($index == $i)
                {
                    $this->collection[$i] = null; // Mettre à null la case
                    for($j = $i;$j<count($this->collection); $j++)
                    {
                        // Remplacer les cases actuelle par les suivantes
                        if($this->collection[$j] == null && $j+1 != count($this->collection))
                        {
                            $this->collection[$j] = $this->collection[$j+1];
                            // [E1, E2, E3] -> [E1, null, E3] -> [E1, E3, null]
                            //  0   1   2       0    1     2      0    1   2
                        }
                    }
                    unset($this->collection[count($this->collection)-1]);
                    // unset supprime la dernière valeur du tableau
                    // cela permet de ne pas avoir de trou
                    // dans le précédent exemple la valeur 1 ne pourrais plus être accessible
                    break; // Casser la boucle
                }
            }
        }
    }
}
?>