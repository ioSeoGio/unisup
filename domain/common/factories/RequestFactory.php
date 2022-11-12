<?php declare(strict_types=1);

namespace factories;

use ReflectionNamedType;
use seog\web\RequestAdapter;
use seog\web\RequestAdapterInterface;
use yii\web\BadRequestHttpException;
use yii\web\Request;

final class RequestFactory
{
	public function __construct(
        private RequestAdapterInterface $request
    ) {
	}

    public function makeDtos(string $className): array
    {
        if (empty($this->request->getBodyParams())) {
            throw new BadRequestHttpException('Body params should not be empty.');
        }

        $firstValue = $this->request->getBodyParams()[0];
        if (!is_array($firstValue)) {
            $firstValueType = gettype($firstValue);
            throw new BadRequestHttpException("Array of array expected, got array of '{$firstValueType}'.");
        }

        $dtos = [];
        foreach ($this->request->getBodyParams() as $dataBag) {
            $dtos[] = $this->makeDtoInternal($className, $dataBag);
        }
        return $dtos;
    }

	public function makeDto(string $className): object
    {
        return $this->makeDtoInternal($className, $this->request->getBodyParams());
    }

    private function makeDtoInternal(string $className, array $dataBag): object
    {
        if (!class_exists($className)) {
            throw new \InvalidArgumentException("Dto class '{$className}' not found.");
        }

        $reflectionObject = new \ReflectionClass($className);
        $object = new $className();
        foreach ($reflectionObject->getProperties() as $reflectionProperty) {
            $propertyName = $reflectionProperty->getName();

            $object->$propertyName = $this->getValueForProperty($reflectionProperty, $dataBag);
        }

        return $object;
    }

    private function getValueForProperty(\ReflectionProperty $reflectionProperty, array $dataBag): mixed
    {
        $reflectionType = $reflectionProperty->getType();
        $propertyName = $reflectionProperty->getName();

        $propertyAllowsNull = $reflectionType->allowsNull();
        $valueForPropertyExists = isset($dataBag[$propertyName]);
        $propertyHasDefaultValue = $reflectionProperty->hasDefaultValue();

        if (!$valueForPropertyExists && !$propertyHasDefaultValue) {
            throw new BadRequestHttpException("Value for '{$propertyName}' required.");
        }

        if (!$propertyAllowsNull && $dataBag[$propertyName] === null) {
            throw new BadRequestHttpException("Value form '{$propertyName} must not be null.");
        }

        $value = $dataBag[$propertyName];

        /* Don't set type to null values, it's not necessary */
        if ($propertyAllowsNull && $value === null) {
            return null;
        }

        if ($reflectionType instanceof ReflectionNamedType) {
            settype($value, $reflectionType->getName());
        } else {
            throw new \DomainException(
                "Union types not allowed in property '{$propertyName}' of query class '{$reflectionProperty->class}'"
            );
        }

        return $value;
    }
}
