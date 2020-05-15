<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\Services;

use IWD\JOBINTERVIEW\Client\Webapp\DTO\AggregateQuestionDetailsDto;

class BuildQuestionTypeQcmService
{
    public function execute($newQuestionDetails, AggregateQuestionDetailsDto $oldQuestionDetails)
    {
        $questionDetails = new AggregateQuestionDetailsDto();
        $questionDetails->setType($newQuestionDetails->type);
        $questionDetails->setLabel($newQuestionDetails->label);
        $questionDetails->setOptions($this->buildAggregateOptions($newQuestionDetails, $oldQuestionDetails));
        return $questionDetails;
    }

    private function buildAggregateOptions($newQuestionDetails, AggregateQuestionDetailsDto $oldQuestionDetails)
    {
        $options = [];
        foreach ($newQuestionDetails->options as $option) {
            $options[$option]['true'] = $oldQuestionDetails->getOptions()[$option]['true'];
            $options[$option]['false'] = $oldQuestionDetails->getOptions()[$option]['false'];
        }
        foreach ($newQuestionDetails->options as $key => $option) {
            if ($newQuestionDetails->answer[$key] == 1) {
                $options[$option]['true'] = ++$oldQuestionDetails->getOptions()[$option]['true'];

            } else {
                $options[$option]['false'] = ++$oldQuestionDetails->getOptions()[$option]['false'];
            }
        }
        return $options;
    }
}
