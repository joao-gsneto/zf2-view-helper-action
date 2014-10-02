Zf2 Action View Helper
======================

Use this View Helper to render a controller action inside your template.

Usage
====


File:

** view/index/index.phtml **
```
<?php 
$this->action( 'MySite\MyController', 'customaction', array( 'p' => 1 ) ); 
?>
```
*On modules.config.php file*

```
return array( 
   (...)
   'view_helpers' => array(
        'invokables' => array(
            'action' => 'Barato\View\Helper\Action',
        ),
 );
```

Using Twig (I recommend =) )

```
{{ action('Mysite\MyController', 'customaction', { p: 1 }) }}
```

Please note that namespace need to be changed to work on your App system names, like "YouBusiness\Library\Helpers".

Enjoy!

Tags:
* Zend Framework dispatch controller on view.
* Zend 2 $this->action()
* Zend Framework 2 Action Helper

For Twig integration, use Zf-Commons/ZfcTwig module for Zf2.