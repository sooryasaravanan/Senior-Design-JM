<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
include_once 'index.php';

final class ErrorTest extends TestCase{
	public function testEmptyEmployeeIdTest() : void{
		print "\n";
		print "Empty Employee ID test: \n";
		$emptyId = '';
		$expectedErrIdEmpty = "Employee ID is required";
		$retEmptyIdErr = IdCheck($emptyId);
		print "Returned Error: ";
		print $retEmptyIdErr;
		print "\n";
		if($this->assertSame($expectedErrIdEmpty, $retEmptyIdErr)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}
	public function testInvalidEmployeeIdTest() : void{
		print "\n";
		print "Invalid Employee ID test: \n";
		$InvalidId = 'AbCDepkz1243';
		print "Test ID: ";
		print $InvalidId;
		print "\n";
		$expectedErrIdInvalid = "Only numbers allowed";
		$retInvalidIdErr = IdCheck($InvalidId);
		print "Returned Error: ";
		print $retInvalidIdErr;
		print "\n";
		if($this->assertSame($expectedErrIdInvalid, $retInvalidIdErr)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}
	public function testEmptyWorkOrderTest() : void{
		print "\n";
		print "Empty Work Order test: \n";
		$emptyOrder = '';
		$expectedErrOrderEmpty = "Work Order Number is required";
		$retEmptyOrderErr = WorkOrder($emptyOrder);
		print "Returned Error: ";
		print $retEmptyOrderErr;
		print "\n";
		if($this->assertSame($expectedErrOrderEmpty, $retEmptyOrderErr)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}
	public function testInvalidWorkOrderTest() : void{
		print "\n";
		print "Invalid Work Order test: \n";
		$InvalidOrder = '()';
		print "Test Work Order: ";
		print $InvalidOrder;
		print "\n";
		$expectedErrOrderInvalid = "Only letters and numbers allowed";
		$retInvalidOrderErr = WorkOrder($InvalidOrder);
		print "Returned Error: ";
		print $retInvalidOrderErr;
		print "\n";
		if($this->assertSame($expectedErrOrderInvalid, $retInvalidOrderErr)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}
	public function testEmptyPartNumTest() : void{
		print "\n";
		print "Empty Part Number test: \n";
		$emptyPartNum = '';
		$expectedErrPartNumEmpty = "Part Number is required";
		$retEmptyPartNumErr = PartNum($emptyPartNum);
		print "Returned Error: ";
		print $retEmptyPartNumErr;
		print "\n";
		if($this->assertSame($expectedErrPartNumEmpty, $retEmptyPartNumErr)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}
	public function testInvalidPartNumTest() : void{
		print "\n";
		print "Invalid Part Number test: \n";
		$InvalidPart = '{[!]}';
		print "Test Part Number: ";
		print $InvalidPart;
		print "\n";
		$expectedErrPartInvalid = "Only letters, numbers, '/', and '-' allowed";
		$retInvalidPartErr = PartNum($InvalidPart);
		print "Returned Error: ";
		print $retInvalidPartErr;
		print "\n";
		if($this->assertSame($expectedErrPartInvalid, $retInvalidPartErr)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}
	public function testEmptyQuantityTest() : void{
		print "\n";
		print "Empty Quantity test: \n";
		$emptyQuantity = '';
		$expectedErrQuantityEmpty = "Quantity is required";
		$retEmptyQuantityErr = Quant($emptyQuantity);
		print "Returned Error: ";
		print $retEmptyQuantityErr;
		print "\n";
		if($this->assertSame($expectedErrQuantityEmpty, $retEmptyQuantityErr)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}
	public function testInvalidQuantityTest() : void{
		print "\n";
		print "Invalid Quantity test: \n";
		$InvalidQuantity = '(ab23fg?';
		print "Test Quantity: ";
		print $InvalidQuantity;
		print "\n";
		$expectedErrQuantityInvalid = "Only numbers allowed";
		$retInvalidQuantityErr = Quant($InvalidQuantity);
		print "Returned Error: ";
		print $retInvalidQuantityErr;
		print "\n";
		if($this->assertSame($expectedErrQuantityInvalid, $retInvalidQuantityErr)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}
	public function testEmptyStartTimeTest() : void{
		print "\n";
		print "Empty Start Time test: \n";
		$emptyStart = '';
		$expectedErrStartEmpty = "Start time is required";
		$retEmptyStartErr = StartTime($emptyStart);
		print "Returned Error: ";
		print $retEmptyStartErr;
		print "\n";
		if($this->assertSame($expectedErrStartEmpty, $retEmptyStartErr)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}
	public function testEmptyEndTimeTest() : void{
		print "\n";
		print "Empty End Time test: \n";
		$emptyEnd = '';
		$expectedErrEndEmpty = "End time is required";
		$retEmptyEndErr = EndTime(date("h:i:sa"), $emptyEnd);
		print "Returned Error: ";
		print $retEmptyEndErr;
		print "\n";
		if($this->assertSame($expectedErrEndEmpty, $retEmptyEndErr)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}
	public function testInvalidEndTimeTest() : void{
		print "\n";
		print "Invalid EndTime test: \n";
		$InvalidEndTime = date("h:i:sa");
		$TestStartTime = date("h:i:sa", strtotime('+1 hours'));
		print "Test Start Time: ";
		print $TestStartTime;
		print "\n";
		print "Test End Time: ";
		print $InvalidEndTime;
		print "\n";
		$expectedErrEndTimeInvalid = "End time must occur after start time";
		$retInvalidEndTimeErr = EndTime($TestStartTime, $InvalidEndTime);
		print "Returned Error: ";
		print $retInvalidEndTimeErr;
		print "\n";
		if($this->assertSame($expectedErrEndTimeInvalid, $retInvalidEndTimeErr)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}
	public function testEmptySeqTest() : void{
		print "\n";
		print "Empty Sequence test: \n";
		$emptySeq = '';
		$expectedErrSeqEmpty = "Sequence is required";
		$retEmptySeqErr = Sequence($emptySeq);
		print "Returned Error: ";
		print $retEmptySeqErr;
		print "\n";
		if($this->assertSame($expectedErrSeqEmpty, $retEmptySeqErr)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}
	public function testInvalidSeqTest() : void{
		print "\n";
		print "Invalid Sequence test: \n";
		$InvalidSeq = '?ioksa#(';
		print "Test Sequence: ";
		print $InvalidSeq;
		print "\n";
		$expectedErrSeqInvalid = "Only numbers allowed";
		$retInvalidSeqErr = Sequence($InvalidSeq);
		print "Returned Error: ";
		print $retInvalidSeqErr;
		print "\n";
		if($this->assertSame($expectedErrSeqInvalid, $retInvalidSeqErr)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}
	public function testEmptySetupTest() : void{
		print "\n";
		print "Empty Setup Time test: \n";
		$emptySetup = '';
		$expectedErrSetupEmpty = "Setup Time is required";
		$retEmptySetupErr = setupTime($emptySetup);
		print "Returned Error: ";
		print $retEmptySetupErr;
		print "\n";
		if($this->assertSame($expectedErrSetupEmpty, $retEmptySetupErr)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}
	public function testInvalidSetupTest() : void{
		print "\n";
		print "Invalid Setup Time test: \n";
		$InvalidSetup = 'as28y6mjd';
		print "Test Setup Time: ";
		print $InvalidSetup;
		print "\n";
		$expectedErrSetupInvalid = "Integer required";
		$retInvalidSetupErr = setupTime($InvalidSetup);
		print "Returned Error: ";
		print $retInvalidSetupErr;
		print "\n";
		if($this->assertSame($expectedErrSetupInvalid, $retInvalidSetupErr)){
			print "Test Failed \n";
		}
		else{
			print "Test Passed \n";
		}
	}
}