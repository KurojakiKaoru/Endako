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
use pocketmine\block\Solid;

class RegisterNewBlockTest extends Test{

	public function run(){
		Block::init(true);

		Block::registerBlock(new StrangeNewBlock());
		if(!(($b = Block::get(254)) instanceof StrangeNewBlock)){
			throw new TestFailedException("Expected StrangeNewBlock, got " . (is_object($b) ? get_class($b) : (string) $b));
		}

		try{
			Block::registerBlock(new OutOfBoundsNewBlock());
			throw new TestFailedException("Registering an ID greater than 256 should raise an exception");
		}catch(\RuntimeException $e){
			//good
		}

		$this->setResult(Test::RESULT_OK);
	}

	public function getName() : string{
		return "Test registering new block types";
	}

	public function getDescription() : string{
		return "Verifies that Block::registerBlock() and Block::get() function as expected with new blocks registered by plugins";
	}
}

class StrangeNewBlock extends Solid{
	protected $id = 254;

	public function __construct($meta = 0){
		$this->meta = $meta;
	}

	public function getName(){
		return "Strange New Block";
	}
}

class OutOfBoundsNewBlock extends StrangeNewBlock{
	protected $id = 2588;

	public function getName(){
		return "Beyond Range Block";
	}
}