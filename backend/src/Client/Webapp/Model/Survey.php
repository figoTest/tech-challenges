<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\Model;

class Survey
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
     * @return SurveyDetails
     */
    public function getSurveyDetails(): SurveyDetails
    {
        return $this->surveyDetails;
    }

    /**
     * @param SurveyDetails $surveyDetails
     */
    public function setSurveyDetails(SurveyDetails $surveyDetails)
    {
        $this->surveyDetails = $surveyDetails;
    }

    /**
     * @return QuestionDetails[]
     */
    public function getQuestionDetails(): array
    {
        return $this->questionDetails;
    }

    /**
     * @param QuestionDetails[] $questionDetails
     */
    public function setQuestionDetails(array $questionDetails)
    {
        $this->questionDetails = $questionDetails;
    }

    public function getName()
    {
        return $this->getSurveyDetails()->getName();
    }

    public function getCode()
    {
        return $this->getSurveyDetails()->getCode();
    }
}