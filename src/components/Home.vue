<template>
    <div class="home">
        <h1 class="text-center">{{mgs}}</h1>
    </div>
</template>


<script>
    export default {
        name: "Home",
        data() {
            return {
                mgs: "I'm from Home"
            }
        }
    }
</script>

<style>
    .text-center {
        text-align: center
    }
</style>
