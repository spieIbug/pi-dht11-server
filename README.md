# Description
This project is a small web UI/Api that provides real time DHT11 visualization, and API to save Temperature and Humidity data.

This project works with the Python code in this [repository](https://github.com/meyacine/pi-dht11.git) 
# Folders Architecutre
## APIs
All apis are located in the src/Api folder. This folder is structured like this:

## Installation
```
$cd pi
$composer install
$cd webapp
$npm i
```

```
Api
│   Common
│   │
│   └   All Common Classes (Example : A Database provider, A logger, or Exceptions)    
└───Router
│   │   Don't touch this folder it contains all routing logic for the App
│   │ ↓  Router call URI associated Controller 
└─── ⇅ Controllers
│   │   This folder contains All App Controllers which are called by the router
│   │   For the CRUD implements Controller
│   │ ↓  Controllers call services
│   │ Controllers Return results through router   ↑  
└─── ⇅ Services
│   │   This folder contains All App Services for assembling, and disassembling the objects
│   │   For the CRUD implements Service
│   │ ↓  Services call Repositories for database access
│   │ Services Return results through Controllers ↑
└─── ⇅ Repositories
│   │   This folder contains All App Repositories for getting, and persisting objects from/in database
│   │   For the CRUD implements Repository
│   │ ↓ Database access through the DB Singleton
│   │ Repositorie Return results through Services ↑
└─────↳→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→⤴
```
## Database configuration
```
/pi/config/database.json
```
Update it with your custom configuration
```
{
  "host" : "database server url",
  "username" : "username",
  "password" : "pwd",
  "port" : 3306,
  "database_name" : "database name"
}
```