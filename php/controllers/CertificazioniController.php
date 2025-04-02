<?php 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CertificazioniController{

    //funzione non rischiesta ma mi serve per dei controlli
    public function all(Request $request, Response $response, $args){
        $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
        $result = $mysqli_connection->query("SELECT c.* FROM certificazioni c ");
       if ($result && $mysqli_connection->affected_rows > 0) {
           $results = $result->fetch_all(MYSQLI_ASSOC);
            $response->getBody()->write(json_encode($results));
            return $response->withHeader("Content-type", "application/json")->withStatus(200);
       }else {
          return $response->withStatus(404);
       }
    }
    public function getAll(Request $request, Response $response, $args){
        $id = $args['id'];
        $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
        $result = $mysqli_connection->query("SELECT c.* FROM certificazioni c 
        inner join alunni a on c.alunno_id = a.id WHERE a.id = '$id'");
       if ($result && $mysqli_connection->affected_rows > 0) {
           $results = $result->fetch_all(MYSQLI_ASSOC);
            $response->getBody()->write(json_encode($results));
            return $response->withHeader("Content-type", "application/json")->withStatus(200);
       }else {
          return $response->withStatus(404);
       }
    }

    public function view(Request $request, Response $response, $args){
        $id = $args['id'];
        $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
        $result = $mysqli_connection->query("SELECT a.*, c.* FROM certificazioni c 
        inner join alunni a on c.alunno_id = a.id WHERE c.id = '$id'");
         if ($result && $mysqli_connection->affected_rows > 0) {
            $results = $result->fetch_all(MYSQLI_ASSOC);
             $response->getBody()->write(json_encode($results));
             return $response->withHeader("Content-type", "application/json")->withStatus(200);
        }else {
           return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response, $args){
        $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
        $body = json_decode($request->getBody()->getContents(), true);
        $id_alunno = $body["alunno_id"];
        $titolo = $body["titolo"];
        $votazione = $body["votazione"];
        $ente = $body["ente"];
        $raw_query = "INSERT INTO certificazioni(alunno_id, titolo, votazione, ente) VALUES('$id_alunno','$titolo','$votazione','$ente')";
        $result = $mysqli_connection->query($raw_query);
        if ($result && $con->affected_rows > 0) {
            $response->getBody()->write(json_encode(array("message" => "Created!!")));
         } else {
           $response->getBody()->write(json_encode(array("message" => $con->error)));
         }
         return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }

    public function delete(Request $request, Response $response, $args){
        $id = $args['id'];
        $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
        $mysqli_connection->query("DELETE  FROM certificazioni WHERE id='$id'");
        return $response->withStatus(204);
    }

    public function update(Request $request, Response $response, $args){
        $id = $args['id'];
        $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
        $body = json_decode($request->getBody()->getContents(), true);
        $id_alunno = $body["alunno_id"];
        $titolo = $body["titolo"];
        $votazione = $body["votazione"];
        $ente = $body["ente"];
        $query= "UPDATE certificazioni SET alunno_id = '$id_alunno', titolo = '$titolo', votazione = '$votazione', ente = '$ente' WHERE id= '$id'";
        $result = $mysqli_connection->query($query);
        if ($result && $con->affected_rows > 0) {
            $response->getBody()->write(json_encode(array("message" => "Created!!")));
         } else {
           $response->getBody()->write(json_encode(array("message" => $con->error)));
         }
         return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }
}

?>