<?php declare(strict_types = 1);

namespace PHPStan\Rules\Comparison;

use PhpParser\Node\Expr;
use PHPStan\Analyser\Scope;
use PHPStan\Type\BooleanType;

class ConstantConditionRuleHelper
{

	public static function getBooleanType(
		Scope $scope,
		Expr $expr
	): BooleanType
	{
		if (
			$expr instanceof Expr\Instanceof_
			|| $expr instanceof Expr\BinaryOp\Identical
			|| $expr instanceof Expr\BinaryOp\NotIdentical
			|| $expr instanceof Expr\BooleanNot
			|| $expr instanceof Expr\BinaryOp\BooleanOr
			|| $expr instanceof Expr\BinaryOp\BooleanAnd
			|| $expr instanceof Expr\Ternary
		) {
			// already checked by different rules
			return new BooleanType();
		}

		return $scope->getType($expr)->toBoolean();
	}

}
