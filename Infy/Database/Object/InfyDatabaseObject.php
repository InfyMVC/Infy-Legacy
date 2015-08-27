<?php
namespace Infy\Database\Object;
use Infy\Infy;

/**
 * Project: InfyMVC
 * File: InfyDatabaseObject.php
 * Description: --
 *
 * @author      Till
 * @copyright   2015 - InfyMVC by Till
 * @created     27.08.2015 - 17:45
 * @license     http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version     1.0
 */
abstract class InfyDatabaseObject
{

    protected static $databaseTableName = '';
    protected static $databaseTableIndexName = '';
    protected static $baseClass = '';

    protected $data = null;

    public function __construct($id = null, array $row = null, InfyDatabaseObject $object = null) {
        if ($id !== null) {
            $sql = "SELECT
						*
					FROM
						". static::$databaseTableName ."
					WHERE
						". static::$databaseTableIndexName ." = ?";

            $stmt = Infy::Model()->getConnection()->prepare($sql);
            $stmt->execute(array($id));
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($row === false) $row = array();
        }
        else if ($object !== null) {
            $row = $object->getData();
        }

        $this->handleObjectData($row);
    }

    protected function handleObjectData($data) {
        $this->data = $data;
    }

    public function __get($name) {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }
        return null;
    }

    public function getData() {
        return $this->data;
    }

}