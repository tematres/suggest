# TemaTres Value Suggest

Fork de [ValueSuggest](https://github.com/omeka-s-modules/ValueSuggest) para usar la API de TemaTres como fuente de sugerencias en Omeka S.

## Instalación

Instala este módulo en Omeka S como cualquier otro módulo y actívalo desde el panel de administración.

## Configuración

En la configuración del módulo, indica la URL completa al endpoint `services.php` de tu instalación TemaTres. Por ejemplo:

```text
https://vocabularyserver.com/tbci/es/services.php
```

El endpoint predeterminado corresponde al servidor de ejemplo publicado en la documentación de la API. Puedes reemplazarlo por la URL de otra instalación TemaTres, incluida una instalación local accesible desde el servidor de Omeka.

La especificación de la API está disponible en [TemaTres API](https://vocabularyserver.com/apidoc/swagger.json).

## Uso

En una plantilla de recurso, selecciona el tipo de dato **TemaTres**. Al ingresar texto, el módulo consulta `services.php` con la tarea `suggestDetails`, argumento de búsqueda y salida JSON. Al elegir un término, Omeka guarda su etiqueta y un enlace a la página del término (`?tema=ID`) en la instalación configurada.

El módulo registra un solo tipo de dato, `valuesuggest:tematres`; las fuentes de vocabulario del módulo original no se ofrecen en la interfaz.
