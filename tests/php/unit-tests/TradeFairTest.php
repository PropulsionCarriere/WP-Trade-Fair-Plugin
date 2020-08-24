<?php

namespace MyApp\Tests;

use Carbon\Carbon;
use TradeFair\TradeFairSchedule;
use WP_UnitTestCase;

class TradeFairTest extends WP_UnitTestCase {

	const START_DATE = '2020-08-19';
	const END_DATE = '2020-08-21';
	/**
	 * Set up a new app instance to use for tests.
	 */
	public function setUp() {
		// Set up an app instance with whatever stubs and mocks we need before every test.
		\TradeFair::make()->bootstrap( [], false );

		// Since we don't want to test WP Emerge internals, we can overwrite them during testing:
		// \MyApp::alias( 'view', function ( $view ) { return $view; } );

		// or we can replace the entire app instance:
		// \MyApp::setApplication( new MyMockApplication() );
	}

	/**
	 * Tear down our test app instance.
	 */
	public function tearDown() {
		\TradeFair::setApplication( null );
	}

	/**
	 * @covers ::foo
	 */
	public function testGetStartDate() {
		$schedule = $this->getTradeFairSchedule();
		$startDate = $schedule->getStartDate();
		$this->assertTrue( Carbon::createFromFormat(TradeFairSchedule::dateFormat, self::START_DATE)->startOfDay()->equalTo($startDate) );
	}

	public function testGetEndDate(){
		$schedule = $this->getTradeFairSchedule();
		$this->assertTrue(Carbon::createFromFormat(TradeFairSchedule::dateFormat, self::END_DATE)->endOfDay()->equalTo($schedule->getEndDate()));
	}

	public function testGetPeriodLength(){
		$mock = $this->getTradeFairSchedule();
		$reflection = new \ReflectionClass($mock);
		$method = $reflection->getMethod('getPeriodLength');
		$method->setAccessible(true);;
		$length = $method->invoke($mock,0);
		$this->assertEquals(3, $length->h);
	}

	public function testIsInPeriod(){
		$mock = $this->getTradeFairSchedule();
		$method = $this->getProtectedMethod($mock,'isInPeriod');
		$isInPeriod = $method->invoke($mock, Carbon::createFromFormat(TradeFairSchedule::dateTimeFormat,'2020-08-21 09:00:00'), 0);
		$this->assertTrue($isInPeriod);
	}

	public function testIsInPeriodFalse(){
		$mock = $this->getTradeFairSchedule();
		$method = $this->getProtectedMethod($mock,'isInPeriod');
		$isInPeriod = $method->invoke($mock, Carbon::createFromFormat(TradeFairSchedule::dateTimeFormat,'2020-08-21 12:01:00'), 0);
		$this->assertFalse($isInPeriod);
	}

	public function testIsInPeriodMultiDay(){
		$mock = $this->getTradeFairSchedule();
		$method = $this->getProtectedMethod($mock,'isInPeriod');
		$isInPeriod = $method->invoke($mock, $this->getDateTime('2020-08-20','10:00:00'), 1);
		$this->assertTrue($isInPeriod);
	}

	private function getProtectedMethod($class, $method){

		$reflection = new \ReflectionClass($class);
		$method = $reflection->getMethod($method);
		$method->setAccessible(true);
		return $method;
	}

	public function testGetPeriodIsNull(){
		$schedule = $this->getTradeFairSchedule();
		$period = $schedule->getPeriod($this->getDateTime('2000-01-01'));
		$this->assertNull($period);
	}

	public function testGetPeriod(){
		$schedule = $this->getTradeFairSchedule();
		$period = $schedule->getPeriod($this->getDateTime('2020-08-20','10:00:00'));
		$this->assertEquals($this->getDateTime('2020-08-20', '09:00:00')->timestamp, $period->getStart()->timestamp);
	}

	private function getDateTime($date, $time = "00:00:00"){
		$dateTime = $date." ".$time;
		return Carbon::createFromFormat(TradeFairSchedule::dateTimeFormat, $dateTime);
	}

	public function testTf_array_rotate_0(){
		$array = [ 'a', 'b', 'c', 'd'];
		$rotated = \tf_array_rotate($array,0);
		$this->assertEquals($array, $rotated);
	}

	public function testSizeTf_array_rotate(){
		$array = [ 'a', 'b', 'c', 'd'];
		$rotated = \tf_array_rotate($array,2);
		$this->assertEquals(count($array), count($rotated));
	}

	public function testSizeOddOffsetTf_array_rotate(){
		$array = [ 'a', 'b', 'c', 'd'];
		$rotated = \tf_array_rotate($array,3);
		$this->assertEquals(count($array), count($rotated));
	}

	public function testSizeOddsTf_array_rotate(){
		$array = [ 'a', 'b', 'c', 'd','e'];
		$rotated = \tf_array_rotate($array,2);
		$this->assertEquals(count($array), count($rotated));
	}

	public function testSizeEqualsOffsetTf_array_rotate(){
		$array = [ 'a', 'b', 'c', 'd','e'];
		$rotated = \tf_array_rotate($array,5);
		$this->assertEquals(count($array), count($rotated));
	}

	public function testTf_array_rotate_1(){
		$array = [ 'a', 'b', 'c', 'd'];
		$rotated = \tf_array_rotate($array,1);
		$this->assertEquals(['d','a','b','c'], $rotated);
	}

	public function testTf_array_rotate_2(){
		$array = [ 'a', 'b', 'c', 'd'];
		$rotated = \tf_array_rotate($array,2);
		$this->assertEquals(['c','d','a','b'], $rotated);
	}

	public function testTf_array_rotate_3(){
		$array = [ 'a', 'b', 'c', 'd'];
		$rotated = \tf_array_rotate($array,3);
		$this->assertEquals(['b','c','d','a'], $rotated);
	}

	public function testTf_array_rotate_sizeEqualsOffset(){
		$array = [ 'a', 'b', 'c', 'd'];
		$rotated = \tf_array_rotate($array,4);
		$this->assertEquals($array, $rotated);
	}

	public function getTradeFairSchedule(){
		$schedule = $this->getMockBuilder(TradeFairSchedule::class)->setMethods(['getScheduleArray'])->getMock();
		$periods = [
			$this->getSchedulePeriod(self::END_DATE, '2020-08-21', '09:00:00', '12:00:00'),
			$this->getSchedulePeriod(self::START_DATE, '2020-08-20', '09:00:00', '12:00:00'),
			$this->getSchedulePeriod(self::START_DATE, '2020-08-20', '13:00:00', '14:00:00'),
		];
		$reflection = new \ReflectionClass($schedule);
		$reflectionProperty = $reflection->getProperty('schedule');
		$reflectionProperty->setAccessible(true);
		$reflectionProperty->setValue($schedule, $periods);
		return $schedule;
	}

	private function getSchedulePeriod($startDate, $endDate, $startTime, $endtime){
		return [
			'trade_fair_period_start_date' => $startDate,
			'trade_fair_period_end_date' => $endDate,
			'trade_fair_period_start_time' => $startTime,
			'trade_fair_period_end_time' => $endtime,
		];
	}
}
