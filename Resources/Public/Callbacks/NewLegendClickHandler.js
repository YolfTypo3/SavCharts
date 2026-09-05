const newLegendClickHandler = function newLegendClickHandler(e, legendItem, legend) {
    const index = legendItem.datasetIndex;
    const meta = legend.chart.getDatasetMeta(index);

    console.log(`Click detected on ${legendItem.text}`);
}