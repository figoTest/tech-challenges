<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\Services;

use IWD\JOBINTERVIEW\Client\Webapp\Builder\QuestionDetailsBuilder;
use IWD\JOBINTERVIEW\Client\Webapp\Builder\SurveyBuilder;
use IWD\JOBINTERVIEW\Client\Webapp\Builder\SurveyDetailsBuilder;
use IWD\JOBINTERVIEW\Client\Webapp\Exceptions\SurveyNotFoundException;
use IWD\JOBINTERVIEW\Client\Webapp\Model\Survey;
use IWD\JOBINTERVIEW\Client\Webapp\Repository\SurveyRepository;

class GetGroupedSurveyByCodeService
{
    private $surveyRepository;

    public function __construct(SurveyRepository $surveyRepository)
    {
        $this->surveyRepository = $surveyRepository;
    }

    public function execute($surveyCode)
    {
        $surveyList = $this->surveyRepository->findGroupedByCode($surveyCode);
        if (count($surveyList)) {
            $surveyDetail = $this->buildSurveyDetails($surveyList[0]);
            $questionDetailList = [];
            foreach ($surveyList as $survey) {
                $questionDetailList[] = $this->buildQuestionsDetails($survey);
            }
            return (new SurveyBuilder())
                ->setSurveyDetails($surveyDetail)
                ->setQuestionDetails($questionDetailList)
                ->build();
        }
        throw new SurveyNotFoundException(
            sprintf('Survey with code %s not found.', $surveyCode)
        );
    }

    private function buildSurveyDetails(Survey $survey)
    {
        return (new SurveyDetailsBuilder())
            ->setName($survey->getName())
            ->setCode($survey->getCode())
            ->build();
    }

    private function buildQuestionsDetails(Survey $survey)
    {
        $questionList = [];
        foreach ($survey->getQuestionDetails() as $questionDetail) {
            $surveyDetailsDto = (new QuestionDetailsBuilder())
                ->setType($questionDetail->getType())
                ->setLabel($questionDetail->getLabel())
                ->setOptions($questionDetail->getOptions())
                ->setAnswer($questionDetail->getAnswer())
                ->build();
            $questionList[] = $surveyDetailsDto->jsonSerialize();
        }
        return $questionList;
    }
}
