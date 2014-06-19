<?php

abstract class Model extends Factory
{
  protected $propertybin;

  public function __construct()
  {
    $this->populate();
  }

  abstract protected function inputs();

  protected function populate()
  {
    foreach ($this->inputs() as $input) {
      $this->has($input);
    }
  }

  public function validate()
  {
    $passes = true;

    foreach ($this->propertybin as $property)
      $passes = $passes && $property->validate();

    return $passes;
  }

  public function has($input)
  {
    $input = Input::get($input);
    $this->propertybin[$input->name] = $input;
    return $this;
  }

  public function __get($name)
  {
    return $this->propertybin[NameRater::forGets($name)]->value;
  }

  public function __set($name, $value)
  {
    $property = $this->propertybin[NameRater::forGets($name)];
    if ($property) {
      $tmp = $property->value;
      $property->setValue($value);
      if ( ! $property->validate()) {
        $property->value = $tmp;
        return false;
      } else {
        return $value;
      }
    }
  }
}
