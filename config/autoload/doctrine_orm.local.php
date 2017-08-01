<?php
  return array(
    'doctrine' => array(
      'connection' => array(
        'orm_default' => array(
          'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
          'params' => array(
            'host' => '174.142.161.97',
            'port' => '3306',
            'user' => 'luxucom',
            'password' => '',
            'dbname' => 'luxucom_makinson',
            'driverOptions' => array(
              PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES 'UTF8'"
            )
          )
        )
      )
    )
  );