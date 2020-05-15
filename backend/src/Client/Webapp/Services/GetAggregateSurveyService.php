<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\Services;

use Coach\File\Exceptions\ImportTargetOfflineEditingFileException;
use IWD\JOBINTERVIEW\Client\Webapp\DTO\AggregateQuestionDetailsDto;
use IWD\JOBINTERVIEW\Client\Webapp\DTO\SurveyAggregateDto;
use IWD\JOBINTERVIEW\Client\Webapp\Exceptions\SurveyNotFoundException;

class GetAggregateSurveyService
{
    const QT_QCM = 'qcm';
    const QT_NUMERIC = 'numeric';

    private $groupedSurveyByCodeService;
    private $buildQuestionTypeQcmService;
    private $averageNumberOfProductsService;
    private $questionVisitDateService;
    private $buildQcmAggregateQuestion;
    private $buildNumberOfProductsAggregateQuestion;
    private $buildVisitDateAggregateQuestion;

    public function __construct(
        GetGroupedSurveyByCodeService $groupedSurveyByCodeService,
        BuildQuestionTypeQcmService $buildQuestionTypeQcmService,
        BuildQuestionAverageNumberOfProductsService $averageNumberOfProductsService,
        BuildQuestionVisitDate $questionVisitDateService
    ) {
        $this->groupedSurveyByCodeService = $groupedSurveyByCodeService;
        $this->buildQuestionTypeQcmService = $buildQuestionTypeQcmService;
        $this->averageNumberOfProductsService = $averageNumberOfProductsService;
        $this->questionVisitDateService = $questionVisitDateService;
    }

    public function execute($surveyCode)
    {
        $groupedSurvey = $this->groupedSurveyByCodeService->execute($surveyCode);
        if ($groupedSurvey) {
            $response = new SurveyAggregateDto();
            $response->setSurveyDetails($groupedSurvey->getSurveyDetails());

            $this->buildQcmAggregateQuestion = new AggregateQuestionDetailsDto();;
            $this->buildNumberOfProductsAggregateQuestion = new AggregateQuestionDetailsDto();;
            $this->buildVisitDateAggregateQuestion = new AggregateQuestionDetailsDto();;

            $questions = 0;
            foreach ($groupedSurvey->getQuestionDetails() as $questionDetailTypes) {
                $this->buildAggregateQuestionByType($questionDetailTypes);
                ++$questions;
            }

            $this->buildNumberOfProductsAggregateQuestion->setOptions(
                ($this->buildNumberOfProductsAggregateQuestion->getOptions() / $questions)
            );

            $questionsDetails = [
                $this->buildQcmAggregateQuestion,
                $this->buildNumberOfProductsAggregateQuestion,
                $this->buildVisitDateAggregateQuestion
            ];

            $response->setQuestionDetails($questionsDetails);
            return $response->jsonSerialize();
        }
        throw new SurveyNotFoundException(
            sprintf('Survey with code %s not found.', $surveyCode)
        );
    }

    private function buildAggregateQuestionByType($questionDetailTypes)
    {
        foreach ($questionDetailTypes as $questionDetailType) {
            $questionDetailType = (object) $questionDetailType;
            if ($questionDetailType->type == self::QT_QCM) {
                $this->buildQcmAggregateQuestion = $this->buildQuestionTypeQcmService
                    ->execute($questionDetailType, $this->buildQcmAggregateQuestion);
            } elseif ($questionDetailType->type == self::QT_NUMERIC) {
                $this->buildNumberOfProductsAggregateQuestion = $this->averageNumberOfProductsService
                    ->execute($questionDetailType, $this->buildNumberOfProductsAggregateQuestion);
            } else {
                $this->buildVisitDateAggregateQuestion = $this->questionVisitDateService
                    ->execute($questionDetailType, $this->buildVisitDateAggregateQuestion);
            }
        }
    }
}
