<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'mail' => array(
        'name' => 'server8.integrator.com.br',
        'host' => 'server8.integrator.com.br',
        'connection_class' => 'login',
        'connection_config' => array(
            'username' => 'contato@luxu.com.br',
            'password' => 'Luxu1650',
            'ssl' => 'ssl',
            'port' => 465,
            'from' => 'contato@luxu.com.br'
        )
    )
);