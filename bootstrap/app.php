<?php



$app->post("/", function(Request $request, Response $response, array $args)
{

    print_r($request->getParsedBody());
    exit();
    
})


