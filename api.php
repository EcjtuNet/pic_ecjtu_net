<?php
require_once 'vendor/autoload.php';
require_once __DIR__.'application/config/database.php';

$medoo = new medoo(array(
	'database_type' => 'mysql',
    'database_name' => $db['default']['database'],
    'server' => $db['default']['hostname'],
    'username' => $db['default']['username'],
    'password' => $db['default']['password'],
    'charset' => 'utf8'
));

const DATABASE_TO_JSON = array(
	'posts_id' => 'pid',
	'posts_category' => 'category',
	'posts_slug' => 'slug',
	'posts_title' => 'title',
	'posts_description' => 'description',
	'posts_keywords' => 'keywords',
	'posts_author' => 'author',
	'posts_thumb' => 'thumb',
	'posts_count' => 'count',
	'posts_pubdate' => 'pubdate',
	'posts_hit' => 'click',
);
const DOMAIN = 'pic.ecjtu.net';
const API_BASE_URL = DOMAIN . '/api';

class JsonHeaders extends \Slim\Middleware
{
    public function call()
    {
        $app->response->headers->set(
        	'Content-Type', 'application/json');
        $this->next->call();
    }
}

$app = new \Slim\Slim();
$app->add(new JsonHeaders());

$app->get('/list', function ($name) use ($app, $medoo) {
	const PER_PAGE = 3;
	$page = intval($app->request->get('page'));
	$page = $page < 0 ? 0 : $page;
	$offset = ($page - 1) * PER_PAGE;
	$data = $medoo->select(
		'cyrec_posts', 
		array(
			'posts_id',
			'posts_category',
			'posts_title',
			'posts_description',
			'posts_thumb',
			'posts_count',
			'posts_pubdate',
			'posts_hit',
		), 
		array(
			'ORDER' => 'posts_pubdate DESC',
			'LIMIT' => array($offset, PER_PAGE),
		)
	);
	$output = array();
	foreach ($data as $row) {
		foreach ($row as $key => $value) {
			if($key == 'posts_thumb')
				$value = DOMAIN . '/' . $value;
			$output[][DATABASE_TO_JSON[$key]] = $value;	
		}
	}
	$count = count($output);
	echo json_encode(array(
		'count' => $count,
		'list' => $output,
	));
});

$app->get('/post/:pid', function ($pid) use ($app, $medoo) {
	$pid = intval($pid);
	//TODO
});

$app->run();