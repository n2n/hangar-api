<?php
namespace hangar\api;

use n2n\core\container\N2nContext;
use n2n\persistence\orm\model\EntityModelManager;

interface HuoContext {
	public function getN2nContext(): N2nContext;
	public function getEntityModelManager(bool $reload = false): EntityModelManager;
}