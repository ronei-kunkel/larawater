<?php declare(strict_types=1);

namespace Larawater\Module\Register\Domain\Entity;
use Larawater\Common\Domain\Exception\EmailException;
use Larawater\Common\Domain\Exception\PasswordException;
use Larawater\Common\Domain\Type\Email;
use Larawater\Common\Domain\Type\Password;

final class User
{
  private function __construct(
    private string $name,
    private Email $email,
    private Password $password,
  ) {
  }

  /**
   * @throws EmailException
   * @throws PasswordException
   */
  public static function build(string $name, string $email, string $password): User
  {
    return new User($name, new Email($email), new Password($password));
  }

  public function name(): string
  {
    return $this->name;
  }

  public function email(): string
  {
    return $this->email->value();
  }

  public function password(): string
  {
    return $this->password->value();
  }
}