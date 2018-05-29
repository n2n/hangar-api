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

use n2n\web\dispatch\mag\MagCollection;
use n2n\persistence\meta\structure\ColumnFactory;
use n2n\persistence\meta\structure\Column;
use n2n\persistence\orm\property\EntityProperty;
use n2n\util\config\Attributes;
use n2n\reflection\annotation\AnnotationSet;

interface HangarPropDef {
	/**
	 * @param ColumnDefaults $columnDefaults
	 */
	public function setup(ColumnDefaults $columnDefaults);
	/**
	 * Return the Name 
	 * 
	 * @return string
	 */
	public function getName();
	
	/**
	 * Returns the Reflectionclass of the described entityproperty
	 * 
	 * @return \ReflectionClass
	 */
	public function getEntityPropertyClass();
	
	/**
	 * Returns a Optioncollection if the entityproperty needs further configuration otherwise return null
	 * 
	 * @param PropSourceDef $propertySourceDef (optional - empty if new)
	 * @return MagCollection
	 */
	public function createMagCollection(PropSourceDef $propSourceDef = null);
	
	/**
	 * Reset a PropSourceDef - necessary if a propsourcedef changes
	 *
	 * @param Attributes $attributes
	 * @param PropSourceDef $propSourceDef
	 */
	public function resetPropSourceDef(PropSourceDef $propSourceDef);
	
	/**
	 * Update a PropSourceDef to describe a entityproperty
	 * 
	 * @param Attributes $attributes
	 * @param PropSourceDef $propSourceDef
	 */
	public function updatePropSourceDef(Attributes $attributes, PropSourceDef $propSourceDef);
	
	
	/**
	 * @param EntityProperty $entityProperty
	 * @param PropSourceDef $propSourceDef
	 * @return Column
	 */
	public function createMetaColumn(EntityProperty $entityProperty, PropSourceDef $propSourceDef);
	
	/**
	 * @param EntityProperty $entityProperty
	 * @return int
	 */
	public function testCompatibility(EntityProperty $entityProperty);
	
	/**
	 * Apply to Database
	 * 
	 * @param string $columnName
	 * @param ColumnFactory $columnFactory
	 * @param PropSourceDef $propSourceDef
	 * @param EntityProperty $entityProperty
	 */
	public function applyDbMeta(DbInfo $dbInfo, PropSourceDef $propSourceDef, EntityProperty $entityProperty, 
			AnnotationSet $annotationSet);
}