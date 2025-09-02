<?php

namespace App\Database\Connectors;

use Illuminate\Database\Connectors\PostgresConnector;
use PDO;

class KoyebPostgresConnector extends PostgresConnector
{
    /**
     * Create a DSN string from a configuration.
     *
     * @param  array  $config
     * @return string
     */
    protected function getDsn(array $config)
    {
        // Start with the standard PostgreSQL DSN from parent
        $dsn = parent::getDsn($config);

        // Add options parameter for endpoint if specified
        if (isset($config['options']) && is_string($config['options'])) {
            $dsn .= ";options='{$config['options']}'";
        }

        return $dsn;
    }

    /**
     * Get the PDO options based on the configuration.
     *
     * @param  array  $config
     * @return array
     */
    public function getOptions(array $config)
    {
        // If options is a string (our endpoint parameter), exclude it from PDO options
        if (isset($config['options']) && is_string($config['options'])) {
            $config['options'] = [];
        }

        return parent::getOptions($config);
    }
}
