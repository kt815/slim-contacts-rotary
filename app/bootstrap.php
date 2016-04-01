<?php
require_once(ROOT . '/vendor/autoload.php');
\Slim\Slim::registerAutoloader();
// Instantiate the app
$app = new \Slim\Slim(array(
    'mode' => getenv('app.dev'),
    'templates.path' => 'views',
    'cookies.lifetime' => '20 minutes'));
// Only invoked if mode is "production"
$app->configureMode('production', function () use ($app) {
    $app->config(array(
        'log.enable' => false,
        'debug' => false));});
// Only invoked if mode is "development"
$app->configureMode('development', function () use ($app) {
    $app->config(array(
        'log.enable' => false,
        'debug' => true));});
$app->add(new \Slim\Middleware\SessionCookie(array()));
// Environment based configuration
if (file_exists(ROOT . DS  . '\.env')) {
Dotenv::load(ROOT);} 
else {die("<pre>File .env missing!</pre>");}
$app->container->singleton('log', function () {
    $log = new \Monolog\Logger('slim-app');
    $log->pushHandler(new \Monolog\Handler\StreamHandler('../logs/app.log', \Monolog\Logger::DEBUG));
    return $log;});
// Prepare view
$app->view(new \Slim\Views\Twig());
$app->view->setTemplatesDirectory('../app/views');
$app->view->parserOptions = array(
    'charset' => 'utf-8',
    'cache' => realpath('app/views/cache'),
    'auto_reload' => true,
    'strict_variables' => false,
    'autoescape' => true);
$app->view->parserExtensions = array(new \Slim\Views\TwigExtension());
foreach(glob(ROUTERS_DIR . '*.php') as $router) {
    require_once $router;}
require_once(ROOT_APP . '/config.php');
$app->get('/trial', function () use ($app) {
});