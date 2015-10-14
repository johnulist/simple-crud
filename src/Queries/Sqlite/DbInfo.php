<?php

namespace SimpleCrud\Queries\Sqlite;

use SimpleCrud\SimpleCrud;
use PDO;

/**
 * Class to retrieve info from a sqlite database.
 */
class DbInfo
{
    /**
     * Build and return the query.
     *
     * @param SimpleCrud $db
     *
     * @return array
     */
    public static function getTables(SimpleCrud $db)
    {
        return $db->execute('SELECT name FROM sqlite_master WHERE type="table"')->fetchAll(PDO::FETCH_COLUMN, 0);
    }

    /**
     * Build and return the fields of a table.
     *
     * @param SimpleCrud $db
     * @param string     $table
     *
     * @return array
     */
    public static function getFields(SimpleCrud $db, $table)
    {
        $result = $db->execute("pragma table_info(`{$table}`)")->fetchAll(PDO::FETCH_ASSOC);
        $fields = [];

        foreach ($result as $field) {
            $fields[$field['name']] = strtolower($field['type']);
        }

        return $fields;
    }
}