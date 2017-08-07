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

namespace pmmp\TesterPlugin\tests;


use pmmp\TesterPlugin\Test;
use pocketmine\item\Item;

class Issue1145_ItemEqualsTest extends Test{

	public function run(){
		$item1 = Item::nbtDeserialize(Item::get(Item::STONE)->setCustomName("HI")->nbtSerialize());
		$item2 = Item::get(Item::STONE)->setCustomName("HI");
		if($item1->equals($item2)){
			$this->setResult(Test::RESULT_OK);
		}else{
			$this->setResult(Test::RESULT_FAILED);
		}
	}

	public function getName() : string{
		return "Items should still be equal after NBT serialize/deserialize";
	}

	public function getDescription() : string{
		return "Tests that items serialized to NBT and then deserialized should be equal to the original item";
	}
}