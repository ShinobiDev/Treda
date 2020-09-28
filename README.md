## Treda
Treda es una api, realizado en laravel y que contiene en CRUD de un modelo de TIENDA y de un modelo PRODUCTO, ademas de contar con 3 funciones de logica de programación, que permiten, sumar los multiplos de 3 y 5, de los numeros menores a un numero ingresado por el usuario, otra función para converir frases con palabras separadas por espacio, guión y guión al piso, los cuales elimina y convierte la primera letra de la palabra siguiente en mayuscula y una ultima función que permite invertir las palabras que tienen mas de 5 letras.

## Instalación

Despues de descargar el proyecto o clonarlo en la carpeta del servidor local, abrimos la terminal, nos ubicamos en la carpeta del proyecto y ejecutamos el siguiente comando: 

```
composer update require laravel/passport
```

## Ejecutar migraciones

Para ejecutar las migraciones, recuerde configurar los datos del archivo .env:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<Nombre de la base de datos>
DB_USERNAME=<Usuario de la base de datos>
DB_PASSWORD=<Password de la base de datos>
```
Despues de configurar el archivo .env, desde la terminal y ubicados en la carpeta del proyecto, ejecutamos el siguiente comando el cual realizara las migraciones de la base de datos y sus correspondientes seeders:


```
php artisan migrate:refresh --seed
```
despues de esto, instalamos passport, que permite que los servicios sean consumidos como una api

```
php artisan passport:install
```

## Consumir los servicios

Para hacer uso de los servicios es necesario utilizar una aplicación para consumo de apis, se puede usar Postman, que es una herramienta que se puede usar de manera online https://www.postman.com/ o instalado en nuestro pc o utilizar la aplicacion VueJs que se encuentra en construcción en el repositorio https://github.com/ShinobiDev/front-prueba

## Servicios web

Crear tienda
```
Metodo: POST
Ruta: localhost/treda/public/api/crearTienda
json: 
    {
        "nombre": "Una tienda mas",
        "fechaApertura": "02-12-2017"
    }
```
Editar tienda
```
Metodo: PUT
Ruta: localhost/treda/public/api/actualizarTienda
json: 
    {
        "tiendaId": 1,
        "nombre": "Actualizado",
        "fechaApertura": "02-02-2020"
    }
```
Eliminar tienda
```
Metodo: DELETE
Ruta: localhost/treda/public/api/eliminarTienda
json: 
    {
        "tiendaId":1
    }
```
Mostrar tiendas
```
Ruta: localhost/treda/public/api/getTiendas
```
Mostrar tienda por Id
```
Metodo: POST
Ruta: localhost/treda/public/api/showTienda
json: 
    {
        "tiendaId":1
    }
```
Crear Producto
```
Metodo: POST
Ruta: localhost/treda/public/api/crearProducto
json: 
    {
        "nombre": "Otro producto",
        "sku": "333",
        "descripcion": "Descripcion del producto",
        "valor":3500,
        "imagen": null,
        "tiendaId": 1
    }
```
Editar Producto
```
Metodo: PUT
Ruta: localhost/treda/public/api/actualizarProducto
json: 
    {
        "nombre": "Otro producto",
        "sku": "333",
        "descripcion": "Descripcion del producto",
        "valor":3500,
        "imagen": null,
        "tiendaId": 1,
        "productoId": 1
    }
```
Mostrar productos por id
```
Metodo: POST
Ruta: localhost/treda/public/api/mostrarProducto
json: 
    {
        "productoId":1
    }
```
Mostrar productos por tienda
```
Metodo: POST
Ruta: localhost/treda/public/api/mostrarProducto
json: 
    {
        "tiendaId":1
    }
```
Funcion de multiplos
```
Metodo: POST
Ruta: localhost/treda/public/api/multiplos
json: 
    {
        "numero": 10
    }
```
Funcion CamelCase
```
Metodo: POST
Ruta: localhost/treda/public/api/remplazar
json: 
    {
        "frase": "bienvenido-a_Treda solutions con_mis-amigos"
    }
```
Funcion Invertir
```
Metodo: POST
Ruta: localhost/treda/public/api/invertirPalabras
json: 
    {
        "frase": "Bienvenido a Treda Solutions"
    }
```


