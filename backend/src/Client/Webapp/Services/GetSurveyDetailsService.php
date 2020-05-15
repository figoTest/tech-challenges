<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\Services;

use IWD\JOBINTERVIEW\Client\Webapp\Builder\SurveyDetailsBuilder;
use IWD\JOBINTERVIEW\Client\Webapp\Model\Survey;
use IWD\JOBINTERVIEW\Client\Webapp\Repository\SurveyRepository;

class GetSurveyDetailsService
{
    private $surveyRepository;

    public function __construct(SurveyRepository $surveyRepository)
    {
        $this->surveyRepository = $surveyRepository;
    }

    public function execute()
    {
        $surveyDetailsDtoList = [];
        $surveyList =  $this->surveyRepository->findDistinctSurvey();
        if (count($surveyList)) {
            foreach ($surveyList as $survey) {
                $surveyDetailsDtoList[] = $this->buildSurveyDetails($survey);
            }
        }
        return $surveyDetailsDtoList;
    }

    private function buildSurveyDetails(Survey $survey)
    {
        return (new SurveyDetailsBuilder())
            ->setName($survey->getName())
            ->setCode($survey->getCode())
            ->build();
    }
}
