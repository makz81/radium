<?php
/**
 * radium: lithium application framework
 *
 * @copyright     Copyright 2013, brünsicke.com GmbH (http://bruensicke.com)
 * @license       http://opensource.org/licenses/BSD-3-Clause The BSD License
 */

namespace radium\tests\mocks\data;

use lithium\data\collection\DocumentSet;
use lithium\data\entity\Document;

use lithium\tests\mocks\data\source\database\adapter\MockAdapter;

class MockConfigurations extends \radium\models\Configurations {

	protected $_meta = array(
		'connection' => false
	);

	public static function &connection($records = null) {
		$mock = new MockAdapter(compact('records') + array(
			'columns' => array(
				'lithium\tests\mocks\data\MockModel' => array('_id', 'data')
			),
			'autoConnect' => false
		));
		static::meta(array('key' => '_id', 'locked' => true));
		return $mock;
	}

	public static function find($type = 'all', array $options = array()) {
		$now = date('Y-m-d h:i:s');

		switch ($type) {
			case 'first':
				return new Document(array('data' => array(
					'_id' => 1,
					'name' => 'foo',
					'slug' => 'foo',
					'status' => 'active',
					'created' => $now,
					'modified' => $now
				)));
				break;
			case 'all':
			default :
				return new DocumentSet(array('data' => array(
					array(
						'_id' => 1,
						'name' => 'first',
						'slug' => 'first',
						'status' => 'active',
						'created' => $now,
						'modified' => $now
					),
					array(
						'_id' => 2,
						'name' => 'second',
						'slug' => 'second',
						'status' => 'inactive',
						'created' => $now,
						'modified' => $now
					),
					array(
						'_id' => 3,
						'name' => 'third',
						'slug' => 'third',
						'status' => 'active',
						'created' => $now,
						'modified' => $now
					)
				)));
				break;
		}
	}
}

?>