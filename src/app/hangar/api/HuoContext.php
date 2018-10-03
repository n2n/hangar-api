<?php
namespace lib\hangar\api;

use n2n\core\container\N2nContext;

interface HuoContext {
	public function getN2nContext(): N2nContext;
}