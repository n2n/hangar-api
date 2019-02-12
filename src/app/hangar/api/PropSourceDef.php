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

use n2n\util\type\attrs\Attributes;
use phpbob\representation\PhpProperty;
use phpbob\representation\PhpTypeDef;
use phpbob\representation\anno\PhpAnno;

class PropSourceDef {
	private $phpProperty;
	private $phpTypeDef;
	private $required;
	private $hangarData;
	private $arrayLikePhpTypeDef;
	
	public function __construct(PhpProperty $phpProperty, PhpTypeDef $phpTypeDef = null, 
			Attributes $hangarData = null, bool $required = false) {
		$this->phpProperty = $phpProperty;
		$this->required = $required;
		
		if (null !== $hangarData) {
			$this->hangarData = $hangarData;
		} else {
			$this->hangarData = new Attributes();
		}
		
		$this->hangarData->set('required', $required);
		
		$this->phpTypeDef = $phpTypeDef;
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

	public function setPhpTypeDef(PhpTypeDef $phpTypeDef = null) {
		$this->phpTypeDef = $phpTypeDef;
	}
	
	public function getPhpTypeDef() {
		return $this->phpTypeDef;
	}
	
	public function getHangarData() {
		return $this->hangarData;
	}
	
	public function getPropertyName() {
		return $this->phpProperty->getName();
	}
	
	public function setArrayLikePhpTypeDef(PhpTypeDef $arrayLikePhpTypeDef = null) {
		$this->arrayLikePhpTypeDef = $arrayLikePhpTypeDef;
	}
	
	public function getArrayLikePhpTypeDef() {
		return $this->arrayLikePhpTypeDef;
	}
	
	public function isArrayLike() {
		return null !== $this->arrayLikePhpTypeDef;
	}
	
	public function isBool() {
		return null !== $this->phpTypeDef && $this->phpTypeDef->isBool();
	}
	
	public function determineTypeName(string $localName) {
		return $this->phpProperty->determineTypeName($localName);
	}
	
	/**
	 * @param string $typeName
	 * @return boolean
	 */
	public function hasPhpPropertyAnno(string $typeName) {
		return $this->phpProperty->getPhpPropertyAnnoCollection()->hasPhpAnno($typeName);
	}
	
	/**
	 * @param string $typeName
	 * @return PhpAnno
	 */
	public function getPhpPropertyAnno(string $typeName) {
		return $this->phpProperty->getPhpPropertyAnnoCollection()->getPhpAnno($typeName);
	}
	
	/**
	 * @param string $typeName
	 * @return PhpAnno
	 */
	public function getOrCreatePhpPropertyAnno(string $typeName) {
		return $this->phpProperty->getPhpPropertyAnnoCollection()->getOrCreatePhpAnno($typeName);
	}
	
	/**
	 * @param string $typeName
	 * @return PropSourceDef
	 */
	public function removePhpPropertyAnno(string $typeName) {
		$this->phpProperty->getPhpPropertyAnnoCollection()->removePhpAnno($typeName);
		
		return $this;
	}
	
	/**
	 * @param string $typeName
	 * @param string $alias
	 * @param string $type
	 * 
	 * @return PropSourceDef
	 */
	public function createPhpUse(string $typeName, string $alias = null, string $type = null) {
		$this->phpProperty->createPhpUse($typeName, $alias, $type);
		
		return $this;
	}
	
	/**
	 * @param string $typeName
	 * @return PropSourceDef
	 */
	public function removePhpUse(string $typeName) {
		$this->phpProperty->removePhpUse($typeName);
		
		return $this;
	}
} 