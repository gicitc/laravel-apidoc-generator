<?php

namespace Gicitc\ApiDoc\Tests\Unit;

use Illuminate\Routing\Route;
use Gicitc\ApiDoc\Tests\Fixtures\TestController;
use Gicitc\ApiDoc\ApiDocGeneratorServiceProvider;
use Illuminate\Support\Facades\Route as RouteFacade;

class LaravelGeneratorTest extends GeneratorTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ApiDocGeneratorServiceProvider::class,
        ];
    }

    public function createRoute(string $httpMethod, string $path, string $controllerMethod, $register = false)
    {
        if ($register) {
            return RouteFacade::{$httpMethod}($path, TestController::class."@$controllerMethod");
        } else {
            return new Route([$httpMethod], $path, ['uses' => TestController::class."@$controllerMethod"]);
        }
    }

    public function createRouteUsesArray(string $httpMethod, string $path, string $controllerMethod, $register = false)
    {
        if ($register) {
            return RouteFacade::{$httpMethod}($path, TestController::class."@$controllerMethod");
        } else {
            return new Route([$httpMethod], $path, ['uses' => [TestController::class, $controllerMethod]]);
        }
    }
}
