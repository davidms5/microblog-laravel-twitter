
# **1. Introducción**
Este documento describe la **arquitectura y los componentes** utilizados en la implementación de la API. La solución está diseñada para ser escalable, modular y optimizada para lectura.

---

# **2. Arquitectura General**
La aplicación sigue el patrón **Microservicio Modular** utilizando `nwidart/laravel-modules`, separando cada funcionalidad en diferentes modulos.

- **Backend:** Laravel 10 con Laravel Modules.
- **Base de Datos:** MySQL 8.
- **Caché y Optimización:** Redis.
- **Infraestructura:** Docker con Docker Compose.
- **Escalabilidad:** caché de consultas.
- **Persistencia de Datos:** Patrón Repository para separar la lógica de negocio de la capa de acceso a datos.


# **3. Componentes Utilizados**
Utiliza **Laravel Modules** para dividir la lógica en módulos separados:
- **Users** → Manejo de usuarios.
- **Social** → Tweets y relaciones de seguimiento (`Follows`).
- **Timeline** → Carga y optimización del timeline con Redis.

 **Beneficio**: **Código más limpio y desacoplado**, permitiendo agregar nuevas funcionalidades sin afectar el núcleo de la aplicación.

---

### **3.1. MySQL 8 - Base de Datos**
- **Almacena los datos estructurados** (`Users`, `Tweets`, `Follows`).
- **Optimizado con índices** para consultas rápidas en `tweets` y `follows`.

---

### **3.2. Redis - Caché y Optimización**
- **Cachea el timeline del usuario** por 10 minutos.
- **Borra la caché cuando hay un nuevo tweet o follow/unfollow**.
- **Optimiza las lecturas**, reduciendo consultas a MySQL.

---

### **3.3. Docker - Infraestructura Contenerizada**
- Se utiliza **Docker Compose** para gestionar servicios:
  - `app` (Laravel)
  - `nginx` (Servidor web)
  - `db` (MySQL)
  - `redis` (Optimización de lectura)


### **3.4. Patrón Repository**
- **TweetRepository** → Separa la lógica de acceso a los tweets.
- **FollowRepository** → Maneja los follows/unfollows.


# **4. Endpoints**
| **Funcionalidad** | **Método** | **Ruta** | **Descripción** |
|------------------|-----------|----------|----------------|
| **Publicar Tweet** | `POST` | `/social/tweet` | Guarda un nuevo tweet. |
| **Obtener Timeline** | `GET` | `/timeline/show` | Retorna los tweets de usuarios seguidos. |
| **Seguir Usuario** | `POST` | `/social/follow` | Sigue a otro usuario. |
| **Dejar de Seguir** | `POST` | `/social/unfollow` | Deja de seguir a un usuario. |
| **Crear Usuario**  | `POST` | `/usuarios/create-usuario` | crea un usuario |
| **Listar Usuarios** | `GET` | `/usuarios/listar-usuarios` | trae los usuarios registrados |


