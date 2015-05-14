<?php
define('BASEPATH', __DIR__);//for CI
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/application/config/database.php';

$medoo = new medoo(array(
	'database_type' => 'mysql',
    'database_name' => $db['default']['database'],
    'server' => $db['default']['hostname'],
    'username' => $db['default']['username'],
    'password' => $db['default']['password'],
    'charset' => 'utf8'
));

define('DOMAIN', 'pic.ecjtu.net');
define('API_BASE_URL', DOMAIN . '/api');
define('USER_API_URL', 'http://user.ecjtu.net/api/user/');

class JsonHeaders extends \Slim\Middleware
{
    public function call()
    {
        $this->app->response->headers->set(
        	'Content-Type', 'application/json');
        $this->next->call();
    }
}

$app = new \Slim\Slim();
$app->add(new JsonHeaders());

$app->get('/list', function () use ($app, $medoo) {
	define('PER_PAGE', 3);
	$page = intval($app->request->get('page'));
	$page = $page < 1 ? 1 : $page;
	$offset = ($page - 1) * PER_PAGE;
	$data = $medoo->select(
		'cyrec_posts', 
		array(
			'posts_id(pid)',
			'posts_category(category)',
			'posts_title(title)',
			'posts_description(description)',
			'posts_thumb(thumb)',
			'posts_count(count)',
			'posts_pubdate(pubdate)',
			'posts_hit(click)',
		), 
		array(
			'ORDER' => 'posts_pubdate DESC',
			'LIMIT' => array($offset, PER_PAGE),
		)
	);
	$output = array();
	foreach ($data as $row) {
		$row['thumb'] = DOMAIN . '/' . $row['thumb'];
		$output[] = $row;
	}
	$count = count($output);
	echo json_encode(array(
		'count' => $count,
		'list' => $output,
	));
});

$app->get('/post/:pid', function ($pid) use ($app, $medoo) {
	$pid = intval($pid);
	$data = $medoo->select(
		'cyrec_posts',
		array(
			'posts_id(pid)',
			'posts_category(category)',
			'posts_title(title)',
			'posts_description(description)',
			'posts_keywords(keywords)',
			'posts_author(author)',
			'posts_thumb(thumb)',
			'posts_pictures(pictures)',
			'posts_count(count)',
			'posts_pubdate(pubdate)',
			'posts_hit(click)',
			'posts_type(type)',
			'posts_detail(detail)',
		),
		array(
			'posts_id' => $pid,
		)
	);
	if(!$data)
		return $app->response->setStatus(404);

	$pictures = unserialize($data['pictures']);
	$detail = unserialize($data['detail']);
	$out_pictures = array();
	foreach ($pictures as $key => $row) {
		$out_pictures[$key]['url'] = $row;
		if(isset($detail[$key]) && $detail[$key])
			$out_pictures[$key]['detail'] = $detail[$key];
		else
			$out_pictures[$key]['detail'] = '';
	}
	unset($data['pictures']);
	unset($data['detail']);

	$comments = $medoo->select(
		'cyrec_comments',
		array(
			'comments_posts_id(pid)',
			'comments_time(time)',
			'comments_author(author)',
			'comments_text(text)',
			'comments_author_sid(sid)',
		),
		array(
			'comments_posts_id' => $data['pid'],
			'ORDER' => 'comments_time DESC',
		)
	);

	foreach ($comments as $key => $row) {
		if(isset($row['sid']) && $row['sid']){
			$curl = new Curl();
			$user = $curl->get(USER_API_URL . $row['sid']);
			$user = json_decode($user);
			$user = $user['user'];
			$comments[$key]['author'] = array(
				'sid' => $row['sid'],
				'name' => $user['name'],
				'avatar' => $user['avatar'],
			);
		}else{
			$comments[$key]['author'] = array(
				'sid' => '',
				'name' => $row['author'],
				'avatar' => '',
			);
		}
		unset($comments[$row]['sid']);
	}

	$data['thumb'] = DOMAIN . '/' . $data['thumb'];
	$data['pictures'] = $out_pictures;
	$data['comments'] = $comments;

	echo json_encode($data);
});

$app->run();