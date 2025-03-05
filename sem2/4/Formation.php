<?php
class Formation
{
    private string $code;
    private string $description;
    private int $nbDays;
    private array $registred;
    private array $sessions;

    public function __construct(string $code, string $description, int $nbDays/*, array $registred, array $sessions*/)
    {
        $this->code = $code;
        $this->description = $description;
        $this->nbDays = $nbDays;
        // $this->registred = $registred;
        // $this->sessions = $sessions;
        $this->registred = [];
        $this->sessions = [];
    }

    public function affectSessions(Session $session): void
    {
        $this->sessions[] = $session;
    }

    public function affectParticipants(): void
    {
        for($i = 0; $i < count($this->registred); $i++)
        {
            for($j = 0; $j < count($this->sessions); $j++)
            {
                echo "Entrez le nom, le prenom et l'age du participant : \n";
                $name = trim(string: fgets(STDIN));
                $surname = trim(fgets(STDIN));
                $oldest = trim(fgets(STDIN));
                $this->registred[$i]->getSessionChoice($j)->addParticipant(new Participant($name, $surname, $oldest, new Session()));
                break;
            }
        }


        /*$choix = -1;
        do {
            $choix = trim(fgets(STDIN));
            echo "Bienvennue dans Formation : \n";
            echo "1. Affecter les participants \n";
            echo "2. Affecter les sessions \n";
            echo "3. Affecter les participants aux sessions \n";
            echo "4. Afficher les participants et les sessions\n";
            echo "5. Affecter les Sessions actuels\n";
            echo "6. Quitter \n";
            switch($choix)
            {
                case 1: // Affecter les participants
                    $m = 'O';
                    do {
                    } while($m != 'N');
                    break;
                case 2: // Affecter les sessions
                    $m = 'O';
                    do {
                        echo "Entrez l'id, la date et le nombre max de participants de la session : \n";
                        $id = trim(fgets(STDIN));
                        $date = trim(fgets(STDIN));
                        $max = trim(fgets(STDIN));
                        $this->sessions[] = new Session($id, $date, $max);
                        echo "Voulez vous affecter une session ? (O/N) \n";
                        $m = trim(fgets(stream: STDIN));
                    } while($m != 'N');
                    break;
                case 3: // Affecter les participants aux sessions
                    $m = '';
                    for( $i = 0; $i < count(value: $this->registred); $i++)
                    {
                        for( $j = 0; $j < count($this->sessions); $j++)
                        {
                            echo "Voulez vous affectez " . $this->registred[$i]->getName() . " " . 
                            $this->registred[$i]->getSurname() . " à la session " . $this->sessions[$j]->getId() . 
                            " ? (O/N) \n";
                            $m = trim(fgets(stream: STDIN));

                            if($m == 'O')
                            {
                                $this->sessions[$j]->addParticipant($this->registred[$i]);
                                $this->registred[$i]->setSession($this->sessions[$j]);
                            }
                            else {
                                echo "Participant non affecté ! \n";
                            }
                        }
                    }            
                    break;
                case 4:
                    for( $i = 0; $i < count(value: $this->registred); $i++)
                    {
                        echo "". $this->registred[$i]->getName() . " " . $this->registred[$i]->getSurname() . " : \n";
                        for( $j = 0; $j < count($this->sessions); $j++)
                        {
                            echo "". $this->sessions[$j]->getId() . " " . $this->sessions[$j]->getDateStart() . " : \n";
                        }
                    }
                    break;
                case 5:
                    for( $i = 0; $i < count(value: $this->registred); $i++)
                    {
                        for( $j = 0; $j < count($this->sessions); $j++)
                        {
                            echo "Voulez vous affectez " . $this->registred[$i]->getName() . " " . 
                            $this->registred[$i]->getSurname() . " à la session " .
                            $this->sessions[$j]->getId() . " ? (O/N) \n";
                            $this->registred[$i]->setSession($this->sessions[$j]);
                        }
                    }
                    break;
                case 6:
                    echo "Au revoir ! \n";
                    break;
            }
        } while($choix != 6);*/
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getNbDays(): int
    {
        return $this->nbDays;
    }

    public function getRegistred(): array
    {
        return $this->registred;
    }

    public function getSessions(): array
    {
        return $this->sessions;
    }
}
?>