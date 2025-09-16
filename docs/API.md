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



## Gestión de CV (Experiencia, Formación, Idiomas, Datos Extra)

Todas las rutas requieren autenticación con token (Bearer Token en el header Authorization).

### Añadir experiencia
**Endpoint:** `POST /api/cv/experiencia`

**Body JSON:**
```json
{
  "titulo": "Camarero",
  "compania": "Hotel Luna",
  "inicio_mes": 6,
  "inicio_ano": 2022,
  "fin_mes": 8,
  "fin_ano": 2023,
  "ciudad": "Barcelona",
  "pais": "España"
}
```

### Modificar experiencia
**Endpoint:** `PUT /api/cv/experiencia/{id}`

**Body JSON:** (solo los campos a modificar)
```json
{
  "titulo": "Jefe de sala"
}
```

### Eliminar experiencia
**Endpoint:** `DELETE /api/cv/experiencia/{id}`

---

### Añadir formación
**Endpoint:** `POST /api/cv/formacion`

**Body JSON:**
```json
{
  "titulo": "Grado en Turismo",
  "institucion": "UB",
  "inicio_mes": 9,
  "inicio_ano": 2020,
  "fin_mes": 6,
  "fin_ano": 2024
}
```

### Modificar formación
**Endpoint:** `PUT /api/cv/formacion/{id}`

**Body JSON:** (solo los campos a modificar)
```json
{
  "titulo": "Máster en Dirección Hotelera"
}
```

### Eliminar formación
**Endpoint:** `DELETE /api/cv/formacion/{id}`

---

### Añadir idioma
**Endpoint:** `POST /api/cv/idioma`

**Body JSON:**
```json
{
  "idioma": "Inglés",
  "nivel": "B2"
}
```

### Modificar idioma
**Endpoint:** `PUT /api/cv/idioma/{id}`

**Body JSON:**
```json
{
  "nivel": "C1"
}
```

### Eliminar idioma
**Endpoint:** `DELETE /api/cv/idioma/{id}`

---

### Añadir dato extra
**Endpoint:** `POST /api/cv/dato-extra`

**Body JSON:**
```json
{
  "tipo": "Carnet de conducir",
  "valor": "B"
}
```

### Modificar dato extra
**Endpoint:** `PUT /api/cv/dato-extra/{id}`

**Body JSON:**
```json
{
  "valor": "B y A2"
}
```

### Eliminar dato extra
**Endpoint:** `DELETE /api/cv/dato-extra/{id}`

---

**Notas:**
- No es necesario enviar el user_id, se toma automáticamente del usuario autenticado por el token.
- Solo puedes modificar/eliminar tus propios registros.