<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\Builder;

use IWD\JOBINTERVIEW\Client\Webapp\DTO\QuestionDetailsDto;
use IWD\JOBINTERVIEW\Client\Webapp\DTO\SurveyDetailsDto;
use IWD\JOBINTERVIEW\Client\Webapp\DTO\SurveyDto;
use IWD\JOBINTERVIEW\Client\Webapp\Model\QuestionDetails;
use IWD\JOBINTERVIEW\Client\Webapp\Model\SurveyDetails;

class SurveyBuilder
{
    /**
     * Survey Details
     * @var SurveyDetails
     */
    private $surveyDetails;

    /**
     * Question Details
     * @var QuestionDetails[]
     */
    private $questionDetails;

    /**
     * @param SurveyDetailsDto $surveyDetails
     * @return SurveyBuilder
     */
    public function setSurveyDetails(SurveyDetailsDto $surveyDetails)
    {
        $this->surveyDetails = $surveyDetails;
        return $this;
    }

    /**
     * @param QuestionDetailsDto[] $questionDetails
     * @return SurveyBuilder
     */
    public function setQuestionDetails(array $questionDetails)
    {
        $this->questionDetails = $questionDetails;
        return $this;
    }

    public function build()
    {
        return new SurveyDto($this->surveyDetails, $this->questionDetails);
    }
}