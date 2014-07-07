<?php
class PSR4Autoloader
{
    private $namespaces = array();

    public function register()
    {
        spl_autoload_register(array($this, 'load'));
    }

    public function addNamespace($prefix, $dir)
    {
        $prefix = trim($prefix, NS). NS;

        if ( ! isset($this->namespaces[$prefix]) ) {
            $this->namespaces[$prefix] = array();
        }

        if ( ! in_array($dir, $this->namespaces[$prefix]) ) {
            array_push($this->namespaces[$prefix], $dir);
        }
    }

    public function load($class)
    {
        $prefix = $class;

        while (false !== $pos = strrpos($prefix, '\\')) {
            // retain the trailing namespace separator in the prefix
            $prefix = substr($class, 0, $pos + 1);

            // the rest is the relative class name
            $relative_class = substr($class, $pos + 1);

            //try to load a mapped file for the prefix and relative class
            $mapped_file = $this->loadFile($prefix, $relative_class);
            if ($mapped_file) {
                return $mapped_file;
            }

            // remove the trailing namespace separator for the next iteration
            // of strrpos()
            $prefix = rtrim($prefix, NS);
        }

        return false;
    }

    public function loadFile($prefix, $relative_class)
    {
        if( ! isset($this->namespaces[$prefix]) ) {
            return false;
        }

        foreach ($this->namespaces[$prefix] as $dir) {
            $dir            = str_replace('\\', DS, $dir);
            $relative_class = str_replace('\\', DS, $relative_class);

            $file = $dir.DS.$relative_class;

            if( file_exists($file.EXT) )
            {
                require_once($file.EXT);
            }
        }
    }
}
