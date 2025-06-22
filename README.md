---

# 🔄 RollbackAPI

Una API avanzada para gestionar eventos de *rollback* en servidores PocketMine-MP. Diseñada para desarrolladores que buscan registrar, guardar y restaurar eventos importantes (como drops de muerte) de manera segura, modular y optimizada.

---

## 📦 Requisitos

- 🧠 PHP 8.1 o superior  
- ⚙️ PocketMine-MP 5.x  
- 🧩 Plugins externos que quieran usar esta API  

---

## 🚀 Instalación

1. Descarga el plugin como `.phar` o clona el repositorio.
2. Coloca el archivo en la carpeta `/plugins/` de tu servidor.
3. Reinicia PocketMine o usa el comando `/reload`.

---

## 🧠 ¿Qué hace esta API?

- Interviene en el `PlayerDeathEvent` y genera un evento propio llamado `RollbackEvent`.
- Almacena automáticamente los ítems que el jugador pierde al morir en el archivo `rollback.json`.
- Permite a otros plugins consultar, restaurar o eliminar estos datos de forma sencilla.

---

## 🛠️ Uso para desarrolladores

### ✅ Registrar la API

```php
use RollbackAPI\Register;

public function onEnable(): void {
    if (!Register::isRegister()) {
        Register::register();
    }
}
```

### 🔁 Cómo manejar el evento personalizado

```php
use RollbackAPI\events\RollbackEvent;

public function onRollback(RollbackEvent $event): void {
    $player = $event->getPlayer();
    $items = $event->getItems();

    $player->sendMessage("Se han guardado tus objetos para posible rollback.");
}
```

### 💾 Acceder a los datos guardados

```php
use RollbackAPI\storages\RollbackStorage;

$data = RollbackStorage::getRollbackData("PlayerName");

if ($data !== null) {
    // Procesar $data['items'], $data['date'], $data['id'], etc.
}
```

### 🗑️ Eliminar rollback existente

```php
RollbackStorage::removeRollbackData("PlayerName");
```

---

## 📂 Estructura de archivos

```
RollbackAPI/
├── events/
│   ├── Events.php              ← Manejador principal del sistema de eventos
│   └── RollbackEvent.php      ← Evento personalizado para sistemas externos
├── storages/
│   └── RollbackStorage.php    ← Gestión de archivos JSON para los rollbacks
├── Register.php               ← Control de registro estático de la API
```

---

## 📌 Ejemplo de flujo

1. El jugador muere.
2. Se activa el `PlayerDeathEvent`, que dispara internamente un `RollbackEvent`.
3. Los ítems y datos del jugador se guardan automáticamente.
4. Cualquier plugin que esté registrado puede interceptar el `RollbackEvent` y actuar sobre él.

---

## 🧪 ¿Por qué usar esta API?

* 📋 Facilita la integración entre plugins que necesitan controlar inventarios perdidos o manejar datos post-muerte.
* 📁 Almacena los datos de forma persistente y estructurada usando `Config::JSON`.
* ⚡ Diseño modular, rápido y centrado en la arquitectura de eventos de PocketMine.

---

## 👤 Autor

* 👨‍💻 Creador: `404_Shad0w`
* 💬 Discord: [Click aquí](https://discord.com/users/1177436591761932328)

---

## 📝 Licencia

Este proyecto está bajo la licencia **MIT**. Puedes usarlo, modificarlo y distribuirlo libremente en tus proyectos.

---
