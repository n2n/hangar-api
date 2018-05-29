<?php
/*
 * Copyright (c) 2012-2016, Hofmänner New Media. All rights reserved.
 * DO NOT ALTER OR REMOVE COPYRIGHT NOTICES OR THIS FILE HEADER.
 *
 * This file is part of the HANGAR PROJECT.
 *
 * HANGAR is free to use. You are free to redistribute it but are not permitted to make any
 * modifications without the permission of Hofmänner New Media.
 *
 * HANGAR is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even
 * the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * The following people participated in this project:
 *
 * Thomas Günther.............: Developer, Architect, Frontend UI, Concept
 * Bert Hofmänner.............: Idea, Frontend UI, Concept
 * Andreas von Burg...........: Concept
 */
namespace hangar\api;

use n2n\util\config\Attributes;
use phpbob\representation\PhpProperty;
use phpbob\representation\PhpPropertyAnno;
use hangar\Hangar;

class PropSourceDef {
	private $phpProperty;
	private $phpPropertyAnno;
	private $boolean = false;
	private $setterTypeName;
	private $returnTypeName;
	private $required;
	private $hangarData;
	
	public function __construct(PhpProperty $phpProperty, PhpPropertyAnno $phpPropertyAnno = null, 
			Attributes $hangarData = null, bool $required = false) {
		$this->phpProperty = $phpProperty;
		if (null !== $phpPropertyAnno) {
			$this->phpPropertyAnno = $phpPropertyAnno;
		} else {
			$this->phpPropertyAnno = new PhpPropertyAnno($phpProperty->getName());
		}
		$this->required = $required;
		
		if (null !== $hangarData) {
			$this->hangarData = $hangarData;
		} else {
			$this->hangarData = new Attributes();
		}
		
		$this->hangarData->set('required', $required);
		
	}
	/**
	 * @return PhpProperty
	 */
	public function getPhpProperty() {
		return $this->phpProperty;
	}
	
	public function isRequired() {
		return $this->required;
	}
	
	public function setRequired(bool $required) {
		$this->required = $required;
		$this->hangarData->set('required', $required);
	}
	
	/**
	 * @return PhpPropertyAnno
	 */
	public function getPhpPropertyAnno() {
		return $this->phpPropertyAnno;
	}
	
	public function isBoolean() {
		return $this->boolean;
	}

	public function setBoolean($boolean) {
		$this->boolean = (bool) $boolean;
	}

	public function getSetterTypeName() {
		return $this->setterTypeName;
	}

	public function setSetterTypeName(string $setterTypeName = null) {
		$this->setterTypeName = $setterTypeName;
	}

	public function getReturnTypeName() {
		return $this->returnTypeName;
	}

	public function setReturnTypeName(string $returnTypeName = null) {
		$this->returnTypeName = $returnTypeName;
	}
	
	public function getHangarData() {
		return $this->hangarData;
	}
	
	public function getPropertyName() {
		return $this->phpProperty->getName();
	}
	
// 	/**
// 	 * @return \hangar\core\config\ColumnDefaults
// 	 */
// 	public function getColumnDefaults() {
// 		return Hangar::getColumnDefaults();
// 	}
} 
