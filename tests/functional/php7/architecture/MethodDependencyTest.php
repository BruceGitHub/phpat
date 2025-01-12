<?php

namespace Tests\PhpAT\functional\php7\architecture;

use PhpAT\Rule\Rule;
use PhpAT\Selector\Selector;
use PhpAT\Test\ArchitectureTest;
use Tests\PhpAT\functional\php7\fixtures\Dependency\ClosureReturnClass;
use Tests\PhpAT\functional\php7\fixtures\Dependency\ClosureVarClass;
use Tests\PhpAT\functional\php7\fixtures\Dependency\ConstClass;
use Tests\PhpAT\functional\php7\fixtures\Dependency\ConstructException;
use Tests\PhpAT\functional\php7\fixtures\Dependency\ConstructParamClassOne;
use Tests\PhpAT\functional\php7\fixtures\Dependency\ConstructParamClassTwo;
use Tests\PhpAT\functional\php7\fixtures\Dependency\MethodDependency;
use Tests\PhpAT\functional\php7\fixtures\Dependency\ParamClassOne;
use Tests\PhpAT\functional\php7\fixtures\Dependency\ParamClassTwo;
use Tests\PhpAT\functional\php7\fixtures\Dependency\ReturnClass;
use Tests\PhpAT\functional\php7\fixtures\Dependency\ReturnVarClass;
use Tests\PhpAT\functional\php7\fixtures\Dependency\StaticMethodClass;
use Tests\PhpAT\functional\php7\fixtures\Dependency\VarClass;

class MethodDependencyTest extends ArchitectureTest
{
    public function testAllMethodDependenciesAreCatched(): Rule
    {
        return $this->newRule
            ->classesThat(Selector::haveClassName(MethodDependency::class))
            ->mustOnlyDependOn()
            ->classesThat(Selector::haveClassName(ConstructParamClassOne::class))
            ->andClassesThat(Selector::haveClassName(ConstructParamClassTwo::class))
            ->andClassesThat(Selector::haveClassName(ConstructException::class))
            ->andClassesThat(Selector::haveClassName(ParamClassOne::class))
            ->andClassesThat(Selector::haveClassName(ParamClassTwo::class))
            ->andClassesThat(Selector::haveClassName(StaticMethodClass::class))
            ->andClassesThat(Selector::haveClassName(ReturnClass::class))
            ->andClassesThat(Selector::haveClassName(ReturnVarClass::class))
            ->andClassesThat(Selector::haveClassName(VarClass::class))
            ->andClassesThat(Selector::haveClassName(ConstClass::class))
            ->andClassesThat(Selector::haveClassName(ClosureVarClass::class))
            ->andClassesThat(Selector::haveClassName(ClosureReturnClass::class))
            ->build();
    }
}
