@if(TradeFair::schedule()->isStarted())
	@if(TradeFair::schedule()->isEnded())
		<div><?php printf(__('The trade fair ended on %1$s. Come back next year!', 'trade_fair'), wp_date(__('F d Y', 'trade_fair'), TradeFair::schedule()->getEndDate()->timestamp))?></div>
	@elseif($period = TradeFair::schedule()->getCurrentPeriod())
		<div><?php printf(__('Companies are currently online until %1$s', 'trade_fair'), $period->getEnd()->format('G:i (T P)'))?></div>
	@else
		<div><?php printf(__('Companies are currently offline. Come back tomorrow.', 'trade_fair'))?></div>
	@endif
@else
	<div><?php printf(__('The %1$s will start on %2$s.', 'trade_fair'), TradeFair::name(), wp_date(__('F d Y', 'trade_fair'),TradeFair::schedule()->getStartDate()->timestamp))?></div>
@endif
