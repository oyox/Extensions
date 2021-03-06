<?php

class CustomJSExtension extends Minz_Extension {
	public function init() {
		$this->registerTranslates();

		$current_user = Minz_Session::param('currentUser');
		$filename =  'script.' . $current_user . '.js';
		$filepath = join_path($this->getPath(), 'static', $filename);

		if (file_exists($filepath)) {
			Minz_View::appendScript($this->getFileUrl($filename, 'js'));
		}
	}

	public function handleConfigureAction() {
		$this->registerTranslates();

		$current_user = Minz_Session::param('currentUser');
		$filename =  'script.' . $current_user . '.js';
		$filepath = join_path($this->getPath(), 'static', $filename);

		if (Minz_Request::isPost()) {
			$js_rules = html_entity_decode(Minz_Request::param('js-rules', ''));
			file_put_contents($filepath, $js_rules);
		}

		$this->js_rules = '';
		if (file_exists($filepath)) {
			$this->js_rules = htmlentities(file_get_contents($filepath));
		}
	}
}
