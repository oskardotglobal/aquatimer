<script lang="ts">
    import Footer from "../Components/Footer.svelte";
    import Navigation from "../Components/Navigation.svelte";

    let props = $props();
</script>

<nav>

</nav>

<Navigation />

<main class="flex-[1]">
    {@render props.children()}
</main>

<Footer />
