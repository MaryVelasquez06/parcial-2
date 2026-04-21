Integrantes: Ariel Esau Yanes Quintanilla
             Marielena Velasquez Escobar

             usuario: admin
             contra: admin

1. ¿Cómo manejan la conexión a la BD y qué pasa si algunos de los datos son incorrectos? Justifiquen la manera de validación de la conexión.

La conexión a la base de datos se maneja con PHP PDO en el archivo config.php, donde se definen el servidor,el nombre de la base, el usuario,
la contraseña y el puerto. Además, se usa un bloque try-catch para detectar si ocurre algún error al conectarse.

Si la conexión falla, el sistema muestra un mensaje de error y evita que la aplicación continúe con problemas. Si algunos datos ingresados son incorrectos, 
no se guardan en la base de datos, porque antes se validan campos obligatorios, formato de correo, longitud y tipo de dato. 
Esto ayuda a mantener la información correcta y evita errores en el sistema.

2. ¿Cuál es la diferencia entre $_GET y $_POST en PHP? ¿Cuándo es más apropiado usar cada uno? Da un ejemplo real de tu proyecto.

La diferencia principal es que $_GET envía los datos por medio de la URL, mientras que $_POST los envía de forma oculta en el formulario.

$_GET se usa más cuando se quieren consultar datos o pasar información sencilla en la dirección web.
$_POST se usa cuando se van a enviar datos importantes o sensibles, por ejemplo en formularios de inicio de sesión o de registro.

En nuestro proyecto usamos $_POST en el login y en el formulario para registrar estudiantes,
porque ahí se envían datos como usuario, contraseña, nombres, apellidos, teléfono y carrera, y no es recomendable mostrarlos en la URL.

3. Tu app va a usarse en una empresa de la zona oriental. ¿Qué riesgos de seguridad identificas en una app web con BD que maneja datos de los usuarios? ¿Cómo los mitigarían?

Uno de los principales riesgos es la inyección SQL, donde una persona podría intentar escribir código malicioso en los formularios
para alterar la base de datos. Para evitarlo, usamos consultas preparadas con PDO.

Otro riesgo es el acceso no autorizado, es decir, que alguien entre al sistema sin permiso. Para mitigarlo,
usamos inicio de sesión y sesiones en PHP para restringir el acceso al panel administrativo.

También existe el riesgo de ingresar datos falsos o inválidos. Por eso validamos los campos antes de guardarlos.
Además, se debe proteger la información del usuario y evitar mostrar errores técnicos completos en pantalla para no exponer detalles internos del sistema.

4. Diccionario de datos
## 4. Diccionario de datos

### Tabla: usuarios

| Columna | Tipo de dato | Límite de caracteres | ¿Es nulo? | Descripción |
|---------|---------------|---------------------|-----------|-------------|
| id | INT | 11 | No | Identificador único del usuario |
| nombre | VARCHAR | 100 | No | Nombre completo del usuario |
| usuario | VARCHAR | 50 | No | Nombre de usuario para iniciar sesión |
| clave | VARCHAR | 255 | No | Contraseña del usuario |
| rol | VARCHAR | 20 | No | Rol o tipo de usuario |

---

### Tabla: estudiantes

| Columna | Tipo de dato | Límite de caracteres | ¿Es nulo? | Descripción |
|---------|---------------|---------------------|-----------|-------------|
| id | INT | 11 | No | Identificador único del estudiante |
| nombres | VARCHAR | 100 | No | Nombres del estudiante |
| apellidos | VARCHAR | 100 | No | Apellidos del estudiante |
| correo | VARCHAR | 100 | Sí | Correo electrónico (puede ir nulo) |
| telefono | VARCHAR | 20 | No | Número telefónico |
| carrera | VARCHAR | 100 | No | Carrera seleccionada |
| sexo | ENUM | 20 | No | Sexo del estudiante |
| beca | TINYINT | 1 | No | Indica si aplica a beca |
| fecha_registro | TIMESTAMP | - | No | Fecha de registro |
