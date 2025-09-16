## Registro de usuario

**Endpoint:** `POST /api/auth/register`

Registra un nuevo usuario asociado a un hotel y envía un email con el PIN necesario para crear el usuario.

### Ejemplo de JSON de petición actualizado

```json
{
  "email": "arnau.bs1512004@gmail.com",
  "password": "Arnau_2004",
  "hotel_token": "luna456a",
  "name": "Arnau",
  "rol": "EMPLEADOS",
  "apellidos": "Barrero",
  "telefono": "674973992"
}
```



## Verificar PIN de usuario

**Endpoint:** `POST /api/auth/verify-pin`

Verifica si el PIN introducido para el email es correcto. Si es correcto, marca el email como verificado (`email_verified_at`).

### Ejemplo de JSON de petición

```json
{
  "email": "arnau.bs1512004@gmail.com",
  "pin": "456455"
}
```




## Login de usuario

**Endpoint:** `POST /api/auth/login`

Autentica a un usuario y devuelve un token de sesión para usar en las siguientes peticiones.

### Ejemplo de JSON de petición

```json
{
  "email": "arnau.bs1512004@gmail.com",
  "password": "Arnau_2004"
}
```




## Recuperar contraseña (Forgot Password)

### 1. Solicitar cambio de contraseña

**Endpoint:** `POST /api/auth/request-change-password`

#### Ejemplo de JSON de petición
```json
{
  "email": "arnau.bs1512004@gmail.com"
}
```

---

### 2. Confirmar cambio de contraseña

**Endpoint:** `POST /api/auth/confirm-change-password`

#### Ejemplo de JSON de petición
```json
{
  "email": "arnau.bs1512004@gmail.com",
  "pin": "123456",
  "password": "NuevaPassword123",
  "password_confirmation": "NuevaPassword123"
}
```