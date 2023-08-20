<?php
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
//---------------------------------------------------- LEAPYEAR --------------------------------------------------------

$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', [
    'year' => 0,
    '_controller' => 'Crimsoncircle\Controller\LeapYearController::index',
]));

//---------------------------------------------------- POSTBLOG --------------------------------------------------------

$routes->add('get_blog', new Routing\Route('/blog/{slug}', [
    '_controller' => 'Crimsoncircle\Controller\BlogPostController::indexPost',
]));

$routes->add('create_blog', new Routing\Route('/blog', [
    '_controller' => 'Crimsoncircle\Controller\BlogPostController::storePost',
]));

$routes->add('delete_blog', new Routing\Route('/blog/delete/{slug}', [
    '_controller' => 'Crimsoncircle\Controller\BlogPostController::destroyPost',
]));

$routes->add('get_comment', new Routing\Route('/comment/{post_id}', [
    //'post_id' => 0,
    '_controller' => 'Crimsoncircle\Controller\BlogPostController::indexComments',
]));

$routes->add('create_comment', new Routing\Route('/comment', [
    '_controller' => 'Crimsoncircle\Controller\BlogPostController::storeComments',
]));

$routes->add('delete_comment', new Routing\Route('/comment/delete/{post_id}', [
    '_controller' => 'Crimsoncircle\Controller\BlogPostController::destroyComments',
]));

$routes->add('get_comments_pag', new Routing\Route('/comment/post/{post_id}/page/{numPage}', [
    '_controller' => 'Crimsoncircle\Controller\BlogPostController::indexCommentsPostPagination',
]));

return $routes;