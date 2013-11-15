<?php

// index.php

require_once __DIR__.'/vendor/autoload.php';

$app = new Silex\Application();

// Turn on debugging
$app['debug'] = true;

// Register database
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver' => 'pdo_mysql',
        'dbname' => 'the_daily_sportsman',
        'user' => 'root',
        'password' => 'password'
    )
));

// Register session so we can use flash data
$app->register(new Silex\Provider\SessionServiceProvider());

// Register Twig so we can use templating
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/templates'
));

// Set base layout.twig template
$app->before(function () use ($app) {
    $app['twig']->addGlobal('layout', $app['twig']->loadTemplate('layout.twig'));
});

// Default route contains a list of articles ordered by date added in descending
// i.e. latest first.
$app->get('/', function () use ($app) {
    $articles = $app['db']->fetchAll('SELECT `id`, `title`, DATE_FORMAT(`date`, \'%D %b %Y\') `posted`, `content` FROM `articles` ORDER BY `date` DESC;');
    return $app['twig']->render('index.twig', array('articles' => $articles));
});

// View an individual article
$app->get('/article/view/{id}', function (Silex\Application $app, $id) use ($app) {
    $article = $app['db']->fetchAssoc('SELECT `id`, `title`, DATE_FORMAT(`date`, \'%D %b %Y\') `date`, `content` FROM `articles` WHERE `id` = ? LIMIT 1', array($id));
    return $app['twig']->render('article.twig', array(
        'title' => $article['title'],
        'article' => $article
    ));
})->assert('id', '\d+');

// Add an article
$app->get('/article/add', function () use ($app) {
    if (null !== $form_data = $app['session']->get('form_data')) {
        $app['session']->remove('form_data');
    }
    if (null !== $errors = $app['session']->get('errors')) {
        $app['session']->remove('errors');
    }
    return $app['twig']->render('article_add_edit.twig', array(
        'title' => 'Add an article',
        'action' => 'add',
        'form_data' => $form_data,
        'errors' => $errors
    ));
});

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Save an article (by adding a new one or by editing an existing one)
$app->post('/article/save', function (Silex\Application $app, Request $request) {
    // Adding or editing?
    $action = $request->get('action');
    
    // Check title, date and content all valid
    $required_fields = array('title', 'content');
    foreach ($required_fields as $required_field) {
        if (!strlen($request->get($required_field))) {
            $errors[$required_field] = ucfirst($required_field) . ' is a required field';
        }
    }
    $date = $request->get('date');
    if (strlen($date)) {
        list($day, $month, $year) = explode('/', $date);
        $date = $year . '-' . $month . '-' . $day;
    } else {
        $date = date('Y-m-d', strtotime('now'));
    }
    if (isset($errors)) {
        // If errors, redirect back to form with form values and error messages
        $app['session']->set('form_data', $request->request->all());
        $app['session']->set('errors', $errors);
        // Return to either adding or editing depending on where we came from
        $return = $request->getBaseUrl() . '/article/' . $action;
        if ($action === 'edit') {
            $return .= '/' . $request->get('id');
        }
        return $app->redirect($return, 301);
    }
    
    $data = array(
        'title' => $request->get('title'),
        'date' => $date,
        'content' => $request->get('content'),
    );
    
    $table = 'articles';
    
    $success_message = 'Article ';
    
    if ($action === 'add') {
        $app['db']->insert($table, $data);
        $success_message .= 'added.';
    } elseif ($action === 'edit') {
        $app['db']->update($table, $data, array('id' => $request->get('id')));
        $success_message .= ' updated.';
    }
    
    // Redirect if successful
    $app['session']->getFlashBag()->add('message', $success_message);
    return $app->redirect($request->getBaseUrl(), 301);
});

// Edit an article
$app->get('/article/edit/{id}', function (Silex\Application $app, $id) use ($app) {
    if (null !== $form_data = $app['session']->get('form_data')) {
        $app['session']->remove('form_data');
    }
    if (null !== $errors = $app['session']->get('errors')) {
        $app['session']->remove('errors');
    }
    // If we haven't got any saved form data from session, retrieve from database
    if ($form_data === null) {
        // Retrieve article form data from database
        $form_data = $app['db']->fetchAssoc('SELECT `id`, `title`, DATE_FORMAT(`date`, \'%d/%m/%Y\') `date`, `content` FROM `articles` WHERE `id` = ? LIMIT 1', array($id));
    }
    return $app['twig']->render('article_add_edit.twig', array(
        'title' => 'Edit article',
        'action' => 'edit',
        'form_data' => $form_data,
        'errors' => $errors
    ));
})->assert('id', '\d+');

// Remove an article
$app->get('/article/remove/{id}', function (Silex\Application $app, $id) use ($app) {
    $form_data = $app['db']->fetchAssoc('SELECT `id`, `title`, DATE_FORMAT(`date`, \'%d/%m/%Y\') `date`, `content` FROM `articles` WHERE `id` = ? LIMIT 1', array($id));
    return $app['twig']->render('article_remove.twig', array(
        'title' => 'Remove article',
        'form_data' => $form_data
    ));
})->assert('id', '\d+');

// Override POST actions in templates with PUT or DELETE
Request::enableHttpMethodParameterOverride();

// Process deleting of article from database
$app->delete('/article/delete', function (Silex\Application $app, Request $request) {
    // Remove from database based on ID
    $app['db']->delete('articles', array('id' => $request->get('id')));
    $success_message = 'Article deleted.';
    $app['session']->getFlashBag()->add('message', $success_message);
    return $app->redirect($request->getBaseUrl(), 301);
});

$app->run();
