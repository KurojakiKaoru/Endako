<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

declare(strict_types=1);

namespace pmmp\TesterPlugin\tests;

use pmmp\TesterPlugin\Main;
use pmmp\TesterPlugin\Test;
use pmmp\TesterPlugin\TestFailedException;
use pocketmine\block\Block;

class LightFilterMinimumFreezeTest extends Test{

	public function run(){
		Block::init(true); //clear any previous test stuff

		foreach(Block::$lightFilter as $id => $lightFilter){
			if($lightFilter < 1){
				throw new TestFailedException("Light filter must be minimum 1, got $lightFilter for ID $id");
			}
		}

		$this->setResult(Test::RESULT_OK);
	}

	public function getName() : string{
		return "Check for invalid block light filter levels";
	}

	public function getDescription() : string{
		return "Tests that block light filters all have a minimum value of 1";
	}
}