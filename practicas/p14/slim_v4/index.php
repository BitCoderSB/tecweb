<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();


$app->setBasePath('/p14/slim_v4');


/*
 * 1) GET /
 */
$app->get('/', function (Request $request, Response $response) {
    $data = ['mensaje' => 'Hola mundo desde Slim v4'];
    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json');
});

/*
 * 2) GET /hola/{nombre}
 */
$app->get('/hola/{nombre}', function (Request $request, Response $response, $args) {
    $nombre = $args['nombre'];
    $response->getBody()->write(json_encode(['saludo' => "Hola $nombre"]));
    return $response->withHeader('Content-Type', 'application/json');
});

/*
 * 3) POST /pruebapost
 */
$app->post('/pruebapost', function (Request $request, Response $response) {
    $params = $request->getParsedBody();
    $nombre = $params['nombre'] ?? 'desconocido';
    $edad   = $params['edad'] ?? 'N/A';

    $mensaje = "Hola $nombre, tu edad es $edad (POST recibido)";
    $response->getBody()->write($mensaje);

    return $response->withHeader('Content-Type', 'text/plain');
});

/*
 * 4) POST /testjson
 */
$app->post('/testjson', function (Request $request, Response $response) {
    $body = $request->getBody()->getContents();
    $json = json_decode($body, true);

    if (!$json) {
        $json = ['error' => 'JSON inválido'];
    }

    $json['mensaje'] = 'JSON recibido correctamente';

    $response->getBody()->write(json_encode($json));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
