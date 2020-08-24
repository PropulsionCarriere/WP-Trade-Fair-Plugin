<?php


namespace TradeFair;


use Carbon\Carbon;
use Carbon\CarbonInterface;

class Period
{
	protected $start;
	protected $end;

	/**
	 * Period constructor.
	 * @param CarbonInterface $start
	 * @param CarbonInterface $end
	 */
	public function __construct(CarbonInterface $start, CarbonInterface $end)
	{
		$this->start = $start;
		$this->end = $end;
	}

	/**
	 * @return CarbonInterface
	 */
	public function getStart(): CarbonInterface
	{
		return $this->start;
	}

	/**
	 * @return CarbonInterface
	 */
	public function getEnd(): CarbonInterface
	{
		return $this->end;
	}

	public function length():\DateInterval{
		return $this->start->diff($this->end);
	}

	public function elapsedTime():\DateInterval{
		return $this->start->diff(Carbon::now());
	}

	public function relativeTimeElapsed(){
		return (Carbon::now()->timestamp - $this->start->timestamp)/($this->end->timestamp-$this->start->timestamp);
	}

}
