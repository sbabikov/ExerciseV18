<?php
  
namespace ExerciseV18\Tests;

/**
* PhpUnitUtil class
*/
class PhpUnitUtil
{
    /**
    * Get a private or protected method for testing/documentation purposes
    * 
    * @param object $obj
    * @param string $name
    * @return \ReflectionMethod
    */
    public static function getPrivateMethod($obj, string $name, array $args = null)
    {
        $class = new \ReflectionClass($obj);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        
        return $method->invokeArgs($obj, $args);
    }
}
