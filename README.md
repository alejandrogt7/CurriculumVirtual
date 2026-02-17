# 🚀 CurriculumVirtual

**CurriculumVirtual** es una plataforma moderna para la creación y gestión de currículums digitales profesionales.  
Permite centralizar información de contacto, experiencia laboral, formación académica y habilidades bajo una identidad visual coherente y atractiva.

---

## ✨ Funcionalidades

### 📄 Gestión de CV
CRUD completo para:
- Experiencia laboral  
- Educación  
- Habilidades  
- Proyectos  

### 🌐 Directorio de Talentos
Explora perfiles públicos de otros profesionales registrados en la plataforma.

### 👤 Perfil Público
Vista optimizada para compartir con diseño profesional estilo **“Indigo & Bold”**.

### 🔐 Sistema de Autenticación
- Registro de usuarios  
- Inicio de sesión seguro  
- Gestión de cuentas  

---

## 🛠️ Tecnologías Utilizadas

| Área | Tecnología |
|------|------------|
| Backend | Laravel 11 |
| Frontend | Tailwind CSS + Blade Components |
| Interactividad | Alpine.js |
| Base de Datos | MySQL |

---

## 🚀 Instalación en Entorno Local

Sigue estos pasos para ejecutar el proyecto en tu máquina:

### 1️⃣ Clonar el repositorio

```bash
git clone https://github.com/tu-usuario/CurriculumVirtual.git
cd CurriculumVirtual
```

---

### 2️⃣ Instalar dependencias

```bash
composer install
npm install
```

---

### 3️⃣ Configurar entorno

```bash
cp .env.example .env
```

Generar la clave obligatoria de Laravel:

```bash
php artisan key:generate
```

---

### 4️⃣ Configurar base de datos

Asegúrate de configurar correctamente tu base de datos en el archivo `.env`.

Luego ejecuta:

```bash
php artisan migrate
```

Esto creará las tablas necesarias:
- Perfiles
- Habilidades
- Experiencia
- Educación
- Proyectos

---

### 5️⃣ Compilar assets y ejecutar servidor

```bash
npm run dev
php artisan serve
```

---

## 🌍 Acceso a la Aplicación

Una vez iniciado el servidor, abre en tu navegador:

```
http://127.0.0.1:8000
```

---

## 📌 Requisitos Previos

- PHP 8.2+
- Composer
- Node.js 18+
- MySQL
- Laravel CLI

---

