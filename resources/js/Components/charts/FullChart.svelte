<script lang="ts">
    import BaseChart from "./BaseChart.svelte";

    interface Props {
        data: ChartData;
        yAxisLabel: string;
        color: string;
    }

    let props: Props = $props();

    const chartConfig = {
        type: "line",
        options: {
            responsive: true,
            animation: false,
            layout: {
                padding: 5
            },
            legend: {
                display: false
            },
            elements: {
                line: {
                    borderColor: props.color,
                    backgroundColor: props.color,
                    borderWidth: 2
                },
                point: {
                    radius: 3
                }
            },
            interaction: {
                mode: 'index',
                intersect: false,
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: false,
                        text: "Timestamp"
                    }
                },
                y: {
                    display: true,
                    position: "left",
                    title: {
                        display: true,
                        text: props.yAxisLabel
                    }
                },
            },
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    enabled: true
                },
            }
        }
    }
</script>

<BaseChart data={props.data} config={chartConfig} />
