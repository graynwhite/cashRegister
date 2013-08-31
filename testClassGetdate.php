<?php

require_once('../simpletest/unit_tester.php');
require_once('../simpletest/web_tester.php');
require_once('../simpletest/reporter.php');
require_once('class_getdate.php');

class TestGetDateBlank extends  UnitTestCase {
			
		
    function testDates() {
		$ee= new getDate;
		$dateArray=$ee->getDateHandler('','');
		$dateToday=date("Y-m-d");
		
		$beginDate=$dateArray[0];
		$endDate=$dateArray[1];
		$this->assertEqual($dateToday." 00:00:00",$beginDate);
		$this->assertEqual($dateToday. " 23:59:59",$endDate);

		
    }
}
$test = &new TestGetDateBlank();
$test->run(new HtmlReporter());

class TestGetDateBeginOnlyMonthFirst extends  UnitTestCase {
			
		
    function testDates() {
		$ee= new getDate;
		$dateArray2=$ee->getDateHandler('08-30-2013','');
				
		$beginDate2=$dateArray2[0];
		$endDate2=$dateArray2[1];
		$this->assertEqual('2013-08-30 00:00:00',$beginDate2);
		$this->assertEqual('2013-08-30 23:59:59',$endDate2);

		
    }
}
$test = &new TestGetDateBeginOnlyMonthFirst();
$test->run(new HtmlReporter());

class TestGetDateBeginOnlyYearFirst extends  UnitTestCase {
			
		
    function testDates() {
		$ee= new getDate;
		$dateArray3=$ee->getDateHandler('2013-08-30','');
		$dateToday=date("Y-m-d");
		
		$beginDate3=$dateArray3[0];
		$endDate3=$dateArray3[1];
		$this->assertEqual('2013-08-30 00:00:00',$beginDate3);
		$this->assertEqual('2013-08-30 23:59:59',$endDate3);

		
    }
}
$test = &new TestGetDateBeginOnlyYearFirst();
$test->run(new HtmlReporter());

class TestGetDateBothDatesYearFirst extends  UnitTestCase {
			
		
    function testDates() {
		$ee= new getDate;
		$dateArray4=$ee->getDateHandler('2013-08-30','2013-08-31');
		$dateToday=date("Y-m-d");
		
		$beginDate4=$dateArray4[0];
		$endDate4=$dateArray4[1];
		$this->assertEqual('2013-08-30 00:00:00',$beginDate4);
		$this->assertEqual('2013-08-31 23:59:59',$endDate4);

		
    }
}
$test = &new TestGetDateBothDatesYearFirst();
$test->run(new HtmlReporter());
?>