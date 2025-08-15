<div align="center">
  <img src="public/images/logo_completo.png" alt="CyberPharma Logo" width="200"/>
  <h1><strong>CyberPharma - Sistema de Gestión para Droguerías</strong></h1>
</div>

---

### **📖 INTRODUCCIÓN**

**CyberPharma** es un sistema de gestión de inventario y ventas diseñado específicamente para droguerías y farmacias. Desarrollado sobre **Laravel** y potenciado por el panel de administración **FilamentPHP**, esta aplicación ofrece una solución robusta, rápida y totalmente en español para el control total de tu negocio.

El sistema está construido sobre un potente sistema de **Roles y Permisos** basado en `spatie/laravel-permission`, permitiendo una gestión segura y granular del acceso para diferentes tipos de usuarios (Administrador, Vendedor, Bodeguista, etc.).

---

### **🚀 CARACTERÍSTICAS PRINCIPALES**

- ✅ **Autenticación Segura:** Sistema de inicio de sesión por roles con control de acceso al panel.
- ✅ **Gestión de Roles y Permisos Visual:** Interfaz de administración para crear roles y asignar permisos a cada módulo (ver, crear, editar, borrar) sin tocar una línea de código.
- ✅ **Dashboard Inteligente:**
    - **Indicadores Clave (KPIs):** Alertas de bajo stock y productos próximos a vencer en tiempo real.
    - **Métricas de Negocio:** Conteo de compras e ingresos totales del mes.
    - **Análisis Visual:** Gráfico de ventas de la última semana y tabla de actividad de ventas reciente.
- ✅ **Módulos de Gestión Completos (CRUDs):**
    - **Administración:** Gestión completa de Usuarios y sus Roles.
    - **Inventario:** Log detallado de cada movimiento de stock (entradas, salidas, ajustes).
    - **Productos:** Control total sobre el catálogo de productos (proveedor, stock, lote, vencimiento).
    - **Transacciones:** Módulos para registrar Ventas, Compras, Pedidos a proveedores y Facturas.
    - **Catálogos:** Gestión centralizada de Proveedores, Estados y Medidas de Productos.
- ✅ **Lógica de Negocio Automatizada:**
    - El **stock se actualiza automáticamente** con cada venta, compra o pedido recibido.
    - Los **formularios de venta son reactivos**: el precio se autocompleta y el total se calcula en tiempo real.
- ✅ **Exportación de Datos:** Funcionalidad para exportar listados a **Excel y PDF**.

---

### **🛠️ INSTALACIÓN**

Para poner en marcha el proyecto en un entorno de desarrollo local, sigue estos pasos:

1.  **Clona el repositorio:**
    ```bash
    git clone https://github.com/javier-devco/cyberpharma.git
    ```
2.  **Navega al directorio del proyecto:**
    ```bash
    cd cyberpharma
    ```
3.  **Instala las dependencias de PHP:**
    ```bash
    composer install
    ```
4.  **Instala las dependencias de Frontend:**
    ```bash
    npm install
    ```
5.  **Crea tu archivo de entorno:**
    ```bash
    cp .env.example .env
    ```
6.  **Genera la clave de la aplicación:**
    ```bash
    php artisan key:generate
    ```
7.  **Configura tu base de datos** en el archivo `.env`.
8.  **Ejecuta las migraciones y llena la base de datos con datos de prueba:**
    ```bash
    php artisan migrate:fresh --seed
    ```
9.  **Compila los archivos de frontend:**
    ```bash
    npm run build
    ```
10. **Lanza el servidor de desarrollo:**
    ```bash
    php artisan serve
    ```

---

### **💻 TECNOLOGÍAS UTILIZADAS**

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![FilamentPHP](https://img.shields.io/badge/FilamentPHP-F59E0B?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-77C1D2?style=for-the-badge&logo=alpine.js&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)

---

### **👤 AUTOR**

*   **Javier Quiroz** - *Desarrollador Principal*