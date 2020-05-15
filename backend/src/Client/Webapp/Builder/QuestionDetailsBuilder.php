<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\Builder;

use IWD\JOBINTERVIEW\Client\Webapp\DTO\QuestionDetailsDto;

class QuestionDetailsBuilder
{
    /**
     * Type
     * @var string
     */
    private $type;

    /**
     * Label
     * @var string
     */
    private $label;

    /**
     * Options
     * @var mixed
     */
    private $options;

    /**
     * Answer
     * @var mixed
     */
    private $answer;

    /**
     * @param string $type
     * @return QuestionDetailsBuilder
     */
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string $label
     * @return QuestionDetailsBuilder
     */
    public function setLabel(string $label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @param mixed $options
     * @return QuestionDetailsBuilder
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @param mixed $answer
     * @return QuestionDetailsBuilder
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
        return $this;
    }

    public function build()
    {
        return new QuestionDetailsDto($this->type, $this->label, $this->options, $this->answer);
    }


}