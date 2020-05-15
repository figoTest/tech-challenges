<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\Exceptions;

class SurveyNotFoundException extends \Exception implements ClientException
{
    protected $message;

    public function __construct($message)
    {
        parent::__construct($message);
        $this->message = $message;
    }

    public function getClientMessage()
    {
        return $this->message;
    }
}