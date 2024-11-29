<script lang="ts">
    interface Props {
        title: string;
    }

    let { title }: Props = $props();
</script>

<div class="flex flex-col items-center text-center space-y-4">
    <h1 class="block mt-4 font-bold text-4xl">{title}</h1>
    hey
</div>
