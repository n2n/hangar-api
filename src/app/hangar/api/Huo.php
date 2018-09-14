<?php
namespace hangar\api;

use n2n\context\Lookupable;
use hangar\HangarContext;
use n2n\core\container\N2nContext;
use n2n\core\module\Module;

class Huo implements Lookupable {
	
	private $n2nContext;
	private $hangarContext;
	private $module;
	
	public function __construct(... $args) {
		foreach ($args as $arg) {
			if ($arg instanceof HangarContext) {
				$this->hangarContext = $arg;
				continue;
			}
			
			if ($arg instanceof N2nContext) {
				$this->n2nContext = $arg;
				continue;
			}
			
			if ($arg instanceof Module) {
				$this->module = $arg;
				continue;
			}
		}
	}
	
	public function _init(HangarContext $hangarContext, $n2nContext) {
		$this->hangarContext = $hangarContext;
		$this->n2nContext = $n2nContext;
	}
	
	/**
	 * @return \n2n\core\module\Module
	 */
	public function getModule() {
		return $this->module;
	}
	
	/**
	 * @return \hangar\HangarContext
	 */
	public function getHangarContext() {
		return $this->hangarContext;
	}
	
	/**
	 * @return \n2n\core\container\N2nContext
	 */
	public function getN2nContext() {
		return $this->n2nContext;
	}
	
	public function getAppN2nContext() {
		return $this->hangarContext->getN2nContext();
	}
	
	/**
	 * @param string|\ReflectionClass $lookupId
	 * @return mixed
	 */
	public function lookup($lookupId, bool $required = true) {
		return $this->n2nContext->lookup($lookupId, $required);
	}
}