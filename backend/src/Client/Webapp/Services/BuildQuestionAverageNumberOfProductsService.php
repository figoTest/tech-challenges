<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\Services;

use IWD\JOBINTERVIEW\Client\Webapp\DTO\AggregateQuestionDetailsDto;

class BuildQuestionAverageNumberOfProductsService
{
    public function execute($newQuestionDetails, AggregateQuestionDetailsDto $oldQuestionDetails)
    {
        $questionDetails = new AggregateQuestionDetailsDto();
        $questionDetails->setType($newQuestionDetails->type);
        $questionDetails->setLabel($newQuestionDetails->label);
        $questionDetails->setOptions($newQuestionDetails->answer + $oldQuestionDetails->getOptions());
        return $questionDetails;
    }
}
