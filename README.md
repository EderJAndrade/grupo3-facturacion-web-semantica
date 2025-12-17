# API REST de Facturación con Web Semántica (JSON-LD) – Grupo 3

Proyecto desarrollado en **Laravel 12** como parte de la asignatura **Arquitectura de Software**.  
El sistema implementa una **API REST de Facturación** que integra **Web Semántica mediante JSON-LD**, permitiendo exponer información estructurada y comprensible para sistemas inteligentes, motores de búsqueda y aplicaciones externas.

La API gestiona clientes, productos, facturas y detalles de factura, utilizando vocabularios estándar de **schema.org** y devolviendo todas las respuestas en formato **JSON-LD**.

---

## Objetivo del proyecto

- Desarrollar una API REST con Laravel 12.
- Implementar Web Semántica utilizando JSON-LD.
- Modelar un sistema de facturación.
- Exponer operaciones CRUD completas para todos los modelos.
- Consumir la API desde una aplicación web simple sin usar Postman.
- Aplicar buenas prácticas de arquitectura de software.

---

## Tecnologías utilizadas

- PHP 8.2
- Laravel 12
- MySQL (XAMPP)
- JSON-LD
- schema.org
- HTML + JavaScript (Fetch API)
- Composer

---

## Instalación del proyecto

Desde una terminal, ubicarse en el directorio donde se desea guardar el proyecto y ejecutar:

1. Clonar el repositorio:
   git clone https://github.com/EderJAndrade/grupo3-facturacion-web-semantica.git

2. Ingresar al directorio del proyecto:
   cd grupo3-facturacion-web-semantica

3. Instalar dependencias de Laravel:
   composer install

4. Copiar el archivo de entorno:
   cp .env.example .env

5. Generar la clave de la aplicación:
   php artisan key:generate

---

## Configuración de la base de datos

1. Crear la base de datos en MySQL:

   CREATE DATABASE grupo3_facturacion_web_semantica CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

2. Crear el usuario y asignar permisos:

   CREATE USER 'grupo3_user'@'localhost' IDENTIFIED BY 'Grupo3JsonLD';
   GRANT ALL PRIVILEGES ON grupo3_facturacion_web_semantica.* TO 'grupo3_user'@'localhost';
   FLUSH PRIVILEGES;

3. Configurar el archivo `.env`:

   DB_CONNECTION=mysql  
   DB_HOST=127.0.0.1  
   DB_PORT=3306  
   DB_DATABASE=grupo3_facturacion_web_semantica  
   DB_USERNAME=grupo3_user  
   DB_PASSWORD=Grupo3JsonLD  

---

## Migraciones y estructura del sistema

El sistema está compuesto por los siguientes modelos:

- Cliente
- Producto
- Factura
- DetalleFactura

Para crear las tablas en la base de datos ejecutar:

   php artisan migrate

---

## Implementación de Web Semántica (JSON-LD)

La Web Semántica se implementa mediante **Laravel JsonResource**, donde cada modelo define su representación semántica en formato JSON-LD utilizando vocabularios de **schema.org**.

Ubicación de los recursos semánticos:

- app/Http/Resources/ClienteResource.php
- app/Http/Resources/ProductoResource.php
- app/Http/Resources/FacturaResource.php
- app/Http/Resources/DetalleFacturaResource.php

Ejemplo de respuesta JSON-LD para un cliente:

{
  "@context": "https://schema.org",
  "@type": "Person",
  "identifier": 1,
  "name": "Eder Andrade",
  "email": "ederandrade@grupo3.com",
  "telephone": "+593987654321"
}

Tipos semánticos utilizados:

- Cliente → Person
- Producto → Product
- Factura → Invoice
- DetalleFactura → InvoiceLineItem

---

## Operaciones CRUD (API REST)

La API expone operaciones CRUD completas para cada modelo:

- Cliente: crear, listar, consultar, actualizar y eliminar
- Producto: crear, listar, consultar, actualizar y eliminar
- Factura: crear, listar, consultar, actualizar y eliminar
- DetalleFactura: crear, listar, consultar, actualizar y eliminar

Las rutas de la API se encuentran definidas en:

routes/api.php

---

## Aplicación web de prueba (sin Postman)

Para probar la API se desarrolló una aplicación web simple usando **HTML y JavaScript (Fetch API)**.

Ubicación del archivo:
public/crud-jsonld.html

Funcionalidades principales:

- Ingreso manual de datos para cada modelo
- Consumo de la API REST
- Visualización automática de las respuestas en formato JSON-LD
- Inserción dinámica de JSON-LD en el documento HTML

Iniciar el servidor de desarrollo de Laravel con:

php artisan serve

Acceso desde el navegador:
http://127.0.0.1:8000/crud-jsonld.html

---

## Conclusión

Este proyecto demuestra la integración de **Web Semántica** en una **API REST moderna**, aplicando estándares abiertos como **JSON-LD** y **schema.org**, lo que permite que la información de un sistema de facturación sea interoperable, reutilizable y semánticamente enriquecida.

---

## Autores

Grupo 3 – Arquitectura de Software

- Aguilar Mijas Laura Estefanía  
- Andrade Alvarado Eder Jonathan  
- Bucay Pallango Carlos Avelino  
- Cisneros Cárdenas Freddy Gabriel  
- Pita Clemente Karina Annabel  
- Tenemaza Parra Alanis Valeria

*Universidad de las Fuerzas Armadas ESPE*

Docente: *Vilmer David Criollo Chanchicocha*

**2025**

---