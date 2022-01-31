<template>
    <div>
        <Component
            v-for="link in links"
            :is="link.url ? 'Link' : 'span'"
            :href="link.url"
            v-html="link.label"
            class="px-3"
            :class="{ 'text-gray-500': !link.url, 'font-bold': link.active }"
        />
    </div>
</template>

<script setup>
defineProps({
    links: Array,
});
</script>
