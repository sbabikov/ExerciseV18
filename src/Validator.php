<?php

namespace ExerciseV18;

/**
* Validator class
* @author Sergii Babikov
*/
class Validator
{   
    private $rules;
    
    /**
    * Constructor
    */
    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }
    
    /**
    * Validate data via defined rules
    * 
    * @param mixed $data
    */
    public function validate(array $data): void
    {
        foreach ($this->rules as $field => $rule) {
            if (!empty($rule['required']) && (boolean) $rule['required'] && empty($data[$field])) {
                throw new \DomainException('`' . $field . '` is required value!');
            }
            
            if (!empty($rule['pattern']) && !preg_match($rule['pattern'], $data[$field] ?? '')) {
                throw new \InvalidArgumentException('`' . $field . '` is not correct!');
            }
            
            if (!empty($rule['type']) && $rule['type'] === 'email' && !filter_var($data[$field] ?? '', FILTER_VALIDATE_EMAIL)) {
                throw new \InvalidArgumentException('`' . $field . '` is not correct email value!');
            }
            
            if (!empty($rule['after']) && (empty($data[$rule['after']]) || strtotime($data[$field]) < strtotime($data[$rule['after']]))) {
                throw new \OutOfRangeException('`' . $field . '` must be >= `' . $rule['after'] . '`!');
            }
        }
    }
}
