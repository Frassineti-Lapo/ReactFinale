<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/AlunniController.php';
require __DIR__ . '/controllers/CertificazioniController.php';

$app = AppFactory::create();

//Gestione dei metodi CRUD per alunno
$app->get('/alunni', "AlunniController:index");
$app->get('/alunni/{id}', "AlunniController:getOne");
$app->post('/alunni', "AlunniController:create");
$app->delete('/alunno/{id}', "AlunniController:delete");
$app->put('/alunni/{id}', "AlunniController:update");

//Gestione dei metodi CRUD per le certificazioni
$app->get('/certificazioni', "CertificazioniController:all");
$app->get('/certificazioni/{id}', "CertificazioniController:getAll");
$app->get('/certificazione/{id}', "CertificazioniController:view");
$app->post('/certificazione', "CertificazioniController:create");
$app->delete('/certificazione/{id}', "CertificazioniController:delete");
$app->put('/certificazione/{id}', "CertificazioniController:update");

$app->run();



//comandi curl
//alunni
//GET
//localhost:8080/alunni --> farà vedere tuutti gli alunni
//localhost:8080/alunni/2 --> farà vedere tutti i dati del l'alunno speficiato
//POST 
//curl -X POST http://localhost:8080/alunni -H "Content-Type: application/json" -d '{"nome":"pippo","cognome":"pluto"}' --> CREO UB NUOVO ALUNNO
//PUT
//curl -X PUT http://localhost:8080/alunni/5 -H "Content-Type: application/json" -d '{"nome":"leo","cognome":"bianchi"}' --> AGGIORNO i DATI
//curl -X DELETE http://localhost:808o/alunno/5 --> elimino un'alunno

//certificazione
//GET
//localhost:8080/certificazioni/1 --> tutte le certificazione di un alunno
//localhost:8080/certificazione/1 --> certificazione singola
//POST 
//curl -X POST http://localhost:8080/certificazione -H "Content-Type: applicatio/json" -d '{"alunno_id": "3", "titolo": "Certificazione C++", "votazione":"100","ente": "Rex"}'
//PUT
//curl -X PUT http://localhost:8080/certificazione/6 -H "Content-Type: application/json" -d '{"alunno_id": "1", "titolo":"Certificazione c--", "votazione": "100", "ente": "Rex"}'
// DELETE
// curl -X DELETE http://localhost:8080/certificazione/6


