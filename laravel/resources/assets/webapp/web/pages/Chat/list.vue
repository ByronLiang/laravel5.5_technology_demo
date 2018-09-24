<template>
    <div class="dashboard">
    <h2>Chat Room</h2>
    </div>
</template>

<script>
export default {
    components: {},
    data() {
        return {
            author: [],
        };
    },
    created() {
        this.initEcho();
        this.fetchData();
        console.log('init finish');
    },
    mounted() {
        // this.initEcho();
    },
    methods: {
        fetchData() {

        },
        initEcho() {
            Echo.channel('news').listen('News', (e) => {
                console.log(e.message);
            });
        },
    },
};
</script>
