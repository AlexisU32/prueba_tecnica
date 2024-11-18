
## Sobre la prueba

 En la prueba técnica se muestra una vista con dos contenedores en los cuales se va a listar todos los reddits que 
 provienen del api y en el otro contenedor se va a mostrar el detalle de cada reddit seleccionado.

 Este ejercicio esta con un estilo básico pero funcional, cumpliendo con lo solicitado.

 ## Inicio de la aplicación

 Desde la consola ingresando al proyecto se ejecuta el siguiente comando para correr la aplicación.

 - php artisan serve

 Se crea una base de datos en MySql con el nombre de ( reddit ).
 Se ejecuta el comando ( php artisan migrate ) para crear la migración a la base de datos

## Comando para ejecutar el script que obtiene los datos del API

Para obtener los datos del Api de reddit y guardarlos en la base de datos se ejecuta el siguiente comando desde la consola.

- php artisan app:fetch-reddit-data
