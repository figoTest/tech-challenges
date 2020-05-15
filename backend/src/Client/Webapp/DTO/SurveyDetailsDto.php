<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\DTO;

class SurveyDetailsDto implements \JsonSerializable
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $code;

    public function __construct($name, $code)
    {
        $this->name = $name;
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->getName(),
            'code' => $this->getCode()
        ];
    }
}