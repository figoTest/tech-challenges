<?php
namespace IWD\JOBINTERVIEW\Client\Webapp\Resource;

use IWD\JOBINTERVIEW\Client\Webapp\Exceptions\SurveyNotFoundException;
use IWD\JOBINTERVIEW\Client\Webapp\Response\SurveyDetailsResponse;
use IWD\JOBINTERVIEW\Client\Webapp\Services\GetAggregateSurveyService;
use IWD\JOBINTERVIEW\Client\Webapp\Services\GetSurveyDetailsService;
use IWD\JOBINTERVIEW\Client\Webapp\Services\GetGroupedSurveyByCodeService;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyCollectionResource
{
    /**
     * @uri /surveys
     * @method GET
     * @accepts application/json
     * @param Application $application
     * @return SurveyDetailsResponse
     */
    public function getAllDistinct(Application $application)
    {
        $response = new SurveyDetailsResponse(Response::HTTP_OK);
        /** @var GetSurveyDetailsService $service */
        $service = $application['getSurveyDetailsService'];
        $surveyDetailsDto = $service->execute();
        $response->setData($surveyDetailsDto);
        return $response;
    }

    /**
     * @uri /surveys/{code}
     * @method GET
     * @accepts application/json
     * @param Request $request
     * @param Application $application
     * @return SurveyDetailsResponse
     */
    public function getGroupedByCode(Request $request, Application $application)
    {
        try {
            $response = new SurveyDetailsResponse(array("success" => true, "code" => Response::HTTP_OK), Response::HTTP_OK);
            /** @var GetGroupedSurveyByCodeService $service */
            $service = $application['getGroupedSurveyByCodeService'];
            $surveyDto = $service->execute($request->get('code'));
            $response->setData($surveyDto);
        } catch (SurveyNotFoundException $exception) {
            $response = new SurveyDetailsResponse(
                array("success" => false, "message" => $exception->getClientMessage(), "code" => Response::HTTP_NOT_FOUND),Response::HTTP_NOT_FOUND);
        }
        return $response;
    }

    /**
     * @uri /surveys/aggregate/{code}
     * @method GET
     * @accepts application/json
     * @param Request $request
     * @param Application $application
     * @return SurveyDetailsResponse
     */
    public function getAggregateByCode(Request $request, Application $application)
    {
        $response = new SurveyDetailsResponse(array("success" => true, "code" => Response::HTTP_OK), Response::HTTP_OK);
        try {
            /** @var GetAggregateSurveyService $service */
            $service = $application['getAggregateSurveyService'];
            $surveyDtoList = $service->execute($request->get('code'));
            $response->setData($surveyDtoList);
        } catch (SurveyNotFoundException $exception) {
            $response = new SurveyDetailsResponse(
                array("success" => false, "message" => $exception->getClientMessage(), "code" => Response::HTTP_NOT_FOUND),Response::HTTP_NOT_FOUND);
        }
        return $response;
    }
}