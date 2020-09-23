<?php

declare(strict_types=1);

namespace Shopsys\HttpSmokeTesting\Test;

use Shopsys\HttpSmokeTesting\Annotation\DataSet;
use Shopsys\HttpSmokeTesting\Annotation\Parameter;
use Shopsys\HttpSmokeTesting\Annotation\Skipped;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    /**
     * @param string $name
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/hello/{name}")
     * @DataSet(parameters={
     *     @Parameter(name="name", value="Batman")
     * })
     * @DataSet(statusCode=404, parameters={
     *     @Parameter(name="name", value="World")
     * })
     */
    public function helloAction(string $name): Response
    {
        if ($name === 'Batman') {
            return new Response(sprintf('I am %1$s!', $name), 200);
        }
        return new Response('Nothing found.', 404);
    }

    /**
     * @param string $name
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/test")
     * @DataSet(parameters={
     *     @Parameter(name="myName", value="Batman")
     * })
     */
    public function testAction(string $name): Response
    {
        if ($name === 'Batman') {
            return new Response(sprintf('I am %1$s!', $name), 200);
        }
        return new Response('Nothing found.', 404);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/untested")
     * @Skipped()
     */
    public function untestedAction(): Response
    {
        return new Response('', 500);
    }
}
