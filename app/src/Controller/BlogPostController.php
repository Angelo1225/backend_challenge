<?php
namespace Crimsoncircle\Controller;

use Crimsoncircle\Model\BlogPost;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogPostController
{
    public function indexPost(Request $request, String $slug): Response 
    {
        echo $request->query->get('filter');

        $connect = new BlogPost();
        $conection = $connect->connectionDB();
        if( !$conection ){
            die("Connection failed: " . mysqli_connect_error());
        } else {
            $registers = $connect->getDataPost($conection, $slug);
            $connect->closeConectionDB($conection);

            return new Response (
                json_encode($registers)
            );
        }
    }

    public function storePost(Request $request): Response
    {
        $connect = new BlogPost();
        $conection = $connect->connectionDB();
        if( !$conection ){
            die("Connection failed: " . mysqli_connect_error());
        } else {
            $registers = $connect->insertDataPost($conection, $request);
            $connect->closeConectionDB($conection);

            return new Response (
                json_encode($registers)
            );
        }
    }

    public function destroyPost( Request $request, String $slug ): Response
    {
        echo $request->query->get('filter');

        $connect = new BlogPost();
        $conection = $connect->connectionDB();
        if( !$conection ){
            die("Connection failed: " . mysqli_connect_error());
        } else {
            $delete = $connect->deleteDataPost($conection, $slug);
            $connect->closeConectionDB($conection);

            return new Response (
                json_encode($delete)
            );
        }
    }

    public function indexComments( Request $request, String $post_id ): Response
    {
        echo $request->query->get('filter');

        $connect = new BlogPost();
        $conection = $connect->connectionDB();
        if( !$conection ){
            die("Connection failed: " . mysqli_connect_error());
        } else {
            $registers = $connect->getDataPostComment($conection, $post_id);
            $connect->closeConectionDB($conection);

            return new Response (
                json_encode($registers)
            );
        }
    }

    public function storeComments(Request $request): Response
    {
        $connect = new BlogPost();
        $conection = $connect->connectionDB();
        
        if( !$conection ){
            die("Connection failed: " . mysqli_connect_error());
        } else {
            $registers = $connect->storeCommentByPost($conection, $request);
            $connect->closeConectionDB($conection);

            return new Response (
                json_encode($registers)
            );
        }
    }

    public function destroyComments( Request $request, String $post_id ): Response
    {
        echo $request->query->get('filter');

        $connect = new BlogPost();
        $conection = $connect->connectionDB();
        if( !$conection ){
            die("Connection failed: " . mysqli_connect_error());
        } else {
            $delete = $connect->deleteDataPostComment($conection, $post_id);
            $connect->closeConectionDB($conection);

            return new Response (
                json_encode($delete)
            );
        }
    }

    public function indexCommentsPostPagination( Request $request, String $post_id, String $numPage): Response
    {
        echo $request->query->get('filter');

        $connect = new BlogPost();
        $conection = $connect->connectionDB();
        if( !$conection ){
            die("Connection failed: " . mysqli_connect_error());
        } else {

            $registers = $connect->getDataPostCommentPagination($conection, $post_id, $numPage);
            $connect->closeConectionDB($conection);


            return new Response (
                json_encode($registers)
            );
        }
    }
}