<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\Builder;

use IWD\JOBINTERVIEW\Client\Webapp\DTO\SurveyDetailsDto;

class SurveyDetailsBuilder
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $code;

    /**
     * @param string $name
     * @return SurveyDetailsBuilder
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $code
     * @return SurveyDetailsBuilder
     */
    public function setCode(string $code)
    {
        $this->code = $code;
        return $this;
    }

    public function build()
    {
        return new SurveyDetailsDto($this->name, $this->code);
    }
}