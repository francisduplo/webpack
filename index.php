<?php
    include 'functions.php';
?>
<!doctype html>
<html>
<head>
    
    <!--META-->
    <meta charset="UTF-8">
    <meta name="viewport" content = "width = device-width, initial-scale = 1.0, user-scalable = no" />
    <!--META-->
    
    <title>Webpack – DUPLO</title>
    
    <!--STYLES-->
    <link rel="stylesheet" href="<?=getPath('app','css')?>">
    <!--STYLES-->
    
</head>

<body>
    
    <div id="wrapper">
        
        <h1>Proyecto con webpack</h1>
        <p>Este documento pretende servir de guía para empezar proyectos con Webpack.</p>
        
        <h2><span>1</span>Copiar los archivos:</h2>
        <p>Se deberán copiar los siguientes archivos a la carpeta de nuestro proyecto:</p>
        <ul>
            <li><strong>package.json</strong></li>
            <li><strong>webpack.config.js</strong></li>
        </ul>
        <p>Una vez copiados deberemos adaptarlo a nuestro proyecto con la información relativa al cliente. Duplo debe figurar como el autor pero el cliente y el proyecto deben figurar en la infrmación general.</p>
        <p>Abrimos <strong>package.json</strong> y en la parte superior encontramos los detalles del proyecto:</p>
        <pre lang="javascript" class="not-important fragment-top">{
    <span class="important">name": "duplo",</span>
    <span class="important">version": "1.0.0",</span>
    <span class="important">description": "Duplo webpack files",</span>
    "scripts": {
        "dev": "webpack-dev-server --progress --hide-modules --mode development",
        "build": "webpack --progress --hide-modules --mode production"
    },
    "author": {
        <span class="important">"name": "duplo",</span>
        <span class="important">"email": "pol@duplodigital.com",</span>
        <span class="important">"url": "https://duplodigital.com"</span>
    },
	"license": "MIT",
	"browserslist": [
		"last 2 major version",
		"> 1%"
	],
        </pre>
        <p>Deberemos sustituir los valores por defecto de duplo por los adecuados para el proyecto.</p>
        
        <p>Antes de instalar es recomendable repasar las dependencias adicionales que se llamarán y si realmente son necesarias para este proyecto. Por defecto cargamos las siguientes:</p>
        <pre lang="javascript">
    "dependencies": {
        "@fancyapps/fancybox": "^3.5.7",
        "@fortawesome/fontawesome-free": "^5.6.0",
        "animate.css": "^3.7.0",
        "balance-text": "^3.3.0",
        "bootstrap": "^4.1.3",
        "fitvids": "^2.1.1",
        "jquery": "^3.5.1",
        "jquery-match-height": "^0.7.2",
        "jquery-ui-bundle": "^1.12.1-migrate",
        "jquery-ui-touch-punch": "^0.2.3",
        "load-google-maps-api": "^1.3.2",
        "owl.carousel2": "^2.2.1",
        "popper.js": "^1.14.5",
        "reset-css": "^4.0.1",
        "select2": "^4.0.13"
    }
</pre>
        <p>Si hay alguna que no sabemos para qué sirve o creemos que no es necesario la quitaremos (ya que sino consumirá recursos innecesarios). Por ejemplo: Si sabemos que es proyecto en el que no usaremos <strong>Bootstrap</strong>, borraremos la línea de la dependencia y listos. Si después d ela instalación queremos volver a incluir la dependencia debemos hacerlo con un <em>install</em>, que tendremos que buscar la documentación en Google.</p>
        
        <p>Abrimos el documento de <strong>webpack.config.js</strong> y sólo debermeos sustituir un valor (aproximádamente en la línea 164) con el nombre del host que hemos creado con <strong>MAMP</strong>:</p>
        <pre lang="terminal" class="not-important fragment-middle">
    }]
    },
    devServer: {
        contentBase: [path.join(__dirname, 'resources'), path.join(__dirname, 'src')],
        port: 8080,
        allowedHosts: [
            <span class="important">'duplo'</span>
        ],
        overlay: {
            warnings: true,
            errors: true
        },
        </pre>
        
        <h2><span>2</span>Instalar webpack</h2>
        <p>Ahora se deberá instalar webpack con lo siguientes comandos en terminal:</p>
        <pre lang="terminal">npm i</pre>
        <p>En el caso que no tengamos node nosa saldrá un mensaje cómo éste <code>-bash: node: command not found</code>, eso quiere decir que no tenemos <strong>node.js</strong> instalado. Deberemos instalarlo siguiento estos pasos: <a href="javascript:void(0);" data-showid="nodejs">Mostrar</a></p>
        <div id="nodejs" style="display: none;">
            <ol>
                <li>Ir a <a href="https://nodejs.org/" target="_blank">nodejs.org</a> y descragar la última versión estable (con la etiqueta <em>Recommended For Most Users</em>).</li>
                <li>Instalar el paquete que nos descargamos.</li>
                <li>Cerramos Terminal si lo teníamos abierto y lo volvemos a abrir.</li>
                <li>Comprobamos si se ha instalado correctamente con el comando <code>node -v</code>.</li>
                <li>Si nos devuelve una versión es que se ha instalado correctamente.</li>
                <li>Actualizamos a la últmia versión por si acaso con el comando <code>npm i -g npm</code>.</li>
            </ol>
        </div>
        <p>Si nos pide alguna dependencia bastará con poner en Google <em>npm install</em> y el nombre del <em>package</em> y nos saldrá la forma de instalar la dependencias que nos falten.</p>
        <p>Hay veces que después de instalar o de compilar nos muestra un mensaje cómo este:</p>
        <pre lang="terminal">found 335 vulnerabilities (333 low, 1 moderate, 1 high)
run `npm audit fix` to fix them, or `npm audit` for details</pre>
        <p>Por si a caso ejecutaremos el comando <code>npm audit fix</code> y veremos que se solucionanrán algunas vulnerabilidades.</p>
        
        <h2><span>3</span>LLamada de los assets en los documentos php o html</h2>
        <p>Para poder llamar correctamente los archivos de css y js se debrá hacer de forma dinámica para que si estamos en local (desarrollo) o en servidor (producción) funcionen automáticamente. Par ello hay una función en el archivo function.php (qué incluiremos con un <em>include</em> de PHP, el caso de <strong>Wordpress</strong> lo pondremos el functions.php de la plantilla):</p>
        <pre lang="php">&lt;?php 
function getPath($file, $ext){
	if ($_SERVER['HTTP_HOST'] == 'duplo') {
		if ($ext == 'css') $folder = 'css/'; else $folder = '';
		$root = 'http://localhost:8080/assets/';
		return $root . $folder . $file . '.' . $ext;
	} else {
		$root = './';
		$assets = json_decode(file_get_contents('assets/assets.json'));

		return $root . $assets->$file->$ext;
	}
}
?&gt;</pre>
        <p>Dónde pone <code>$_SERVER['HTTP_HOST'] == 'duplo'</code> se deberán sustituir duplo por nuestro host creado con MAMP.</p>
        <p>Cuando montamos webpack en un wordpress deberemos modificar un poco la ruta de los assets:</p>
        <pre lang="php" class="not-important fragment-middle">
		if ($ext == 'css') $folder = 'css/'; else $folder = '';
		$root = 'http://localhost:8080/assets/';
		return $root . $folder . $file . '.' . $ext;
	} else {
		<span class="important">$root = get_bloginfo('template_url');</span>
		<span class="important">$assets = json_decode(file_get_contents(str_replace(get_bloginfo('url'),'.',get_bloginfo('template_url')).'/assets/assets.json'));</span>

		return $root . $assets->$file->$ext;
	}</pre>
        <p>Luego llamaremos en nuestro archivo php/html los assets para que se cargen las rutas con la anterior función de PHP.</p>
        <p>Llamaremos el archivo de CSS en el <code>&lt;head&gt;</code>:</p>
        <pre lang="php">&lt;link rel="stylesheet" href="&lt;?=getPath('app','css')?&gt;"&gt;</pre>
        <p>Llamaremos el archivo de JS antes de cerrar la etiqueta de <code>&lt;body&gt;</code>:</p>
        <pre lang="php">&lt;script src="&lt;?=getPath('app','js')?&gt;"&gt;&lt;/script&gt;</pre>
        
        <h2><span>4</span>Crear los archivos de <em>resources</em></h2>
        <p>Para trabajar con webacpack necesitamos crear una série de carpetas en los que se van a ubicar tanto los archivos JS, CSS, fuentes e imágenes. Vamos a tener una estructura básica cómo ésat:</p>
        <ul class="files">
            <li><span class="folder">resources</span>
                <ul>
                    <li><span class="folder">fonts</span>
                        <ul>
                            <li><span class="file">font.ttf</span></li>
                            <li><span class="file">font.woff</span></li>
                            <li><span class="file">font.woff2</span></li>
                        </ul>
                    </li>
                    <li><span class="folder">img</span>
                        <ul>
                            <li><span class="file">image.gif</span></li>
                            <li><span class="file">image.jpg</span></li>
                            <li><span class="file">image.png</span></li>
                        </ul>
                    </li>
                    <li><span class="folder">js</span>
                        <ul>
                            <li><span class="file">app.js</span></li>
                            <li><span class="file">secundario.js</span></li>
                        </ul>
                    </li>
                    <li><span class="folder">scss</span>
                        <ul>
                            <li><span class="file">_secundario.scss</span></li>
                            <li><span class="file">app.scss</span></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <ul class="legend">
                <li><span class="folder">carpeta</span></li>
                <li><span class="file">archivo</span></li>
            </ul>
        </ul>
        <p>Vamos a crear diferentes archivos de <em>scss</em> para favorecer una buena organización (se recomienda uno por página). También se recomienda usar una <em>scss</em> para elemntos comunes,  otro para mixins y otro para fuentes.</p>
        <p>En la raíz de está página se puede ver un ejemplo de estructura y de archivos.</p>
        
        <h2><span>5</span>Empezar a utilizar webpack</h2>
        <p>Una vez tenemos tod instalado y configurado podemos empezar a utilizar webpack para nuestro proyecto.</p>
        <p>Dónde hayamos hecho la instalación podremos usar el siguiente comando para trabajar en local con <strong>MAMP</strong>:</p>
        <pre lang="terminal">npm run dev</pre>
        <p>Para compilar para subir al servidor es muy parecido:</p>
        <pre lang="terminal">npm run build</pre>
        <p>Hay veces que el build no acaba de salir bien. ¿Cómo lo sabemos? Si lo subimos y se vé cómo si no tuviera CSS eso quiere decir que no ha hecho bien la compilación. Sencillamente volvemos a compilar y a subir. <strong class="very-important">SIEMPRE hay que comprobar que funciona la web una vez compilado y subido.</strong></p>
        
        <h2><span>6</span>Subir lo sarchivos al servidor</h2>
        <p>Siempre en algún punto del desarrollo de una web llega el momento de subir la web para que la puedan ver otros usuarios y no sólo el desarrollador (ya sea cleinte u otros miembros del equipo). Es recomendable subir versiones acabadas (al menos a nivel de bloques no toda la web entera) para que los usuarios no vean elementos rotos.</p>
        <p>Cuando subamos un proyectos deberemos subir <strong class="very-important">todos los archivos menos la carpeta de <code>node_modules</code></strong>. Esta carpeta contiene todas las dependencias y sólo se usa para desarrollo. Nunca debemos subir a un servidor o a un respotorio. Si inicializamos un respotorio (GIT) deberemos poner un <code>git_ignore</code> a esta carpeta antes de hacer el primer <em>push</em>.</p>
        
        <h2>Añadirse a un proyecto ya inicializado</h2>
        <p>Hay veces que no stenemos que meter en un proyecto que no hemos ni instalado ni inicializado nosotros. Para ello debemos seguir estos pasos:</p>
        <ol>
            <li>Nos descragamos del servidor todos los archivos que tenemos del proyecto.</li>
            <li>Nos aseguramos que tenemos tanto el <strong>package.json</strong> como el <strong>webpack.config.js</strong> (si no los pedimos al responsable del proyecto). Si en vez de seervidor tenemos un respositorio es referible usar la versión del respositorio, la versión del servidor puede no ser la última.</li>
            <li>Vamos al paso 2 de este documento (deberemos saltar los pasos que ya haya hecho la persona que inicializó el proyecto).</li>
        </ol>
        <p>Al final lo único que cambia es la optención de los documentos.</p>
    </div>
    <div class="copyright">
        <p><strong>DUPLO</strong> @ Barcelona <?=date('Y')?></p>
    </div>
    
    
    <!--SCRIPTS-->
    <script src="<?=getPath('app','js')?>"></script>
    <!--SCRIPTS-->
    
</body>
</html>