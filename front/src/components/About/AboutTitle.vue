<template>
    <div class="about-title">
        <div class="breadcrumb">
            {{ title }}
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'title'
    ]
}
</script>

<style>
    .breadcrumb {
        font-size: 32px;
        margin-bottom: 10px;
        line-height: 41px;
        font-family: 'American Typewriter';
    }
</style>