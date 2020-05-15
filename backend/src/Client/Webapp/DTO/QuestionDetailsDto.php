<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\DTO;

class QuestionDetailsDto implements \JsonSerializable
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

    public function __construct($type, $label, $options, $answer)
    {
        $this->type = $type;
        $this->label = $label;
        $this->options = $options;
        $this->answer = $answer;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @return mixed
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    public function jsonSerialize()
    {
        return [
            'type' => $this->getType(),
            'label' => $this->getLabel(),
            'options' => $this->getOptions(),
            'answer' => $this->getAnswer()
        ];
    }
}