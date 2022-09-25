## Pasos para ejecutar el proyecto

0- Arrancar servidor de BBDD local
1- Crear base de datos local llamada "cash"
2- Importar archivo cash.sql localizado en la raiz del proyecto
3- Ejecutar`:
```
php artisan serve
```
4- Ejecutar`:
```
npm install && npm run dev
```

## Pasos iniciales de usuarios:

danisanchezestevez@gmail.com:123456789 (creado manualmente y como Admin)
eve.holt@reqres.in:cityslicka (creado desde reques y como Usuario que no puede ver el listado)

## Funcionamiento con Reqres:
- Al introducir un email y contraseña el sistema primero comprueba si ya existe en BBBDD
- Si es el primer acceso, conecta con reqres y valida los datos
- Si los datos son correctos sigue adelante y crea el usuario en BBDD
- Si no fuesen correctos te mostraria un error

## Guardado de respuestas:
- Las respuestas se guardan de forma individual y compartiendo la categoría. Se genera tambien un Hash a partir del Timestamp del momento para poder localizar todas las respuestas de un mismo formulario.
- Las respuestas estan relacionadas con "categories_question" por el "name".
- Cuando se pinta el formulario, como cada pregunta tiene un "type" automaticamente se genera el input correspondiente.

## Lista de usuarios de Reqres:
- Se imprime haciendo uso de los datos de paginación que devuelve el endpoint.



