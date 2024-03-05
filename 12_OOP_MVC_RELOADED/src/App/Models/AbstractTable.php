<?php
namespace App\Models;

abstract class AbstractTable
{
    protected ?int $id = null;
    protected ?string $className = null;

    public function __construct(?int $id = null)
    {
        $this->id = $id;
        $this->setClassName($this);
    }

    public function setClassName(?object $obj): void
    {
        $this->className = get_class($obj);
    }

    public function getClassName(): ?string
    {
        return $this->className;
    }

    public function getAttributes(): ?array
    {
        $attributes = [];
        $filter = ['id', 'className'];
        $class = get_class_vars($this->getClassName());
        foreach ($class as $key => $value) {
            if (!in_array($key, $filter)) $attributes[$key] = $value;{
                $attributes[$key] = $value;
            }
        }
        return $attributes;
    }
}