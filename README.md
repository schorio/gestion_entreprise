## PHP MVC basic templates

### Installation

```sh
# In the root directory
composer install
cd ./public
php -S localhost:8000
```

### les liens dans l'application
* localhost:8000  // pour les visiteurs
* localhost:8000/client // pour les entreprises connectés
* localhost:8000/admin // pour l'administrateur du site

### controlleurs
* doit heriter de la classe Controller
* dans le constructeur, il faut appeler aussi le constructeur parent 

### Models
* doit heriter de la classe Model
* preciser dans le constructeur l'user, le pass et le dbname