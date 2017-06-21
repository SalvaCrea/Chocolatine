<?php

require_once(dirname(__FILE__).'/includes/lib.php');

require_once(dirname(__FILE__).'/vendor/autoload.php');

require_once(dirname(__FILE__).'/includes/sp_core.php');

require_once(dirname(__FILE__).'/includes/sp_ressources.php');

require_once(dirname(__FILE__).'/includes/sp_controller.php');

require_once(dirname(__FILE__).'/includes/sp_module_factory.php');

/**
 * Managers
 */

require_once(dirname(__FILE__).'/includes/managers/sp_manager_modules.php');

require_once(dirname(__FILE__).'/includes/managers/sp_manager_ajax.php');

require_once(dirname(__FILE__).'/includes/managers/sp_manager_form.php');

require_once(dirname(__FILE__).'/includes/managers/sp_manager_view.php');

require_once(dirname(__FILE__).'/includes/managers/sp_manager_model.php');


/**
 * [Pattern Module]
 */

require_once(dirname(__FILE__).'/includes/pattern_module/sp_module.php');

require_once(dirname(__FILE__).'/includes/pattern_module/sp_component.php');

require_once(dirname(__FILE__).'/includes/pattern_module/sp_model.php');

require_once(dirname(__FILE__).'/includes/pattern_module/sp_view.php');

require_once(dirname(__FILE__).'/includes/pattern_module/sp_form.php');

require_once(dirname(__FILE__).'/includes/pattern_module/sp_ajax.php');
