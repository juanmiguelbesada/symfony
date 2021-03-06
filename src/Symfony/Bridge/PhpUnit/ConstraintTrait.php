<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bridge\PhpUnit;

use PHPUnit\Framework\Constraint\Constraint;
use ReflectionClass;

$r = new ReflectionClass(Constraint::class);
if ($r->getProperty('exporter')->isProtected()) {
    trait ConstraintTrait
    {
        use Legacy\ConstraintTraitForV7;
    }
} elseif (\PHP_VERSION < 70100 || !$r->getMethod('evaluate')->hasReturnType()) {
    trait ConstraintTrait
    {
        use Legacy\ConstraintTraitForV8;
    }
} else {
    trait ConstraintTrait
    {
        use Legacy\ConstraintTraitForV9;
    }
}
