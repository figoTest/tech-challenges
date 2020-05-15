<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\DTO;

class SurveyDto implements \JsonSerializable
{
    /**
     * Survey Details
     * @var SurveyDetailsDto
     */
    private $surveyDetails;

    /**
     * Question Details
     * @var QuestionDetailsDto[]
     */
    private $questionDetails;

    public function __construct($surveyDetails, $questionDetails)
    {
        $this->surveyDetails = $surveyDetails;
        $this->questionDetails = $questionDetails;
    }

    /**
     * @return SurveyDetailsDto
     */
    public function getSurveyDetails(): SurveyDetailsDto
    {
        return $this->surveyDetails;
    }

    /**
     * @return QuestionDetailsDto[]
     */
    public function getQuestionDetails(): array
    {
        return $this->questionDetails;
    }

    public function jsonSerialize()
    {
        return [
            'surveyDetails' => $this->getSurveyDetails(),
            'questionDetails' => $this->getQuestionDetails(),
        ];
    }
}