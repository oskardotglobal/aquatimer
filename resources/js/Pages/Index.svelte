<script lang="ts">
    import RootLayout from "../Layouts/RootLayout.svelte";
    import FullChart from "../Components/charts/FullChart.svelte";

    interface Props {
        measurements: Measurement[];
        node: Node;
    }

    let props: Props = $props();
    $inspect(props);
    let node: Node = $state({
        name: "Node 1",
    });

    let data: ChartData = $state({
        labels: ["10:20", "10:40", "10:50", "11:00", "11:10", "11:20", "11:30"],
        datasets: [
            {
                data: [500, 650, 700, 800, 900, 1000, 1100],
            },
        ]
    });

    function addData() {
        data.labels.push("11:40");
        data.datasets[0].data.push(500);
    }

    let isEditingName = $state(false);

    function enableNameEditing() {
        isEditingName = true;
    }

    function saveName() {
        isEditingName = false;

        // TODO: send mutation to server
    }

    function togglePump() {

    }
</script>

<RootLayout>
    <div class="flex gap-4 w-nav">
        <div class="flex-[8] grid grid-cols-2 gap-4">
            <FullChart yAxisLabel="Moisture" color="#2563eb" {data} />
            <FullChart yAxisLabel="Temperature" color="#ea580c" {data} />
            <FullChart yAxisLabel="Brightness" color="#eab308" {data} />
            <FullChart yAxisLabel="Humidity" color="#06b6d4" {data} />
        </div>

        <div class="flex-[2] flex flex-col gap-8">
            {#if isEditingName}
                <div class="flex gap-2">
                    <input placeholder="Node Name" bind:value={node.name} class="text-4xl w-full">
                    <button class="flex justify-center items-center" onclick={saveName}>
                        <i class="ph ph-floppy-disk text-2xl"></i>
                    </button>
                </div>
            {:else}
                <h1 onclick={enableNameEditing} class="text-4xl font-bold cursor-pointer">{node?.name}</h1>
            {/if}

            <button onclick={togglePump} class="bg-black rounded-md py-2 shadow-md text-white relative">
                <img width="20px" src="https://pngimg.com/d/birthday_hat_PNG26.png" class="absolute top-[-22px] left-[-11px] -rotate-[28deg]">
                Water manually
            </button>
        </div>
    </div>
</RootLayout>
