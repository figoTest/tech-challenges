<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\Model;

class SurveyDetails
{
    /**
     * Name
     * @var string
     */
    private $name;

    /**
     * Code
     * @var string
     */
    private $code;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code)
    {
        $this->code = $code;
    }
}