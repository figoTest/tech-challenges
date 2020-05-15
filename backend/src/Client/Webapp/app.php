<?php
declare(strict_types=1);

if (file_exists(ROOT_PATH.'/vendor/autoload.php') === false) {
    echo "run this command first: composer install";
    exit();
}
require_once ROOT_PATH.'/vendor/autoload.php';

use IWD\JOBINTERVIEW\Client\Webapp\Services\BuildQuestionAverageNumberOfProductsService;
use IWD\JOBINTERVIEW\Client\Webapp\Services\BuildQuestionTypeQcmService;
use IWD\JOBINTERVIEW\Client\Webapp\Services\BuildQuestionVisitDate;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use IWD\JOBINTERVIEW\Client\Webapp\Repository\SurveyRepositoryImpl;
use IWD\JOBINTERVIEW\Client\Webapp\Services\GetAggregateSurveyService;
use IWD\JOBINTERVIEW\Client\Webapp\Services\GetSurveyDetailsService;
use IWD\JOBINTERVIEW\Client\Webapp\Services\GetGroupedSurveyByCodeService;
use IWD\JOBINTERVIEW\Client\Webapp\Services\JsonParserService;

const NOT_FOUND_SURVEY = "Not found survey";

$app = new Application();
$app['jsonParserService'] = $app->factory(function () {
    return new JsonParserService();
});
$app['getSurveyDetailsService'] = $app->factory(function ($app) {
    return new GetSurveyDetailsService(new SurveyRepositoryImpl($app['jsonParserService']));
});
$app['getGroupedSurveyByCodeService'] = $app->factory(function ($app) {
    return new GetGroupedSurveyByCodeService(new SurveyRepositoryImpl($app['jsonParserService']));
});
$app['getAggregateSurveyService'] = $app->factory(function ($app) {
    return new GetAggregateSurveyService(
        new GetGroupedSurveyByCodeService(new SurveyRepositoryImpl($app['jsonParserService'])),
        new BuildQuestionTypeQcmService(),
        new BuildQuestionAverageNumberOfProductsService(),
        new BuildQuestionVisitDate()
    );
});
$app->after(function (Request $request, Response $response) {
    $response->headers->set('Access-Control-Allow-Origin', '*');
});
$app->get('/', function () use ($app) {
    return 'Status OK';
});
$app->get('/surveys', 'IWD\JOBINTERVIEW\Client\Webapp\Resource\SurveyCollectionResource::getAllDistinct');
$app->get('/surveys/{code}', 'IWD\JOBINTERVIEW\Client\Webapp\Resource\SurveyCollectionResource::getGroupedByCode');
$app->get('/surveys/aggregate/{code}', 'IWD\JOBINTERVIEW\Client\Webapp\Resource\SurveyCollectionResource::getAggregateByCode');

$app->run();

return $app;
