<script lang="ts">
    import { onDestroy, onMount } from "svelte";
    import Chart, { type ChartTypeRegistry } from "chart.js/auto";

    interface Props {
        containerClass?: string;
        canvasClass?: string;

        config: any;
        data: ChartData;
    }

    let props: Props = $props();

    let chartCanvas: HTMLCanvasElement | undefined = $state();
    let chart: Chart<keyof ChartTypeRegistry, number[], string> | null = $state(null);

    $effect(() => {
        if (chart == null) return;

        chart.data = $state.snapshot(props.data);

        chart.update();
    });

    onMount(() => {
        if (chartCanvas == null) {
            throw new Error("WTF is happening");
        }

        const initialConfig = {
            data: $state.snapshot(props.data),
            ...$state.snapshot(props.config)
        }

        chart = new Chart(chartCanvas, initialConfig);
    });

    onDestroy(() => {
        if (chart != null) {
            chart.destroy();
        }
    });
</script>

<div class="{props.containerClass}">
    <canvas bind:this={chartCanvas} class="{props.canvasClass}"></canvas>
</div>
