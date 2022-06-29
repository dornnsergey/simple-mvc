<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\UserNotFoundException;

class Model
{
    public static function create(array $attrs): int
    {
        $columns = implode(', ', array_keys($attrs));
        $values = ':' . str_replace(' ', ' :', $columns);

        $query = 'insert into ' . static::getTableName() . " ($columns) values ($values)";

        try {
            $stmt = App::db()->prepare($query);

            $stmt->execute($attrs);
        } catch (\PDOException $e) {
            if ($e->errorInfo[1] === 1062) {
                $duplicateEntry = self::getDuplicateEntry($e->errorInfo[2], $attrs);

                $_SESSION['errors'][$duplicateEntry] = "This $duplicateEntry is already in use.";

                header('location: ' . $_SERVER['HTTP_REFERER']);

                exit();
            }
            exit($e->getMessage());
        }

        return (int) App::db()->lastInsertId();
    }

    public static function findOrFail($id): bool|static
    {
        try {
            $sql = 'select * from ' . static::getTableName() . ' where id = :id';

            $stmt = App::db()->prepare($sql);

            $stmt->execute(['id' => $id]);

            $user = $stmt->fetchObject(static::class);

            if (! $user) {
                throw new UserNotFoundException();
            }
        } catch (\PDOException $e) {
            exit($e->getMessage());
        } catch (UserNotFoundException) {
            http_response_code(404);

            exit(View::make('errors/404'));
        }

        return $user;
    }

    public static function all(): array
    {
        $sql = 'select * from ' . static::getTableName();

        return App::db()->query($sql)->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    protected static function getDuplicateEntry(string $errorMsg, array $attrs): string
    {
        preg_match('#\'(.+?)\'#', $errorMsg, $duplicateEntry);

        return array_search($duplicateEntry[1], $attrs);
    }

    public function update(array $attrs): bool
    {
        $query = 'update ' . static::getTableName() . ' set ';

        foreach ($attrs as $column => $value) {
            $query .= "$column = :$column, ";
        }

        $query = substr($query, 0, -2);
        $query .= " where id = $this->id";

        try {
            $stmt = App::db()->prepare($query);

            return $stmt->execute($attrs);
        } catch (\PDOException $e) {
            if ($e->errorInfo[1] === 1062) {
                $duplicateEntry = self::getDuplicateEntry($e->errorInfo[2], $attrs);

                $_SESSION['errors'][$duplicateEntry] = "This $duplicateEntry is already in use.";

                header('location: ' . $_SERVER['HTTP_REFERER']);

                exit();
            }
            exit($e->getMessage());
        }
    }

    protected static function getTableName(): string
    {
        return static::$tableName;
    }
}
