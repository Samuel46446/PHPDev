<?php
class Session
{
    private int $id;
    private string $dateStart;
    private int $max;
    private array $participants;

    public function __construct(int $id = -1, string $dateStart = null, int $max = 0)
    {
        $this->id = $id;
        $this->dateStart = $dateStart;
        $this->max = $max;
        $this->participants = [];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDateStart(): string
    {
        return $this->dateStart;
    }

    public function getMax(): int
    {
        return $this->max;
    }

    public function getParticipants(): array
    {
        return $this->participants;
    }

    public function addParticipant(Participant $participant)
    {
        if(!$this->isFull())
        {
            $this->participants[] = $participant;
            if(count($this->participants) > 0)
            {
                $this->sortParticipantsByOldest();
            }
            echo "Participant ajouté avec succès ! \n";
        }
        else
        {
            echo "Session pleine ! \n";
        }
    }

    public function isFull()
    {
        return count($this->participants) == $this->max;
    }

    public function sortParticipantsByOldest(): void
    {
        $index=0;
        $max = 0;
        for($i= 0;$i<count(value: $this->participants); $i++)
        {
            if($this->participants[$i]->getOldest() > $max)
            {
                $max = $this->participants[$i]->getOldest();
                $index = $i;
            }
        }
        $aux = null;
        for($i= 0;$i<count(value: $this->participants); $i++)
        {
            if($aux != null)
            {
                    $this->participants[$i] = $aux;
                    $aux = $this->participants[$i];
            }

            if($i == $index)
            {
                    $aux = $this->participants[$i];
                    $this->participants[$i] = null;
            }
            $index++;
        }
    }
}
?>