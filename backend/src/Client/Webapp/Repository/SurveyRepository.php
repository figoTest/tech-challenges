<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\Repository;

use IWD\JOBINTERVIEW\Client\Webapp\Model\Survey;

interface SurveyRepository
{
    /**
     * @return Survey[]
     **/
    public function findDistinctSurvey();

    /**
     * @param $code
     * @return Survey[]
     */
    public function findGroupedByCode($code);
}