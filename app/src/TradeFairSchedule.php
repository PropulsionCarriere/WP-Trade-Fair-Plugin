<?php


namespace TradeFair;


use Carbon\Carbon;
use Carbon\CarbonInterface;
use TradeFair\CarbonFields\TradeFairFields;

class TradeFairSchedule
{
	const dateFormat = "Y-m-d";
	const timeFormat = "H:i:s";
	const dateTimeFormat = self::dateFormat." ".self::timeFormat;

	protected $schedule = null;

	public function __construct()
	{
		$this->schedule = $this->getScheduleArray();
	}

	public function getScheduleArray(){
		if ($this->schedule == null){
			$this->schedule = carbon_get_theme_option(TradeFairFields::SCHEDULE);
		}
		return $this->schedule;
	}

	public function isStarted(): bool{
		return $this->isStartedAt($this->now());
	}

	public function isStartedAt(CarbonInterface $time): bool{
		return $this->getStartDate()->lessThanOrEqualTo($time);
	}

	public function getStartDate(): CarbonInterface{
		$earliestDate = $this->getPeriodStartDate(0);
		if ($this->hasMoreThanOnePeriod()){
			for ($i = 1; $i < $this->countPeriods(); $i++){
				$periodStartDate = $this->getPeriodStartDate($i);
				if ($periodStartDate->lessThan($earliestDate)){
					$earliestDate = $periodStartDate;
				}
			}
		}
		return $earliestDate;
	}

	public function hasMoreThanOnePeriod(): bool{
		return $this->countPeriods() > 1;
	}

	private function countPeriods(): int{
		return count($this->schedule);
	}

	public function isEnded(){
		return $this->isEndedAt($this->now());
	}

	public function isEndedAt(CarbonInterface $dateTime){
		return $dateTime->greaterThan($this->getEndDate());
	}

	public function getEndDate(): CarbonInterface{
		$latestDate = $this->getPeriodEndDate(0);
		if ($this->hasMoreThanOnePeriod()){
			for($i = 1; $i < $this->countPeriods(); $i++){
				$periodEndDate = $this->getPeriodEndDate($i);
				if ($periodEndDate->greaterThan($latestDate)){
					$latestDate = $periodEndDate;
				}
			}
		}
		return $latestDate;
	}

	private function getPeriodStartDate($periodIndex){
		$date = $this->schedule[$periodIndex][TradeFairFields::PERIOD_START_DATE];
		return Carbon::createFromFormat(self::dateFormat, $date)
			->startOfDay();
	}

	private function getPeriodEndDate($periodIndex){
		$date = $this->schedule[$periodIndex][TradeFairFields::PERIOD_END_DATE];
		return Carbon::createFromFormat(self::dateFormat, $date)
			->endOfDay();
	}

	public function getCurrentPeriod(){
		return $this->getPeriod(self::now());
	}

	/**
	 * @param CarbonInterface $date
	 * @return Period|null
	 */
	public function getPeriod(CarbonInterface $date){
		for($i = 0; $i < $this->countPeriods(); $i++){
			if ($this->isInPeriod($date, $i)){
				return new Period(
					$this->now()->setTimeFrom($this->getPeriodStartTime($i)),
					$this->now()->setTimeFrom($this->getPeriodEndTime($i))
				);
			}
		}
		return null;
	}

	public function isInPeriod(CarbonInterface $dateTime, $periodIndex){
		$startDateTime = $this->getPeriodStartDateTime($periodIndex);

		while ($startDateTime->lessThanOrEqualTo($this->getPeriodEndDate($periodIndex))){
			if ($dateTime->greaterThanOrEqualTo($startDateTime) && $dateTime->lessThanOrEqualTo($startDateTime->copy()->add($this->getPeriodLength($periodIndex)))){
				return true;
			}
			$startDateTime = $startDateTime->addDay();
		}
		return false;
	}

	private function getPeriodLength($periodIndex): \DateInterval{
		$start = $this->getPeriodStartDateTime($periodIndex);
		$end = $start->copy()->setTimeFrom($this->getPeriodEndTime($periodIndex));
		return $start->diff($end);
	}

	private function getPeriodStartDateTime($periodIndex){
		$date = $this->schedule[$periodIndex][TradeFairFields::PERIOD_START_DATE];
		$time = $this->schedule[$periodIndex][TradeFairFields::PERIOD_START_TIME];
		return $this->dateTimeFromFormat($date, $time);
	}

	private function getPeriodStartTime($periodIndex){
		$endTime = $this->schedule[$periodIndex][TradeFairFields::PERIOD_START_TIME];
		return Carbon::createFromFormat(self::timeFormat, $endTime, 'America/Toronto');
	}

	private function getPeriodEndTime($periodIndex){
		$endTime = $this->schedule[$periodIndex][TradeFairFields::PERIOD_END_TIME];
		return Carbon::createFromFormat(self::timeFormat, $endTime, 'America/Toronto');
	}

	private function getPeriodEndDateTime($periodIndex){
		$date = $this->schedule[$periodIndex][TradeFairFields::PERIOD_END_DATE];
		$time = $this->schedule[$periodIndex][TradeFairFields::PERIOD_END_TIME];
		return $this->dateTimeFromFormat($date, $time);

	}

	private function dateTimeFromFormat($date, $time){
		$dateTime = $date." ".$time;
		return Carbon::createFromFormat(self::dateTimeFormat, $dateTime, 'America/Toronto');
	}

	private function now(){
		return Carbon::now()->setTimezone('America/Toronto');
	}

}
