<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\DTO;

class SurveyAggregateDto implements \JsonSerializable
{
    /**
     * Survey Details
     * @var SurveyDetailsDto
     */
    private $surveyDetails;

    /**
     * Question Details
     * @var AggregateQuestionDetailsDto[]
     */
    private $questionDetails;

    /**
     * @return SurveyDetailsDto
     */
    public function getSurveyDetails(): SurveyDetailsDto
    {
        return $this->surveyDetails;
    }

    /**
     * @param SurveyDetailsDto $surveyDetails
     */
    public function setSurveyDetails(SurveyDetailsDto $surveyDetails)
    {
        $this->surveyDetails = $surveyDetails;
    }

    /**
     * @return AggregateQuestionDetailsDto[]
     */
    public function getQuestionDetails(): array
    {
        return $this->questionDetails;
    }

    /**
     * @param AggregateQuestionDetailsDto[] $questionDetails
     */
    public function setQuestionDetails(array $questionDetails)
    {
        $this->questionDetails = $questionDetails;
    }

    public function jsonSerialize()
    {
        return [
            'surveyDetails' => $this->getSurveyDetails(),
            'questionDetails' => $this->getQuestionDetails(),
        ];
    }
}