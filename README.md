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

- Escucha eventos como `PlayerDeathEvent` y los transforma en un evento personalizado `RollbackEvent`.
- Guarda los ítems perdidos por el jugador en un archivo `rollback.json`.
- Permite a otros plugins obtener, restaurar o eliminar esta información fácilmente.

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

🔁 Escuchar el evento personalizado
Copiar código
```php
use RollbackAPI\events\RollbackEvent;

public function onRollback(RollbackEvent $event): void {
    $player = $event->getPlayer();
    $items = $event->getItems();

    $player->sendMessage("Se han guardado tus objetos para posible rollback.");
}
```

💾 Acceder a los datos guardados
```php
use RollbackAPI\storages\RollbackStorage;

$data = RollbackStorage::getRollbackData("PlayerName");

if ($data !== null) {
    // Procesar $data['items'], $data['date'], $data['id'], etc.
}
```

🗑️ Eliminar rollback existente
```php
RollbackStorage::removeRollbackData("PlayerName");
```

📂 Estructura de archivos
```php
RollbackAPI/
├── events/
│   ├── Events.php              ← Listener principal
│   └── RollbackEvent.php      ← Evento personalizado
├── storages/
│   └── RollbackStorage.php    ← Guardado y recuperación de datos
├── Register.php               ← Registro estático de la API

```

📌 Ejemplo de flujo
El jugador muere.

El PlayerDeathEvent dispara un RollbackEvent.

Los datos del jugador y los ítems se guardan automáticamente.

Otros plugins pueden reaccionar al evento o consultar los datos almacenados.

🧪 ¿Por qué usar esta API?
📋 Facilita la integración entre plugins que requieren acceso a drops o eventos críticos.

📁 Almacenamiento persistente y estructurado con Config::JSON.

⚡ Ligera, rápida y totalmente basada en eventos del núcleo de PocketMine.

👨‍💻 Creador: 404_Shad0w

💬 Discord:  [Click Here](https://discord.gg/users/1177436591761932328)

📝 Licencia
Este proyecto está bajo la licencia MIT. Puedes usarlo, modificarlo y distribuirlo libremente en tus proyectos.