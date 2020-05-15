<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\Repository;

use IWD\JOBINTERVIEW\Client\Webapp\Model\Survey;
use IWD\JOBINTERVIEW\Client\Webapp\Services\JsonParserService;
use IWD\JOBINTERVIEW\Client\Webapp\Utils\StringUtils;

class SurveyRepositoryImpl implements SurveyRepository
{
    protected $data;

    public function __construct(JsonParserService $data)
    {
        $this->data = $data->execute();
    }

    public function findDistinctSurvey()
    {
        $surveyList = [];
        $foundSurveyCodes = [];
        /** @var Survey $survey */
        foreach ($this->data as $survey) {
            if (!in_array($survey->getCode(), $foundSurveyCodes)) {
                $surveyList[] = $survey;
                $foundSurveyCodes[] = $survey->getCode();
            }
        }
        return $surveyList;
    }

    public function findGroupedByCode($code)
    {
        $surveyList = [];
        /** @var Survey $survey */
        foreach ($this->data as $survey) {
            if (StringUtils::_toLowerCase($survey->getCode()) == StringUtils::_toLowerCase($code)) {
                $surveyList[] = $survey;
            }
        }
        return $surveyList;
    }
}