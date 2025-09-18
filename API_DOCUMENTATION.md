# API Documentation - VentasFix

## Base URL
```
http://localhost/examenAdolfoCampos/public/api
```

## Autenticación
Esta API utiliza Laravel Sanctum para la autenticación basada en tokens. Después del login, incluye el token en el header de todas las peticiones protegidas:

```
Authorization: Bearer YOUR_TOKEN_HERE
```

## Endpoints Públicos

### POST /register
Registra un nuevo usuario.

**Body:**
```json
{
    "rut": "12345678-9",
    "nombre": "Juan",
    "apellido": "Pérez",
    "email": "juan@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

### POST /login
Inicia sesión y obtiene un token de acceso.

**Body:**
```json
{
    "email": "juan@example.com",
    "password": "password123"
}
```

**Respuesta:**
```json
{
    "success": true,
    "message": "Login exitoso",
    "data": {
        "user": { ... },
        "token": "1|abcd1234..."
    }
}
```

## Endpoints Protegidos (Requieren token)

### Autenticación

#### POST /logout
Cierra sesión (revoca el token actual).

#### GET /me
Obtiene información del usuario autenticado.

#### POST /revoke-all-tokens
Revoca todos los tokens del usuario.

### Usuarios

#### GET /users
Lista todos los usuarios (paginado).

#### GET /users/{id}
Obtiene un usuario específico.

#### POST /users
Crea un nuevo usuario.

**Body:**
```json
{
    "rut": "12345678-9",
    "nombre": "María",
    "apellido": "González",
    "email": "maria@example.com",
    "password": "password123"
}
```

#### PUT /users/{id}
Actualiza un usuario.

#### DELETE /users/{id}
Elimina un usuario.

#### GET /users/search/query?q=texto
Busca usuarios por nombre, apellido, email o RUT.

### Productos

#### GET /products
Lista todos los productos (paginado).

#### GET /products/{id}
Obtiene un producto específico.

#### POST /products
Crea un nuevo producto.

**Body:**
```json
{
    "nombre": "Producto Ejemplo",
    "descripcion": "Descripción del producto",
    "precio": 29.99,
    "stock": 100,
    "categoria": "Electrónicos",
    "codigo": "PROD001"
}
```

#### PUT /products/{id}
Actualiza un producto.

#### DELETE /products/{id}
Elimina un producto.

#### GET /products/search/query?q=texto
Busca productos por nombre, descripción, categoría o código.

#### GET /products/stock/low?threshold=10
Obtiene productos con stock bajo (por defecto <= 10).

#### GET /products/category/filter?categoria=Electrónicos
Filtra productos por categoría.

#### PATCH /products/{id}/stock
Actualiza solo el stock de un producto.

**Body:**
```json
{
    "stock": 150
}
```

### Clientes

#### GET /clients
Lista todos los clientes (paginado).

#### GET /clients/{id}
Obtiene un cliente específico.

#### POST /clients
Crea un nuevo cliente.

**Body:**
```json
{
    "rut": "12345678-9",
    "nombre": "Empresa ABC",
    "email": "contacto@empresa.com",
    "telefono": "+56912345678",
    "direccion": "Av. Principal 123",
    "ciudad": "Santiago",
    "region": "Metropolitana"
}
```

#### PUT /clients/{id}
Actualiza un cliente.

#### DELETE /clients/{id}
Elimina un cliente.

#### GET /clients/search/query?q=texto
Busca clientes por nombre, email, RUT, ciudad o región.

#### GET /clients/region/filter?region=Metropolitana
Filtra clientes por región.

#### GET /clients/city/filter?ciudad=Santiago
Filtra clientes por ciudad.

#### GET /clients/stats/overview
Obtiene estadísticas de clientes.

## Códigos de Respuesta

- **200 OK**: Operación exitosa
- **201 Created**: Recurso creado exitosamente
- **400 Bad Request**: Petición mal formada
- **401 Unauthorized**: Token inválido o faltante
- **404 Not Found**: Recurso no encontrado
- **422 Unprocessable Entity**: Errores de validación
- **500 Internal Server Error**: Error del servidor

## Formato de Respuesta

Todas las respuestas siguen este formato estándar:

### Respuesta exitosa:
```json
{
    "success": true,
    "message": "Operación completada",
    "data": { ... }
}
```

### Respuesta con errores:
```json
{
    "success": false,
    "message": "Descripción del error",
    "errors": {
        "campo": ["Error específico del campo"]
    }
}
```

## Ejemplos de uso con cURL

### Login:
```bash
curl -X POST http://localhost/examenAdolfoCampos/public/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@example.com","password":"password"}'
```

### Obtener usuarios (con token):
```bash
curl -X GET http://localhost/examenAdolfoCampos/public/api/users \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json"
```

### Crear producto:
```bash
curl -X POST http://localhost/examenAdolfoCampos/public/api/products \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -d '{"nombre":"Test Product","precio":99.99,"stock":50,"categoria":"Test"}'
```