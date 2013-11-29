izarusBootstrap3AdminThemePlugin
================================

Plugin Symfony 1.4 que implementa un tema para el generador de admin usando Bootstrap 3

Utilización
-----------

1. Habilitar el plugin en `config/ProjectConfiguration.class.php`:
```
  public function setup()
  {
    $this->enablePlugins(
      [...],
      'izarusBootstrap3AdminThemePlugin'
    );
    [...]
  }
```



2. Aplicar el theme en los `apps/APPNAME/modules/MODULENAME/config/generator.yml`:

````
generator:
  param:
    theme:  bootstrap
````

3. Limpiar el caché

```
$ php symfony cc
```

4. Para crear nuevos módulos con el admin generator y el theme Boostrap:

```
$ php symfony doctrine:generate-admin appname CLASSNAME --theme=bootstrap
```