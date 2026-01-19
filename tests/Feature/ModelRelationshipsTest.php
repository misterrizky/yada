<?php

namespace Tests\Feature;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\File;
use ReflectionClass;
use ReflectionMethod;
use ReflectionNamedType;
use Tests\TestCase;

class ModelRelationshipsTest extends TestCase
{
    public function test_models_define_valid_relations(): void
    {
        $modelFiles = File::allFiles(app_path('Models'));

        foreach ($modelFiles as $file) {
            $relativePath = $file->getRelativePathname();
            $relativeClass = str_replace(['/', '\\'], '\\', $relativePath);
            $relativeClass = preg_replace('/\.php$/', '', $relativeClass);
            $class = 'App\\Models\\' . $relativeClass;

            $this->assertTrue(class_exists($class));

            $reflection = new ReflectionClass($class);
            $instance = $reflection->newInstance();

            foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
                if ($method->getDeclaringClass()->getName() !== $class) {
                    continue;
                }

                if ($method->getNumberOfRequiredParameters() > 0) {
                    continue;
                }

                $returnType = $method->getReturnType();

                if (! $returnType instanceof ReflectionNamedType) {
                    continue;
                }

                $returnTypeName = $returnType->getName();

                if (! is_subclass_of($returnTypeName, Relation::class)) {
                    continue;
                }

                $result = $method->invoke($instance);

                $this->assertInstanceOf(
                    Relation::class,
                    $result,
                    $class . '::' . $method->getName() . ' must return a relation.'
                );
            }
        }
    }
}
