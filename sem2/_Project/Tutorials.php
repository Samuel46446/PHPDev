<?php

class Forge implements ITutorial
{
    private LoaderType $loaderType;

    public function __construct()
    {
        $this->loaderType = LoaderType::FORGE;
    }

    public function getLoader() : LoaderType
    {
        return $this->loaderType;
    }
}

class Fabric implements ITutorial
{
    private LoaderType $loaderType;

    public function __construct()
    {
        $this->loaderType = LoaderType::FABRIC;
    }

    public function getLoader() : LoaderType
    {
        return $this->loaderType;
    }
}

class NeoForge implements ITutorial
{
    private LoaderType $loaderType;

    public function __construct()
    {
        $this->loaderType = LoaderType::NEOFORGE;
    }

    public function getLoader() : LoaderType
    {
        return $this->loaderType;
    }
}

class Minecraft implements ITutorial
{
    private LoaderType $loaderType;

    public function __construct()
    {
        $this->loaderType = LoaderType::MINECRAFT;
    }

    public function getLoader() : LoaderType
    {
        return $this->loaderType;
    }
}

class Tutorials
{
    private array $tutorials;

    public function __construct()
    {
        $this->tutorials = array(
            new Forge(),
            new Fabric(),
            new NeoForge(),
            new Minecraft()
        );
    }

    public function getTutorials() : array
    {
        return $this->tutorials;
    }
}

?>