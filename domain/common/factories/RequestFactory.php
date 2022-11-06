<?php declare(strict_types=1);

namespace factories;

use ReflectionNamedType;
use seog\web\RequestAdapterInterface;
use yii\web\BadRequestHttpException;

final class RequestFactory
{
	public function __construct(
        private RequestAdapterInterface $request
    ) {
	}

	public function makeDto(string $className): object
    {
        if (!class_exists($className)) {
            throw new \InvalidArgumentException("Dto class '{$className}' not found.");
        }

        $reflectionObject = new \ReflectionClass($className);
        $object = new $className();
        foreach ($reflectionObject->getProperties() as $reflectionProperty) {
            $propertyName = $reflectionProperty->getName();

            $object->$propertyName = $this->getValueForProperty($reflectionProperty);
        }

        return $object;
    }

    private function getValueForProperty(\ReflectionProperty $reflectionProperty): mixed
    {
        $reflectionType = $reflectionProperty->getType();

        $propertyName = $reflectionProperty->getName();
        $propertyType = (string) $reflectionType;

        $propertyAllowsNull = $reflectionType->allowsNull();
        $valueForPropertyExists = isset($this->request->getBodyParams()[$propertyName]);
        $propertyHasDefaultValue = $reflectionProperty->hasDefaultValue();

        if (!$valueForPropertyExists && !$propertyHasDefaultValue) {
            throw new BadRequestHttpException("Value for '{$propertyName}' required.");
        }

        if (!$propertyAllowsNull && $this->request->getBodyParams()[$propertyName] === null) {
            throw new BadRequestHttpException("Value form '{$propertyName} must not be null.");
        }

        $value = $this->request->getBodyParams()[$propertyName];

        /* Don't set type to null values, it's not necessary */
        if ($propertyAllowsNull && $value === null) {
            return null;
        }

        if ($reflectionType instanceof ReflectionNamedType) {
            settype($param, $reflectionType->getName());
        } else {
            throw new \DomainException(
                "Union types not allowed in property '{$propertyName}' of query class '{$reflectionProperty->class}'"
            );
        }

        return $value;
    }
}
