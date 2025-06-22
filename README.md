---
# 🔄 RollbackAPI

Una API avanzada para gestionar eventos de *rollback* en servidores PocketMine-MP. Diseñada para desarrolladores que buscan registrar, guardar y restaurar eventos importantes (como los drops de un jugador al morir) de forma segura, modular y eficiente.

---

## 📦 Requisitos

- 🧠 PHP 8.1 o superior  
- ⚙️ PocketMine-MP 5.x  
- 🧩 Plugins externos que requieran esta API como dependencia  

---

## 🚀 Instalación

> ⚠️ Esta API **no es un plugin independiente**. Debe ser incluida como parte del código de otros plugins.

1. Clona o descarga este repositorio.
2. Copia la carpeta `RollbackAPI/` dentro del directorio `src/` de tu plugin:
```

plugins/
└── TuPlugin/
└── src/
└── RollbackAPI/

````
3. Asegúrate de mantener la estructura y namespaces.
4. Registra la API al iniciar tu plugin:

```php
use RollbackAPI\Register;

public function onEnable(): void {
 if (!Register::isRegister()) {
     Register::register();
 }
}
````

---

## 🧠 ¿Qué hace esta API?

* Intercepta el evento `PlayerDeathEvent` y dispara automáticamente un evento personalizado `RollbackEvent`.
* Guarda los ítems perdidos del jugador en un archivo `rollback.json`.
* Permite a otros plugins consultar, restaurar o eliminar estos datos.

---

## 🛠️ Uso para desarrolladores

### 🔁 Manejar el evento personalizado

```php
use RollbackAPI\events\RollbackEvent;

public function onRollback(RollbackEvent $event): void {
    $player = $event->getPlayer();
    $items = $event->getItems();

    $player->sendMessage("Tus ítems fueron guardados para rollback.");
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
│   ├── Events.php              ← Manejador del evento de muerte y el RollbackEvent
│   └── RollbackEvent.php      ← Evento personalizado disparado al morir el jugador
├── storages/
│   └── RollbackStorage.php    ← Manejo de almacenamiento persistente JSON
├── Register.php               ← Registro estático de la API para plugins externos
```

---

## 📌 Ejemplo de flujo

1. El jugador muere.
2. El `PlayerDeathEvent` es interceptado y lanza un `RollbackEvent`.
3. Los ítems y datos del jugador se guardan automáticamente.
4. Otros plugins pueden escuchar `RollbackEvent` y trabajar con esos datos.

---

## 🧪 ¿Por qué usar esta API?

* 📋 Simplifica la comunicación entre plugins y la gestión de inventarios perdidos.
* 📁 Guarda los datos en formato estructurado con `Config::JSON`.
* ⚡ Ligera, eficiente y basada en el sistema de eventos nativo de PocketMine.

---

## 👤 Autor

* 👨‍💻 Creador: `404_Shad0w`
* 💬 Discord: [Click aquí](https://discord.com/users/1177436591761932328)

---

## 📝 Licencia

Este proyecto está bajo la licencia **MIT**. Puedes usarlo, modificarlo y distribuirlo libremente en tus propios plugins.