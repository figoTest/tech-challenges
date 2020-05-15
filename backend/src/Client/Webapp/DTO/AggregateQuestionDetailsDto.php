<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\DTO;


class AggregateQuestionDetailsDto implements \JsonSerializable
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
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    public function jsonSerialize()
    {
        return [
            'type' => $this->getType(),
            'label' => $this->getLabel(),
            'options' => $this->getOptions()
        ];
    }
}