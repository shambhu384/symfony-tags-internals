<?php

declare(strict_types=1);

namespace App\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class TaxManagerCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('tax_manager')) {
            return;
        }

        $definition = $container->findDefinition(
            'tax_manager'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'tax_manager.add'
        );
        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(
                'add',
                array(new Reference($id))
            );
        }
    }
}
