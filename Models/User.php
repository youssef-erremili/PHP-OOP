<?php

class User extends Model implements StorableInterface
{

    use SoftDeletes;

    private string|int $id;
    private string $fullname;
    private string $email;
    private string $country;
    private string $password;

    public array $users = [];

    private $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'country',
    ];

    private const MODEL_NAME = 'users';

    public function __construct()
    {
        parent::__construct();
        $this->users = $this->getAll();
    }

    public function getFullName(int $id): array|string
    {
        $user = $this->getCurrentUser($id);

        if (!is_array($user)) {
            return 'User not Found';
        }

        return $user['first_name'] . ' ' . $user['last_name'];
    }

    public function getCurrentUser(int $id): array|string
    {
        $wanted_user = array_filter($this->users, fn($user) => $user['id'] == $id);
        $user = reset($wanted_user);

        return $user ?: 'User not Found';
    }

    public function getEmail(int $id): string
    {
        $user = $this->getCurrentUser($id);

        if (!is_array($user)) {
            return 'EMail not Found';
        }

        return $user['email'];
    }

    public function getCountry(int $id): string
    {
        $user = $this->getCurrentUser($id);

        if (!is_array($user)) {
            return 'User not Found';
        }

        return $user['country'];
    }

    public function getAll(): array
    {
        return parent::fetchAll(self::MODEL_NAME);
    }

    public function save(array $data): bool|string
    {
        return parent::create(self::MODEL_NAME, $data, $this->fillable);
    }

    public function get(int $id, string $message = 'Desired User is not Found'): mixed
    {
        return parent::read($id, $model = self::MODEL_NAME, $message);
    }


    public function edit(int $id, array $data): string
    {
        return parent::update(self::MODEL_NAME, $id, $data, $this->fillable);
    }

    public function delete(int $id): mixed
    {
        return $this->softDelete($id);
    }
}
