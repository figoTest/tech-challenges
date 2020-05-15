<?php
namespace IWD\JOBINTERVIEW\Tests\Utils\Repositories;

use IWD\JOBINTERVIEW\Client\Webapp\Repository\SurveyRepository;

class InMemorySurveyRepository implements SurveyRepository
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function findDistinctSurvey()
    {
        // TODO: Implement findDistinctSurvey() method.
    }

    public function findGroupedByCode($code)
    {
        // TODO: Implement findGroupedByCode() method.
    }
}