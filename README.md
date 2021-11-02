# Proyecto integrador agosto - diciembre 2021

## Materias

1. Ingeniería de Software II
2. Programación Web II

## Problema a resolver

El área de Recursos Humanos de ICAVE tiene la necesidad de implementar un sistema de información que permita el registro, análisis y obtención de resultados de las evaluaciones de desempeño 360° que se aplican a la gerencia media, de una manera ágil, sencilla y automatizada, con el objetivo de alcanzar el desarrollo profesional de los colaboradores en la empresa. Se busca que la herramienta proporcione una retroalimentación que acompañada de alternativas permita ayudarle al evaluado a su desarrollo y éxito profesional.

## Requerimientos funcionales

1. El Personal Encargado (PE) diseña y configura los distintos cuestionarios que se aplicarán. Registra el tipo de pregunta, enunciado y si aplica, las distintas opciones de respuesta. Define la paginación (cantidad de preguntas por página)
2. El PE crea una evaluación en la cual define el cuestionario, evaluado y el evaluador.
3. El sistema envía un correo electrónico a todos los personajes definidos en la evaluación con instrucciones sobre cómo contestar el cuestionario.
4. El evaluador responde las preguntas del cuestionario el cual cuenta con un identificador único y solo permite responderse una vez.
5. El PE verifica el estado de avance de la evaluación.
6. El PE reenvía correo electrónico de instrucciones en caso de ser necesario.
7. El PE determina el cierre de la evaluación e inicia el procesamiento de los resultados.
8. El sistema realiza los cálculos necesarios para la generación de los distintos informes y estadísticas.
9. El PE consulta la información estadística global.
10. El PE imprime o descarga informes detallados sobre un trabajador en particular.

## Requerimientos no funcionales

### Generales

1. Cada uno de los catálogos del sistema deberá contar con las funcionalidades de alta, bajas y cambios, cuidando siempre la intregridad referencial de los datos.
2. Permitir la configuración del texto que será enviado en cada email que envíe el sistema.
3. El usuario administrador podrá realizar la configuración o parametrización del servicio de envío de e-mail (SMTP)
4. La encuesta deberá: 
   1. Contar con una fecha y hora de caducidad.
   2. Mostrar en una o más páginas las preguntas a responder (paginación).
   3. Mostrar al respondiente el porcentaje o información sobre su avance.
   4. Validar que sean respondidas aquellas preguntas que sean obligatorias.
   5. Guardar las respuestas que el respondiente ha registrado.
   6. Permitir reanudar en otro momento al respondiente.
   7. Validar que solo se ha contestada una vez. 
   8. Permitir desactivarla/cancelarla para prevenir sea respondida.
5. Posibilidad de agregar empleados de manera masiva (importar) a través de un archivo csv.
6. Posibilidad de exportación de datos (resultados, puntajes, etc.)

### De interfaz de usuario

1. Contar una interfaz de usuario simple con un nivel de complejidad bajo el cual sea capaz de ser utilizado incluso por personas con poca experiencia en el uso de e-mail, redes sociales o portales de noticias.
2. Contar con la imagen (colores) y logotipo de la empresa.
3. Toda la interfaz del sistema deberá ser adaptativa en dispositivos móviles.
4. Cuidar la ortografía y redacción de los mensaje del sistema.
5. Mostrar mensajes de retroalmentación claros y concisos.
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
2. Empleados.
3. Áreas.
4. Puestos.
5. Niveles.
6. Competencias.
7. Periodo de evaluación.

### Administración de evaluaciones
1. Categorías de preguntas.
2. Banco de preguntas y respuestas.
3. Diseño de cuestionarios.
4. Gestión de evaluaciones.
5. Cuestionario en línea.

### Informes y estadísticas
1. Resultados de un evaluado.
2. Análisis por fortalezas, debilidades y áreas de oportunidad de un evaluado.
3. Informe individualizado (pdf).
4. Histórico comparativo de un evaluado.
5. Consulta de respuestas por cuestonario.   
   
### Globales
1. Login
2. Control de acceso / sesión
3. Recuperación de contraseña

### Otras tareas
1. Administración de base de datos
