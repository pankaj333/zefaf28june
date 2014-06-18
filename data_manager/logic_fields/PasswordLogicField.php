<?php
include_once(DM_PATH.DS."logic_fields".DS."LogicField.php");
include_once(DM_PATH.DS."html_fields".DS."HTMLPassword.php");
include_once(DM_PATH.DS."html_fields".DS."HTMLHidden.php");

class PasswordLogicField extends LogicField {

	function getField() {
		$value = $this->getParam('value');
		
		if ( $this->params['mode'] == 'single' ){
			$field = '';
			if($this->getParam('passwords_doesnt_match')) {
				$field .= "Password fields doesn't match.<br />";
			}elseif($value) {
				$field .= 'Leave this 2 fields blank to leave old password.<br />';
			}else {
				$field .= 'Please enter password twice in 2 fields below.<br />';
			}

//			$field_obj = new HTMLHidden();
//			$field_obj->addParams($this->params);
//			$field .= $field_obj->getField();
			
//			$this->params['name'] = 'new_pass';
			$field_obj = new HTMLPassword();
			$field_obj->addParams($this->params);
			$field .= $field_obj->getField();
			unset($field_obj);
			$field .= '<br />';

			$this->params['name'] = 'pass_confirm';
			$field_obj = new HTMLPassword();
			$field_obj->addParams($this->params);
			$field .= $field_obj->getField();
		}else {
			return '';
		}
		
		return $field;
	}
	
	function getValue() {
//		if(
//			isset($_REQUEST['new_pass'])
//			&& $_REQUEST['new_pass']
//			&& isset($_REQUEST['new_pass_confirm'])
//			&& $_REQUEST['new_pass_confirm']
//			&& strcmp($_REQUEST['new_pass'], $_REQUEST['new_pass_confirm']) === 0
//		) {
//			$new_pass = htmlspecialchars($_REQUEST['new_pass'], ENT_QUOTES);
//			$salt = substr(md5(time()), 0, 10);
//			return md5($new_pass.$salt).':'.$salt;
//		}
		
		$value = $this->getParam('value');
		$is_use_salt = $this->getParam('is_use_salt', 1);

		if(empty($value)) {
			return false;
		}

		$value = htmlentities($value, ENT_QUOTES);
		if($is_use_salt) {
			$salt = substr(md5(time() + rand()), 0, 10);
			return md5($value.$salt).':'.$salt;
		}else {
			return md5($value);
		}

	}
}
