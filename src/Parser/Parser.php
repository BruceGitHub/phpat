<?php declare(strict_types=1);

namespace PHPArchiTest\Parser;

use PHPArchiTest\DependencyInjection\Configuration;
use Roave\BetterReflection\BetterReflection;
use Roave\BetterReflection\Reflection\ReflectionClass;
use Roave\BetterReflection\Reflector\ClassReflector;
use Roave\BetterReflection\SourceLocator\Type\AggregateSourceLocator;
use Roave\BetterReflection\SourceLocator\Type\ComposerSourceLocator;
use Roave\BetterReflection\SourceLocator\Type\PhpInternalSourceLocator;
use Roave\BetterReflection\SourceLocator\Type\SingleFileSourceLocator;

class Parser
{
    private $configuration;
    /**
     * @var string
     */
    private $autoload;

    public function __construct(Configuration $configuration, string $autoload)
    {
        $this->configuration = $configuration;
        $this->autoload = $autoload;
    }

    /**
     * @return ReflectionClass[]
     */
    public function parseFile(\SplFileInfo $file): array
    {
        $loader = require $this->autoload;

        $astLocator = (new BetterReflection())->astLocator();
        $sourceLocator = new AggregateSourceLocator([
            new SingleFileSourceLocator($file->getPathname(), $astLocator),
            new ComposerSourceLocator($loader, $astLocator),
            new PhpInternalSourceLocator($astLocator)
        ]);
        $classReflector = new ClassReflector($sourceLocator);

        return $classReflector->getAllClasses();
    }

    /**
     * @return ReflectionClass[]
     */
    public function parseClassName(string $className): array
    {
        $reflectedClass = (new BetterReflection())->classReflector()->reflect($className);

        return [$reflectedClass];
    }
}
