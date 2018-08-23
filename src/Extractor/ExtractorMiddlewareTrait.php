<?php
namespace Snake\Extractor;

trait ExtractorMiddlewareTrait
{
  // Variables
  private $before = [];
  private $after = [];

  // Set the before middleware
  public function setBefore(array $before): self
  {
    foreach ($before as $callback)
      if (!is_callable($callback))
        throw new \InvalidArgumentException("Middleware must be an indexed array of callables");

    $this->before = $before;
    return $this;
  }

  // Set the after middlafeware
  public function setAfter(array $after): self
  {
    foreach ($after as $callback)
      if (!is_callable($callback))
        throw new \InvalidArgumentException("Middleware must be an indexed array of callables");

    $this->after = $after;
    return $this;
  }

  // Apply the before middleware
  protected function applyBefore(object $object, ...$args): object
  {
    foreach ($this->before as $middleware)
      $object = $middleware($object,...$args);
    return $object;
  }

  // Apply the after middleware
  protected function applyAfter(array $array, ...$args): array
  {
    foreach ($this->after as $middleware)
      $array = $middleware($array,...$args);
    return $array;
  }
}
