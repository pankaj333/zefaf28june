<?php
include_once(DM_PATH.DS."logic_fields".DS."LogicField.php");
include_once(DM_PATH.DS."html_fields".DS."HTMLInput.php");

class InputLogicField extends LogicField {
	function getField() {
		$value = $this->getParam('value');
//		var_dump($value); exit;
		switch($this->params['mode']) {
			case 'list':
				$is_link = $this->getParam('is_link');
				$link = $this->getParam('link');
				$key_field = $this->getParam('key_field');
				if($key_field) {
					$row_data = $this->getParam('row_data');
					if(isset($row_data[$key_field])) {
						$key_field_value = $row_data[$key_field];
					}else {
						$key_field_value = $this->getParam('key_field_value');
					}
				}else {
					$key_field_value = $this->getParam('key_field_value');
				}

//					var_dump($key_field_value); exit;
				if ($is_link && $link && $key_field_value) {
					$link = str_replace('*', $key_field_value, $link);
					$link = $this->getURLString($link);
					$field = '<a href="'.$link.'">'.$value.'</a>'."\n";
				}else {
					$field = (string) $value;
				}
				break;
			case 'single':
				$field_obj = new HTMLInput();
				$field_obj->addParams($this->params);
				$field = $field_obj->getField();
				break;
		}
		
		return $field;
	}
	
	function getValue() {
		$value = $this->getParam('value');
		return htmlspecialchars($value, ENT_QUOTES);
	}
}
