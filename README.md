# Proyecto integrador agosto - diciembre 2021

## Materias

1. Ingeniería de Software II
2. Programación Web II

## Requerimientos funcionales

1. Creación y cancelación de una cotización de envío.
2. Administración de libreta de direcciones de envío y recolección.
3. Asignación de costos de guías y paqueterías disponibles a las cotizaciones.
4. Impresión de comprobante del envío.
5. Gestión de envíos pagados y facturas.
6. Generación de informes o reportes.
7. Envío de correos electrónicos informaticos sobre el estado de una cotización o envío.

## Requerimientos no funcionales

### Generales

1. Cada uno de los catálogos del sistema deberá contar con las funcionalidades de alta, bajas y cambios, cuidando siempre la intregridad referencial de los datos.
2. Permitir la configuración del texto que será enviado en cada email que envíe el sistema.
3. El usuario administrador podrá realizar la configuración o parametrización del servicio de envío de e-mail (SMTP)
4. Un usuario de tipo cliente podrá realizar cotizaciones y envíos a su nombre.
6. Un usuario de tipo empleado o administrador podrá realizar contizaciones a nombre de cualquier cliente del sistema.
7. Un cliente podrá tener un libro de direcciones, las cuales serán validadas a través del código postal.
8. Una cotización deberá:
   1. Contar con los datos del cliente que realizará el envío.
   2. Tener la información del paquete o mercancía a enviar.
   3. Identificar el destino del envío.
   4. Poseer información de recolección o entrega en sucursal.
   5. Permitir cancelarla.
   6. Permitir asignar costos y empresas de paqueterías.
   7. Permitir responderla indicando costo y empresa de envío.
   8. Generar un archivo PDF con toda la información generada.
   9. Manejar un estado o situación que permita identificar la etapa del proceso.
9. Un envío deberá:
   1. Manejar un estado o situación que permita identificar la etapa del proceso.
   2. Registrar la información del pago.
   3. Adjuntar la factura electrónico del pago (PDF y XML)
10. Generación de informes por cliente, empresa de paquetería, periodo de tiempo, estados de la cotización o del envío.

### De interfaz de usuario

1. Contar una interfaz de usuario simple con un nivel de complejidad bajo el cual sea capaz de ser utilizado incluso por personas con poca experiencia en el uso de e-mail, redes sociales o portales de noticias.
2. Contar con la imagen (colores) y logotipo de la empresa.
3. Toda la interfaz del sistema deberá ser adaptativa en dispositivos móviles.
4. Cuidar la ortografía y redacción de los mensaje del sistema.
5. Mostrar mensajes de retroalimentación claros y concisos.
6. Mostrar mensajes como "No hay elementos" o "No hay información" en aquellas pantallas que no tengan información registrada.
7. Procurar la consistencia visual/gráfica en todas las pantallas del sistema, cuidando estilo de texto, tamaño de fuente, iconos, colores, fuentes, márgenes, etc.
8. Realizar las validaciones de tipo de datos o datos faltantes en aquellos controles o campos de entrada que así lo requieran.

### De seguridad y rendimiento

1. Solo usuarios autenticados y con el rol definido podrán administrar el sistema.
2. El acceso de los usuarios utilizando dirección de correo electrónico personal (único en todo el sistema) y contraseña.
3. Las contraseñas de los usuarios no se almacena en texto plano.
4. Mecanismos de cambio y/o recuperación de contraseña.
5. Las contraseñas de los usuarios deberá ser al menos de 6 caracteres de longitud.
6. Definir o limitar el acceso a las funcionalidades de usuarios de la administración a través de roles o perfiles.
7. Cada registro o actualización de información deberá ser acompañada del usuario, dirección ip, fecha, hora en la que sucedió el evento.
8. Manejo de la validez o caducidad de sesiones de usuario de la administración (principalmente).
9. Contar con mecanismos de seguridad que prevengan exposición indeseada de datos sensibles de personas o propios del negocio. Prevenir puertas traseras que permitan la manipulación de la información.
10. Mantener tiempos de respuesta del sistema menores a 1 segundo (no aplica módulo de consultas)

## Funcionalidades

### Administración de catálogos
1. Usuarios del sistema.
2. Clientes.
3. Sucursales.
4. Países.
5. Estados.
6. Municipios.
7. Localidades.
8. Colonias.
9. Paqueterías.
10. Tipos de paquetes.

### Proceso de negocio
1. Generación de un PDF con información de cotización o envío.
2. Administración de cotizaciones (cliente y pakmail).
3. Administración de envíos (cliente y pakmail).
4. Administración de direcciones.

### Informes y estadísticas
1. Cotizaciones por estado, cliente, destinatario o periodo de tiempo.
2. Envíos por estado, cliente, destinatario, periodo de tiempo o paquetería.  
   
### Globales
1. Login.
2. Control de acceso / sesión.
3. Recuperación de contraseña.
4. Envíos de correos electrónicos.

### Otras tareas
1. Administración de base de datos.
