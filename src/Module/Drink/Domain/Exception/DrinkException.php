<?php declare(strict_types=1);

namespace Larawater\Module\Drink\Domain\Exception;

use DomainException;

final class DrinkException extends DomainException
{
  public static function onlyPositiveDrinksAllowed(): self
  {
    $message = sprintf('Only positive drinks are allowed');
    return new self($message);
  }

}