<?php

namespace App\Entities;

use Luxid\ORM\UserEntity;

class User extends UserEntity
{
    public int $id = 0;
    public string $email = '';
    public string $password = '';
    public string $firstname = '';
    public string $lastname = '';
    public string $created_at = '';

    public static function tableName(): string
    {
        return 'users';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function attributes(): array
    {
        return ['email', 'password', 'firstname', 'lastname', 'created_at'];
    }

    public function rules(): array
    {
        return [
            'email' => [
                self::RULE_REQUIRED,
                self::RULE_EMAIL,
                [self::RULE_UNIQUE, 'class' => self::class]
            ],
            'password' => [
                self::RULE_REQUIRED,
                [self::RULE_MIN, 'min' => 8]
            ],
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'email' => 'Email Address',
            'password' => 'Password',
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
        ];
    }

    public function getDisplayName(): string
    {
        return trim($this->firstname . ' ' . $this->lastname);
    }

    public function save(): bool
    {
        // Hash password before saving
        if (!empty($this->password) && !password_get_info($this->password)['algo']) {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        }

        $this->created_at = date('Y-m-d H:i:s');
        return parent::save();
    }
}
