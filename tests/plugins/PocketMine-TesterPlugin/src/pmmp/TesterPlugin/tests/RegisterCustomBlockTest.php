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
use pocketmine\block\Cobblestone;

class RegisterCustomBlockTest extends Test{

	public function run(){
		Block::init(true); //clear any previous test stuff

		$original = new MyCustomBlock();

		try{
			Block::registerBlock($original); //this ought to raise an exception because we haven't specified that we want to override Cobblestone
			throw new TestFailedException("No exception thrown ");
		}catch(\RuntimeException $e){
			//good
		}

		Block::registerBlock($original, true); //should be quiet

		$copy = Block::get(Block::COBBLESTONE);
		if(!($copy instanceof MyCustomBlock)){
			throw new TestFailedException("Expected instance of MyCustomBlock, got " . (is_object($copy) ? get_class($copy) : (string) $copy));
		}

		if($copy === $original){
			throw new TestFailedException("Block factory registration should clone the block object to prevent strange beahviour");
		}

		$this->setResult(Test::RESULT_OK);
	}

	public function getName() : string{
		return "Test overriding block types with custom ones";
	}

	public function getDescription() : string{
		return "Verifies that Block::registerBlock() and Block::get() function as expected with custom block types";
	}
}

class MyCustomBlock extends Cobblestone{

	public function getName(){
		return "MyCobblestone";
	}
}