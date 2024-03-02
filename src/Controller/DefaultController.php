<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController//Para poder usarlo en este controller hay que hacer que herede de la case AbstracController
{
    public function hola(){
        return new Response("Buenas Tardes");
    }

    #[Route("/user/{name}/{surname}/{age}", methods: ['GET'], requirements: ["age" => "\d+"])]//se podria incluir incluso texto , ej /edad/age
    public function usuario($name,$surname, $age ){
        // return new Response("Soy $name $surname y tengo $age años", 500, ["Content-Type" => "image/jpg"]);
        
        
        // si se quiere devolver un html mas completo y no texto plano, instalariamos un componente especifico twig. Nos creara una carpeta Template con un fichero base.html. Hay que instalar una extesion para que pinte bien, vale cualquiera poniendo twig. Y se sustituye el new responde por esto
        return $this->render(
            "base.html.twig",
            [
                "nombre" => $name,
                "apellidos" => $surname,
                "edad" => $age
            ]
        );//si quiero pasar las variables desde el controllador a la plantilla.Le puedo pasar como 2 argumento un array con clave, valor. La clave sera como quiero que se llame la barible
    }

    
    #[Route("/user/{name}/{surname}/{age}", methods: ['POST'])]
    public function usuarioPost($name,$surname, $age ){
        return new Response("Soy $name $surname y tengo $age años");
        // Se usa new Response porque se pueden hacer mas cosas aqui, se podria poner incluso el codigo php de la respuesta pr forzarlo, por ejemplo 500. Tb se puede jugar con los headers.

    }

}
//otra opcion cuando hay varias rutas es crear un controller para todas ellas.
// Otra forma de hacer esto es con las ANOTACIONES. Son anotaciones en el codigo para configurar cosas. se pondria encima de cada funcion un comentario #[route("/user")], y no haria falta declararlo en el routes.yaml
//para hacer una ruta dinamica, se pondrian {} y dentro a lo que se llama. En la funcion se pondria esa variable. se puede complicar tanto como se quiera ej. {name}/{surname}/edad/{age} y se añaden esas variables
//Tb con metodo se le puede pone el methods:['GET] si es GET, POST etc...
//Tb se puede poner requirements: ["age" => "\d+"]. El \d+ significa que solo hay numeros, hay que revisar las expresiones regulares(se pueden hacer por PHP)