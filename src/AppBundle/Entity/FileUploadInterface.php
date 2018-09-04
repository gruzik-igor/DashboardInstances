<?php

namespace AppBundle\Entity;


interface FileUploadInterface 
{
	public function getPath();

	public function setPath($path);
}