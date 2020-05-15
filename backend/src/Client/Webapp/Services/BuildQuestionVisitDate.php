<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\Services;

use IWD\JOBINTERVIEW\Client\Webapp\DTO\AggregateQuestionDetailsDto;

class BuildQuestionVisitDate
{
    public function execute($newQuestionDetails, AggregateQuestionDetailsDto $oldQuestionDetails)
    {
        $option  = $oldQuestionDetails->getOptions() != '' ? $oldQuestionDetails->getOptions() : [];
        array_push($option, $newQuestionDetails->answer);
        $questionDetails = new AggregateQuestionDetailsDto();
        $questionDetails->setType($newQuestionDetails->type);
        $questionDetails->setLabel($newQuestionDetails->label);
        $questionDetails->setOptions($option);
        return $questionDetails;
    }
}
