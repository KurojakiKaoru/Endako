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

use pmmp\TesterPlugin\Test;
use pmmp\TesterPlugin\TestFailedException;
use pocketmine\block\Block;
use pocketmine\block\Planks;
use pocketmine\block\Stone;

class BlockGetTest extends Test{

	public function run(){
		$list = [
			[Block::STONE, Stone::ANDESITE],
			[Block::STONE, 15],
			[Block::GOLD_BLOCK, 5],
			[Block::WOODEN_PLANKS, Planks::DARK_OAK],
			[Block::SAND, 0]
		];

		foreach($list as list($id, $meta)){
			$block = Block::get($id, $meta);

			if($block->getId() !== $id){
				throw new TestFailedException("Expected id $id, got " . $block->getId());

			}elseif($block->getDamage() !== $meta){
				throw new TestFailedException("Expected meta $meta, got " . $block->getDamage());
			}
		}

		$this->setResult(Test::RESULT_OK);
	}

	public function getName() : string{
		return "Test Block::get() behaviour";
	}

	public function getDescription() : string{
		return "Verifies that Block::get() return values have the correct id and meta";
	}
}