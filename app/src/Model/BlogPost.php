<?php

namespace Crimsoncircle\Model;

use Symfony\Component\HttpFoundation\Request;

Class BlogPost
{
    public const registerPerPage = 10;

    public function connectionDB()
    {
        $servername = "db";
        $database = "blogpost";
        $username = "root";
        $password = "crimsoncircle";
        // Create connection
        $connection = mysqli_connect($servername, $username, $password, $database);
        // Check connection

        return $connection;
    }

    public function closeConectionDB($connection): void
    {
        mysqli_close($connection);
    }

    public function getDataPost($connection, String $slug): array
    {
        $registers = [];
        $query = "SELECT * FROM post WHERE slug = '$slug'";
        $result = mysqli_query($connection, $query);
 
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                array_push($registers, $row);
            }
        } else {
            array_push($registers, 'No existen registros');
        }

        return $registers;
    }

    public function insertDataPost($connection, Request $request): array
    {
        $postData = json_decode($request->getContent(), true);
        $title = strval($postData["title"]);
        $content = strval($postData["content"]);
        $author = strval($postData["author"]);
        $slug = strval($postData["slug"]);
        $timestamp = date("Y-m-d H:i:s");

        $queryInsert = "INSERT INTO `post` (`title`, `content`, `author`, `slug`, `created_at`) VALUES ('$title', '$content', '$author', '$slug', '$timestamp')";

        // return $queryInsert;
        return mysqli_query($connection, $queryInsert) ? ['success' => 'Nuevo post creado'] : ['error' => "Error: " . $queryInsert . "<br>" . $connection->error];
    }

    public function deleteDataPost($connection, String $slug): array
    {
        $queryDelete = "DELETE FROM post WHERE slug = '$slug'";

        return $connection->query($queryDelete) ? ['Success' => 'Registro eliminado'] : ['error' => 'Error al eliminar ' . $connection->error];
    }

    public function getDataPostComment($connection, String $id): array
    {
        $registers = [];
        $query = "SELECT * FROM comment WHERE id = " . intval($id);
        $result = mysqli_query($connection, $query);
 
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                array_push($registers, $row);
            }
        } else {
            array_push($registers, 'No existen registros');
        }

        return $registers;
    }

    public function storeCommentByPost($connection, Request $request): array
    {
        $postData = json_decode($request->getContent(), true);
        $post_id = strval($postData["post_id"]);

        if( $this->findPost($connection, $post_id) ){
            $content = strval($postData["content"]);
            $author = strval($postData["author"]);
            $timestamp = date("Y-m-d H:i:s");
            
            $queryInsert = "INSERT INTO `comment` (`content`, `author`, `post_id`, `created_at`) VALUES ('$content', '$author', '$post_id', '$timestamp')";
            return mysqli_query($connection, $queryInsert) ? ['success' => 'Nuevo post creado'] : ['error' => "Error: " . $queryInsert . " " . $connection->error];

        } else {
            return ['error' => 'No existe el post'];
        }
    }

    public function findPost($connection, String $post_id): bool
    {
        $query = "SELECT * FROM post WHERE id = " . intval($post_id);
        $result = mysqli_query($connection, $query);
        
        return mysqli_num_rows($result) > 0 ? true : false;
    }

    public function deleteDataPostComment($connection, String $id): array
    {
        $queryDelete = "DELETE FROM comment WHERE id = " . intval($id);

        return $connection->query($queryDelete) ? ['Success' => 'Registro eliminado'] : ['error' => 'Error al eliminar ' . $connection->error];
    }

    public function getDataPostCommentPagination($connection, String $post_id, String $numPage): array
    {
        
        $registers = [];
        $query = "SELECT * FROM comment WHERE post_id = " . intval($post_id) . " LIMIT " . self::registerPerPage * intval($numPage) - self::registerPerPage . "," . self::registerPerPage * intval($numPage);
        $result = mysqli_query($connection, $query);
        
        if ( mysqli_num_rows($result) > 0 ) {
            while($row = mysqli_fetch_assoc($result)) {
                array_push($registers, $row);
            }
        } else {
            array_push($registers, 'No existen registros');
        }

        return $registers;
    }
}