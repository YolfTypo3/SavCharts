// This plugin is taken from http://jsfiddle.net/fernandoleal/tk31rehf/17/
{
	beforeRender: function (chart) {
		if (chart.config.options.showAllTooltips) {
			// create an array of tooltips
			// we can't use the chart tooltip because there is only one tooltip per chart
			chart.pluginTooltips = [];
			chart.config.data.datasets.forEach(function (dataset, i) {
				chart.getDatasetMeta(i).data.forEach(function (sector, j) {
					chart.pluginTooltips.push(new Chart.Tooltip({
						_chart: chart.chart,
						_chartInstance: chart,
						_data: chart.data,
						_options: chart.options.tooltips,
						_active: [sector]
					}, chart));
				});
			});

			// turn off normal tooltips
			chart.options.tooltips.enabled = false;
		}
	},
	afterDraw: function (chart, easing) {
		if (chart.config.options.showAllTooltips) {
			// we don't want the permanent tooltips to animate, so don't do anything till the animation runs atleast once
			if (!chart.allTooltipsOnce) {
				if (easing !== 1)
					return;
				chart.allTooltipsOnce = true;
			}

			// turn on tooltips
			chart.options.tooltips.enabled = true;
			Chart.helpers.each(chart.pluginTooltips, function (tooltip) {
				// This line checks if the item is visible to display the tooltip
				if(!tooltip._active[0].hidden){
					tooltip.initialize();
					tooltip.update();
					// we don't actually need this since we are not animating tooltips
					tooltip.pivot();
					tooltip.transition(easing).draw();
				}
			});
			chart.options.tooltips.enabled = false;
		}
	}
}