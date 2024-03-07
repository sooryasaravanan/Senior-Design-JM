<?php declare(strict_types=1);
#This File tests the test_input function in index.php

use PHPUnit\Framework\TestCase;
include_once 'index.php';

final class InputTest extends TestCase{
	public function testInputEmployeeIdTest() : void{
		print "\n";
		print "These tests should check in the inputs are the same after passing them into test_input, unless specified otherwise. \n";
		$stringId = "1234";
		$testId = test_input($stringId);
		print "\n";
		print "Employee ID Test: \n";
		print "ID: ";
		print $stringId; 
		print "\n";
		print "Test ID: ";
		print $testId; 
		print "\n";
		# Apparently assertSame returns false if it passes
		if($this->assertSame($stringId, $testId)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}

	}

	public function testInputWorkOrderTest() : void{
		$stringOrder = "1a2b3312x9C";
		$testOrder = test_input($stringOrder);
		print "\n";
		print "Work Order Test: \n";
		print "Work Order: ";
		print $stringOrder; 
		print "\n";
		print "Test Work Order: ";
		print $testOrder; 
		print "\n";
		if($this->assertSame($stringOrder, $testOrder)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}

	public function testInputPartNumberTest() : void{
		$PartNumber = "1a7m-3x/A";
		$testNumber = test_input($PartNumber);
		print "\n";
		print "PartNumber Test: \n";
		print "Part Number: ";
		print $PartNumber; 
		print "\n";
		print "Test Number: ";
		print $testNumber; 
		print "\n";
		if($this->assertSame($PartNumber, $testNumber)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}

	public function testInputPartNumberTestInvalid() : void{
		$PartNumber = "<>????!!@!@#$";
		$testNumber = test_input($PartNumber);
		print "\n";
		print "Invalid PartNumber Test: \n";
		print "This test checks if the Part Numbers are the same. It should fail. \n";
		print "Part Number: ";
		print $PartNumber; 
		print "\n";
		print "Test Number: ";
		print $testNumber; 
		print "\n";
		if($this->assertSame($PartNumber, $testNumber, "Invalid Character is not properly treated.")){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}

	public function testStartTimeTest() : void{

		$StartTime = date("h:i:sa");	#Time in GMT
		$StartTest = test_input($StartTime);
		print "\n";
		print "Start Time Test: \n";
		print "Start Time: ";
		print $StartTime; 
		print "\n";
		print "Test Start Time: ";
		print $StartTest; 
		print "\n";
		if($this->assertSame($StartTime, $StartTest)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}
	public function testEndTimeTest() : void{

		$EndTime = date("h:i:sa");	#Time in GMT
		$EndTest = test_input($EndTime);
		print "\n";
		print "End Time Test: \n";
		print "End Time: ";
		print $EndTime; 
		print "\n";
		print "Test End Time: ";
		print $EndTest; 
		print "\n";
		if($this->assertSame($EndTime, $EndTest)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}

	public function testSequenceTest() : void{

		$SequenceNum = '10582967296271';
		$SequenceNumTest = test_input($SequenceNum);
		print "\n";
		print "Sequence Test: \n";
		print "Sequence Number: ";
		print $SequenceNum; 
		print "\n";
		print "Test Sequence Number: ";
		print $SequenceNumTest; 
		print "\n";
		if($this->assertSame($SequenceNum, $SequenceNumTest)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}

	public function testSetupTest() : void{

		$SetupTime = 100;
		$SetupTimeTest = test_input($SetupTime);
		print "\n";
		print "Setup Test: \n";
		print "Setup Time: ";
		print $SetupTime; 
		print "\n";
		print "Test Setup Time: ";
		print $SetupTimeTest; 
		print "\n";
		if($this->assertEquals($SetupTime, $SetupTimeTest)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}

	public function testEmptyCommentTest() : void{

		$Comment = '';
		$CommentTest = test_input($Comment);
		print "\n";
		print "Empty Comment Test: \n";
		print "Comment: ";
		print $Comment; 
		print "\n";
		print "Test Comment: ";
		print $CommentTest; 
		print "\n";
		if($this->assertSame($Comment, $CommentTest)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}

	public function testCommentTest() : void{

		$Comment = 'This is only a test. This should pass. No idea how long this can be read. This is not an important message. This is incoherant. Asdafwas. L3t th1s be s0me 1nc0herant.';
		$CommentTest = test_input($Comment);
		print "\n";
		print "Comment Test: \n";
		print "Comment: ";
		print $Comment; 
		print "\n";
		print "Test Comment: ";
		print $CommentTest; 
		print "\n";
		if($this->assertSame($Comment, $CommentTest)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}

	public function testInvalidCharacterTest() : void{
		print "This test uses invalid characters. It should fail as test_input does not properly read them. \n";
		$Character = '"<>&';
		$CharacterTest = test_input($Character);
		print "\n";
		print "Invalid Character Test: \n";
		print "Character: ";
		print $Character; 
		print "\n";
		print "Test Invalid Character: ";
		print $CharacterTest; 
		print "\n";
		if($this->assertSame($Character, $CharacterTest, "Invalid Character is not properly treated.")){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}

}