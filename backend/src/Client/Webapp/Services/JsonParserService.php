<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\Services;

use IWD\JOBINTERVIEW\Client\Webapp\Model\QuestionDetails;
use IWD\JOBINTERVIEW\Client\Webapp\Model\Survey;
use IWD\JOBINTERVIEW\Client\Webapp\Model\SurveyDetails;
use Symfony\Component\Finder\Finder;

class JsonParserService
{
    const DATA_FOLDER =  __DIR__.'/../../../../data/';

    public function __construct(){}

    public function execute()
    {
        $surveyList = [];
        $finder = new Finder();
        $finder->files()->in(self::DATA_FOLDER);

        if ($finder->hasResults()) {
            foreach ($finder as $file) {
                $json = json_decode(file_get_contents(self::DATA_FOLDER . $file->getRelativePathname()));
                $surveyDetails = $this->buildSurveyDetails($json->survey);
                $questionDetails = $this->buildQuestionDetails($json->questions);
                $surveyList[] = $this->buildSurvey($surveyDetails, $questionDetails);
            }
        }

        return $surveyList;
    }

    private function buildSurveyDetails( \stdClass $survey)
    {
        $surveyDetails = new SurveyDetails();
        $surveyDetails->setName($survey->name);
        $surveyDetails->setCode($survey->code);
        return $surveyDetails;
    }

    private function buildQuestionDetails(array $questions)
    {
        $questionDetailList = [];
        /** @var \stdClass $question */
        foreach ($questions as $question) {
            $questionDetail = new QuestionDetails();
            $questionDetail->setType($question->type);
            $questionDetail->setLabel($question->label);
            $questionDetail->setOptions($question->options);
            $questionDetail->setAnswer($question->answer);
            $questionDetailList[] = $questionDetail;
        }
        return $questionDetailList;
    }

    private function buildSurvey(SurveyDetails $surveyDetails, array $questionDetails)
    {
        $survey = new Survey();
        $survey->setSurveyDetails($surveyDetails);
        $survey->setQuestionDetails($questionDetails);
        return $survey;
    }
}
